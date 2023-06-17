<?php

namespace App\Models;

use App\Traits\HasMasjid;
use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ConvertContentImageBase64ToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Psy\Command\WhereamiCommand;

class Profil extends Model
{
    use HasFactory;
    // disini tinggal kita panggil Trait HasCreatedBy dan HasMasjidId -> HasMasjidID diganti nama file nya menjadi HasMasjid
    use HasCreatedBy, GenerateSlug, HasMasjid;
    // disini tinggal kita panggil fungsi Convert nya
    use ConvertContentImageBase64ToUrl;

    protected $contentName = 'konten';
    protected $guarded = [];

    // Di dalam profil ini sudah tidak ada relasi, karena relasinya sudah diletakkan di dalam TRAIT semua di bagian HasMasjid

}
