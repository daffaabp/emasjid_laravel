<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\MasjidBank;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMasjidBankRequest;
use App\Http\Requests\UpdateMasjidBankRequest;

class MasjidBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = MasjidBank::UserMasjid()->latest()->paginate(50);
        $title = 'Informasi Bank Masjid';
        return view('masjidbank_index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['model'] = new MasjidBank();
        $data['route'] = 'masjidbank.store';
        $data['method'] = 'POST';

        // kita buat List untuk Data Bank yang akan kita ambil dari Database yang sudah kita import
        $data['listBank'] = Bank::pluck('nama_bank', 'id');

        $data['title'] = 'Tambah Bank Baru';
        return view('masjidbank_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'bank_id' => 'required|exists:banks,id', // artinya bank_id itu harus selalu ada di table banks, kolom ID
            'nama_rekening' => 'required',
            'nomor_rekening' => 'required',
            ]);

        $bank = Bank::findOrFail($requestData['bank_id']);
        unset($requestData['bank_id']); // kita buang bank_id nya --> akan menimbulkan error karena di dalam tabel masjid_bank kita tidak ada kolom bank_id
        $requestData['kode_bank'] = $bank->sandi_bank;   // kita memindahkan dari table bank ke tabel masjidbank
        $requestData['nama_bank'] = $bank->nama_bank;   // kita memindahkan dari table bank ke tabel masjidbank
        MasjidBank::create($requestData);
        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(MasjidBank $masjidBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasjidBank $masjidbank) // kita sempet ada salah di penulisan parameter $masjidBank, harusnya huruf kecil semua --> untuk ngecek silahkan ketikkan "php artisan route:list"
    {
        $data['model'] = $masjidbank;
        $data['route'] = ['masjidbank.update', $masjidbank->id];
        $data['method'] = 'PUT';

        // kita buat List untuk Data Bank yang akan kita ambil dari Database yang sudah kita import
        $data['listBank'] = Bank::pluck('nama_bank', 'id');

        $data['title'] = 'Tambah Bank Baru';
        return view('masjidbank_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasjidBank $masjidbank)
    {
        $requestData = $request->validate([
            'bank_id' => 'required|exists:banks,id', // artinya bank_id itu harus selalu ada di table banks, kolom ID
            'nama_rekening' => 'required',
            'nomor_rekening' => 'required',
            ]);

        $bank = Bank::findOrFail($requestData['bank_id']);
        unset($requestData['bank_id']); // kita buang bank_id nya --> akan menimbulkan error karena di dalam tabel masjid_bank kita tidak ada kolom bank_id
        $requestData['kode_bank'] = $bank->sandi_bank;   // kita memindahkan dari table bank ke tabel masjidbank
        $requestData['nama_bank'] = $bank->nama_bank;   // kita memindahkan dari table bank ke tabel masjidbank
        $masjidbank->update($requestData);
        flash('Data berhasil diperbarui');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasjidBank $masjidbank)
    {
        $masjidbank->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}