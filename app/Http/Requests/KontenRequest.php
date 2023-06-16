<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KontenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
        ];
    }
}