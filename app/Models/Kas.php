<?php

namespace App\Models;

use App\Models\User;
use App\Models\Masjid;
use App\Traits\HasMasjid;
use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kas extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid;
    protected $guarded = [];

    protected $casts = [
        'tanggal' => 'datetime:d-m-Y H:i',
    ];

    // semua sintaks function dibawah ini sudah dipindah ke dalam TRAIT

    // public function masjid()
    // {
    //     return $this->belongsTo(Masjid::class);
    // }

    // public function createdBy()
    // {
    //     return $this->belongsTo(User::class, 'created_by'); // relasinya ke tabel user, tapi foreign key nya menggunakan "created_by"
    // }

    // public function scopeUserMasjid($q)
    // {
    //     return $q->where('masjid_id', auth()->user()->masjid_id);
    // }

    public function scopeSaldoAkhir($query, $masjidId = null)
    {
        // mengambil data yang berelasi dari table masjid dengan user
        $masjidId = $masjidId ?? auth()->user()->masjid_id;
        $masjid = Masjid::where('id', $masjidId)->first();
        return $masjid->saldo_akhir ?? 0;
    }


}
