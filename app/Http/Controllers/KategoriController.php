<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Kategori::UserMasjid()->latest()->paginate(50);
        $title = 'Kategori Informasi';
        return view('kategori_index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // gaya penulisan yang berbeda dari biasanya dapat dilakukan seperti dibawah ini
        $data['model'] = new Kategori();
        $data['route'] = 'kategori.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Kategori Informasi';
        return view('kategori_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'nama' => 'required',
            'keterangan' => 'nullable',
            ]);

        // sebelumnya disini ada proses untuk ConvertImageBase64ToUrl -> dipindahkan menjadi Trait agar bisa dipanggil sewaktu waktu di proses manapun
        // lihat di Profil model

        Kategori::create($requestData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $data['model'] = $kategori;
        $data['route'] = ['kategori.update', $kategori->id];
        $data['method'] = 'PUT';
        $data['title'] = 'Edit Kategori Informasi';

        return view('kategori_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $requestData = $request->validate([
            'nama' => 'required',
            'keterangan' => 'nullable',
            ]);
        $kategori->update($requestData);
        flash('Data berhasil diubah.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}