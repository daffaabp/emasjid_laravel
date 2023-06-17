<?php

namespace App\Traits;

use App\Models\Masjid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasMasjid
{
    // bootHasMasjid ini berfungsi agar Laravel secara otomatis perintah "creating function" dibawah ini secara otomatis
    protected static function bootHasMasjid() {
        static::creating(function ($model) {
            $model->masjid_id = auth()->user()->masjid_id;
        });
    }

    // disini kita tambahkan scopeUserMasjid agar profil itu selalu mengambil milik user yang sedang Login
    public function scopeUserMasjid($q)
    {
        return $q->where('masjid_id', auth()->user()->masjid_id);
    }

    // dari Profil harusnya ada relasi BelongsTo
    /**
     * Get the masjid that owns the HasMasjid
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masjid(): BelongsTo
    {
        return $this->belongsTo(Masjid::class);
    }
}