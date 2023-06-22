<?php

namespace App\Models;

use App\Traits\HasMasjid;
use App\Models\KurbanHewan;
use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ConvertContentImageBase64ToUrl;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurban extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid;
    use ConvertContentImageBase64ToUrl;

    protected $contentName = 'konten';
    protected $guarded = [];
    protected $casts = [
        'tanggal_akhir_pendaftaran' => 'date',
    ];

    /**
     * Get all of the comments for the Kurban
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kurbanHewan(): HasMany
    {
        return $this->hasMany(KurbanHewan::class);
    }
}