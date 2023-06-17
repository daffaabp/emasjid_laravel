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


     /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    // Disini kita menggunakan salah satu fitur Laravel yaitu Route Model Binding
    // Tujuannya agar user tidak dapat mengakses data dari profil user lain hanya dengan mengganti nomor ID nya
    // Route Binding ini dapat kita letakkan di masing-masing Model, atau jika ingin lebih singkatnya bisa kita letakkan di dalam TRAIT nya HasMasjid
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('masjid_id', auth()->user()->masjid_id)
        ->where('id', $value)
        ->firstOrFail();
    }
}