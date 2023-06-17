<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInformasiRequest;
use App\Http\Requests\UpdateInformasiRequest;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Informasi::UserMasjid()->latest()->paginate(50);
        $title = 'Informasi Masjid';
        return view('informasi_index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['model'] = new Informasi();
        $data['route'] = 'informasi.store';
        $data['method'] = 'POST';

        // kategori ini akan kita buat berupa pilihan atau select
        $data['listKategori'] = Kategori::pluck('nama', 'id');
        $data['title'] = 'Tambah Informasi Baru';
        return view('informasi_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
            ]);

        // sebelumnya disini ada proses untuk ConvertImageBase64ToUrl -> dipindahkan menjadi Trait agar bisa dipanggil sewaktu waktu di proses manapun
        // lihat di Profil model

        Informasi::create($requestData);
        flash('Data berhasil disimpan');
        return view('informasi_index', $requestData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Informasi $informasi)
    {
        $data['model'] = $informasi;
        $data['title'] =  'Detail Masjid';
        return view('informasi_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        $data['model'] = $informasi;
        $data['route'] = ['informasi.update', $informasi->id];
        $data['method'] = 'PUT';
        $data['title'] = 'Edit Informasi Masjid';

        // kategori ini akan kita buat berupa pilihan atau select
        $data['listKategori'] = Kategori::pluck('nama', 'id');
        return view('informasi_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
            ]);
        $informasi->update($requestData);
        flash('Data berhasil diperbarui.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
