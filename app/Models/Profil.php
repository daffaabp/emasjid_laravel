<?php

namespace App\Models;

use App\Traits\HasMasjidId;
use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ConvertContentImageBase64ToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profil extends Model
{
    use HasFactory;
    // disini tinggal kita panggil Trait HasCreatedBy dan HasMasjidId
    use HasCreatedBy, HasMasjidId, GenerateSlug;
    // disini tinggal kita panggil fungsi Convert nya
    use ConvertContentImageBase64ToUrl;

    protected $contentName = 'konten';
    protected $guarded = [];

    // disini kita tambahkan scopeUserMasjid agar profil itu selalu mengambil milik user yang sedang Login
    public function scopeUserMasjid($q)
    {
        return $q->where('masjid_id', auth()->user()->masjid_id);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by'); // relasinya ke tabel user, tapi foreign key nya menggunakan "created_by"
    }
}