<?php

namespace App\Models;

use App\Models\Peserta;
use App\Traits\HasMasjid;
use App\Models\KurbanHewan;
use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpParser\Node\Expr\Cast\String_;

class KurbanPeserta extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid;
    protected $guarded = [];

    /**
     * Get the user that owns the KurbanPeserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class);
    }


    /**
     * Get the user that owns the KurbanPeserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kurbanHewan(): BelongsTo
    {
        return $this->belongsTo(KurbanHewan::class);
    }

    public function getStatusTeks(): String
    {
        if ($this->status_bayar == "lunas") {
            return "Lunas";
        }else {
            return "Belum Lunas";
        }
    }
}