<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ConvertContentImageBase64ToUrl
{
    // disini kita membuat Trait untuk mengkonversi content dari ImageBase64 menjadi URL
    // Maka kita tidak baut menjadi function, tapi menjadi TRAIT supaya dalam pemakaiannya dapat otomatis
    protected function convertContentImageBase64ToUrl($content)
    {
            $pattern = '/<img.*?src="(data:image\/(.*?);base64,.*?)".*?>/i';
preg_match_all($pattern, $content, $matches);
$gambarBase64 = $matches[1];
$masjidId = auth()->user()->masjid_id;

foreach ($gambarBase64 as $gambar) {
$data= explode(',', $gambar);
$gambarData = $data[1];
$mime = $data[0];


// Mendapatkan ekstensi file dari tipe MIME menggunakan pustaka finfo
$finfo = finfo_open();
$ext = finfo_buffer($finfo, base64_decode($gambarData), FILEINFO_MIME_TYPE);
finfo_close($finfo);
$ext = explode('/', $ext)[1];

$namaFile = "profil/$masjidId/" . uniqid() . '.' . $ext;
Storage::disk('public')->put($namaFile, base64_decode($gambarData));
$namaFile = "/storage/$namaFile";
$content = str_replace($gambar, $namaFile, $content);
}

return $content;

}

public function setAttribute($key, $value)
{
if ($key === $this->contentName) {
$value = $this->convertContentImageBase64ToUrl($value);
}

return parent::setAttribute($key, $value);
}

}
