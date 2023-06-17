<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class KasController extends Controller
{
    public function index(Request $request)
    {
        // Query untuk megaktifkan kolom pencarian pada halaman kas_index.blade.php
        $query = Kas::UserMasjid();
        if ($request->filled('q')) {
            $query = $query->where('keterangan', 'LIKE', '%' . $request->q . '%');
        }

        if ($request->filled('tanggal')) {
            $query = $query->where('tanggal', $request->tanggal);
        }

        $kas = $query->latest()->paginate(50);
        $saldoAkhir = Kas::SaldoAkhir();
        // untuk menghitung total Pemasukan dan Pengeluaran
        $totalPemasukan = $kas->where('jenis', 'masuk')->sum('jumlah');
        $totalPengeluaran = $kas->where('jenis', 'keluar')->sum('jumlah');

        // panggil semua variabel diatas di dalam "compact"
        return view('kas_index', compact('kas', 'saldoAkhir', 'totalPemasukan', 'totalPengeluaran'));
    }

    public function create()
    {
        $kas = new Kas();
        $saldoAkhir = Kas::SaldoAkhir();
        $disable = [];
        return view('kas_form', compact('kas', 'saldoAkhir', 'disable'));
    }

    public function store(Request $request)
    {
        $requestData = $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'nullable',
            'keterangan' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required',
        ]);

        // Membuat validasi yaitu transaksi yang di input tidak boleh transaksi di bulan sebelumnya (harus di bulan yang sedang berjalan)
        // 1. Ambil data transaksi, lalu konversi menjadi carbon, --> tanggal menjadi format Array
        // 2. Ambil bulan transaksi, sesuaikan formatnya
        // 3. Ambil tanggal sekarang
        // 4. Kita bandingkan jika tabel bulan transaksi tidak sama dengan tahun bulan sekarang, berikan flash message
        $tanggalTransaksi = Carbon::parse($requestData['tanggal']);
        $tahunBulanTransaksi = $tanggalTransaksi->format('Ym');
        $tahunBulanSekarang = Carbon::now()->format('Ym');
        if ($tahunBulanTransaksi != $tahunBulanSekarang) {
            flash('Data kas gagal ditambahkan. Transaksi hanya bisa dilakukan untuk bulan ini.')->error();
            return back();
        }



        $requestData['jumlah'] = str_replace('.', '', $requestData['jumlah']);
        // disini kita harus melakukan query terlebih dahulu ke table kas
        $saldoAkhir = Kas::SaldoAkhir();

        // saldo terakhir ditambah dengan jumlah transaksi masuk/keluar
        if ($requestData['jenis'] == 'masuk') {
            $saldoAkhir += $requestData['jumlah'];
        } else {
            $saldoAkhir -= $requestData['jumlah'];
        }


        // Jika saldonya kurang dari 0 -> maka yang terjadi adalah hasil pengurangannya akan bernilai negatif/minus
        if ($saldoAkhir <= -1) {
            flash('Data kas gagal ditambahkan. Saldo akhir dikurangi dengan transaksi tidak boleh kurang dari 0.')->error();
            return back();
        }

        $kas = new Kas();
        $kas->fill($requestData);
        $kas->save();
        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]); // kita mau update saldo akhir yang ada di table masjid

        flash('Data kas berhasil ditambahkan.')->success();
        return redirect()->route('kas.index')->with('success', 'Data kas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kas = Kas::findOrFail($id);
        $saldoAkhir = Kas::SaldoAkhir();
        $disable = ['disabled' => 'disabled'];
        return view('kas_form', compact('kas', 'saldoAkhir', 'disable'));
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'kategori' => 'nullable',
            'keterangan' => 'required',
            'jumlah' => 'required',
        ]);
        $jumlah = str_replace('.', '', $requestData['jumlah']);
        $saldoAkhir = Kas::SaldoAkhir();
        $kas = Kas::findOrFail($id);

        if ($kas->jenis == 'masuk') {
            $saldoAkhir -= $kas->jumlah;
        }
        if ($kas->jenis == 'keluar') {
            $saldoAkhir += $kas->jumlah;
        }

        $saldoAkhir = $saldoAkhir + $jumlah;
        $requestData['jumlah'] = $jumlah;
        $kas->fill($requestData);
        $kas->save();
        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]);
        flash('Data kas berhasil diperbarui');
        return redirect()->route('kas.index');
    }

    public function destroy($id)
    {
        $kas = Kas::findOrFail($id);

        $saldoAkhir = Kas::SaldoAkhir();

        // Jika membatalkan pemasukkan, maka kas berkurang
        if ($kas->jenis == 'masuk') {
            $saldoAkhir -= $kas->jumlah;
        }
        if ($kas->jenis == 'keluar') {
            $saldoAkhir += $kas->jumlah;
        }
        $kas->delete();
        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]);
        flash('Data kas berhasil diperbarui');
        return redirect()->route('kas.index');
    }

}