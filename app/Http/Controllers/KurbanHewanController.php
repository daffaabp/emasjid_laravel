<?php

namespace App\Http\Controllers;

use App\Models\Kurban;
use App\Models\KurbanHewan;
use App\Http\Requests\StoreKurbanHewanRequest;
use App\Http\Requests\UpdateKurbanHewanRequest;

class KurbanHewanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // kita lakukan validasi terlebih dahulu agar user tidak dapat merubah ID pada URL -> jadi apabila user mengganti ID pada URL yang bukan milik UserId itu sendiri akan muncul halaman "NotFound"
        // caranya dengan kita lakukan Query berdasarkan UserMasjid
        $kurban = Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();

        $data['model'] = new KurbanHewan();
        $data['route'] = 'kurbanhewan.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Informasi Hewan Kurban';
        $data['kurban'] = $kurban;
        return view('kurbanhewan_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    // Disini kita menggunakan fitur Laravel yang bernama Validation Request rule
    public function store(StoreKurbanHewanRequest $request)
    {
        KurbanHewan::create($request->validated());
        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(KurbanHewan $kurbanHewan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KurbanHewan $kurbanhewan)
    {
        $kurban = Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();

        $data['model'] = $kurbanhewan;
        $data['route'] = ['kurbanhewan.update', $kurbanhewan->id];
        $data['method'] = 'PUT';
        $data['title'] = 'Ubah Informasi Hewan Kurban';
        $data['kurban'] = $kurban;
        return view('kurbanhewan_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurbanHewanRequest $request, KurbanHewan $kurbanhewan)
    {
        $kurbanhewan->update($request->validated());
        flash('Data berhasil diperbarui');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KurbanHewan $kurbanhewan)
    {
        Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();
        // Kondisi jika Data Hewan Kurbannya sudah digunakan oleh peserta, maka data hewan itu tidak bisa dihapus
        // Sedangkan jika data peserta itu tidak terikat dengan data manapun
        if ($kurbanhewan->kurbanPeserta->count() == 0) {
            $kurbanhewan->delete();
            flash('Data sudah dihapus');
            return back();
        }
        flash('Data gagal dihapus, karena sudah digunakan oleh peserta')->error();
        return back();
    }
}