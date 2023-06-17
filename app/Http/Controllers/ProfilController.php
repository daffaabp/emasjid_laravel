<?php

namespace App\Http\Controllers;

use finfo;
use App\Models\Profil;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\KontenRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProfilRequest;
use App\Http\Requests\UpdateProfilRequest;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Profil::UserMasjid()->latest()->paginate(50);
        $title = 'Profil Masjid';
        return view('profil_index', compact('models', 'title'));
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
        $data['title'] = 'Tambah Profil Masjid';
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

        Profil::create($requestData);
        flash('Data berhasil disimpan');
        return back();
    }

    /**
    * Display the specified resource.
    */
    public function show(Profil $profil)
    {
        $data['profil'] = $profil;
        $data['title'] =  'Detail Masjid';
        return view('profil_show', $data);
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Profil $profil) // ini merupakan trik yaitu model bounding
    {
        // $profil = Profil::where('masjid_id', auth()->user()->masjid_id)->where('id', $id)->firstOrFail();
        $data['profil'] = $profil;
        $data['route'] = ['profil.update', $profil->id];
        $data['method'] = 'PUT';
        $data['title'] = 'Tambah Profil Masjid';

        // kategori ini akan kita buat berupa pilihan atau select
        $data['listKategori'] = [
            'visi-misi' => 'Visi Misi',
            'sejarah' => 'Sejarah',
            'struktur-organisasi' => 'Struktur Organisasi',
        ];
        return view('profil_form', $data);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, Profil $profil)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
            ]);
        $profil->update($requestData);
        flash('Data berhasil diperbarui.');
        return back();
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Profil $profil)
    {
        $profil->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}