<?php

namespace App\Http\Controllers;

use App\Models\Kurban;
use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateKurbanRequest;

class KurbanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Kurban::UserMasjid()->latest()->paginate(50);
        $title = 'Informasi Kurban';
        return view('kurban_index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['model'] = new Kurban();
        $data['route'] = 'kurban.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Informasi Kurban';
        return view('kurban_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'tahun_masehi' => 'required',
            'tahun_hijriah' => 'required',
            'tanggal_akhir_pendaftaran' => 'required',
            'konten' => 'required',
            ]);

        // sebelumnya disini ada proses untuk ConvertImageBase64ToUrl -> dipindahkan menjadi Trait agar bisa dipanggil sewaktu waktu di proses manapun
        // lihat di Profil model

        Kurban::create($requestData);
        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Kurban $kurban)
    {
        $data['kurban'] = $kurban;
        $data['title'] =  'Detail Kurban';
        if (request('output') == 'laporan') {
            return view('kurban_laporan', $data);
        }
        return view('kurban_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kurban $kurban)
    {
        $data['model'] = $kurban;
        $data['route'] = ['kurban.update', $kurban->id];
        $data['method'] = 'PUT';
        $data['title'] = 'Edit Informasi Kurban';
        return view('kurban_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kurban $kurban)
    {
        $requestData = $request->validate([
            'tahun_masehi' => 'required',
            'tahun_hijriah' => 'required',
            'tanggal_akhir_pendaftaran' => 'required',
            'konten' => 'required',
            ]);
        $kurban->update($requestData);
        flash('Data berhasil diperbarui.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurban $kurban)
    {
        if ($kurban->kurbanHewan->count() >= 1) {
            flash('Data tidak bisa dihapus karena sudah digunakan di tabel lain')->error();
            return back();
        }

        if ($kurban->kurbanPeserta->count() >= 1) {
            flash('Data tidak bisa dihapus karena sudah digunakan di tabel lain')->error();
            return back();
        }

        $kurban->delete();
        flash('Data berhasil dihapus.');
        return back();
    }
}