<?php

namespace App\Models;

use App\Models\Kurban;
use App\Traits\HasMasjid;
use App\Traits\HasCreatedBy;
use App\Models\KurbanPeserta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KurbanHewan extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid;
    protected $guarded = [];

    // kita akan menampilkan nama lengkap dari hewan kurbannya -> nama, kriteria, dan harganya
    protected $appends = ['nama_full'];
    public function getNamaFullAttribute()
    {
        return ucwords($this->hewan) . " - {$this->kriteria} - " . formatRupiah($this->iuran_perorang);
    }

    public function kurban()
    {
        return $this->belongsTo(Kurban::class);
    }


    /**
     * Get all of the comments for the KurbanHewan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kurbanPeserta(): HasMany
    {
        return $this->hasMany(KurbanPeserta::class);
    }
}