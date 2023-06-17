<?php

namespace App\Http\Controllers;

use finfo;
use Request;
use App\Models\Profil;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\KontenRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProfilRequest;
use App\Http\Requests\UpdateProfilRequest;



class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profil = Profil::UserMasjid()->latest()->paginate(50);
        return view('profil_index', compact('profil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // gaya penulisan yang berbeda dari biasanya dapat dilakukan seperti dibawah ini
        $data['profil'] = new Profil();
        $data['route'] = 'profil.store';
        $data['method'] = 'POST';

        // kategori ini akan kita buat berupa pilihan atau select
        $data['listKategori'] = [
            'visi-misi' => 'Visi Misi',
            'sejarah' => 'Sejarah',
            'struktur-organisasi' => 'Struktur Organisasi',
        ];
        return view('profil_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KontenRequest $request)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
            ]);

        // sebelumnya disini ada proses untuk ConvertImageBase64ToUrl -> dipindahkan menjadi Trait agar bisa dipanggil sewaktu waktu di proses manapun
        // lihat di Profil model

        $requestData['created_by'] = auth()->user()->id;
        $requestData['masjid_id'] = auth()->user()->masjid_id;
        $requestData['slug'] = Str::slug($request->judul);
        Profil::create($requestData);

        flash('Data sudah disimpan');
        return back();
    }

/**
* Display the specified resource.
*/
public function show(Profil $profil)
{
//
}

/**
* Show the form for editing the specified resource.
*/
public function edit(Profil $profil)
{
//
}

/**
* Update the specified resource in storage.
*/
public function update(UpdateProfilRequest $request, Profil $profil)
{
//
}

/**
* Remove the specified resource from storage.
*/
public function destroy(Profil $profil)
{
//
}
}