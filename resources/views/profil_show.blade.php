@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>
    <div class="row">
        <div class="col-12">
            <div class="card-header">
                <div class="col-md-6 text-right mt-3 mx-3">
                    <a href="{{ route('profil.create') }}" class="btn btn-primary">Tambah Profil</a>
                </div>
                <div class="card-body">
                    <table class="table table-light">
                        <tr>
                            <td width="15%">Judul</td>
                            <td>: {{ $profil->judul }}</td>
                        </tr>
                        <tr>
                            <td>Konten</td>
                            <td>: {!! $profil->konten !!}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Posting</td>
                            <td>: {!! $profil->created_at->translatedFormat('l, d F Y') !!}</td>
                        </tr>
                        <tr>
                            <td>Dibuat Oleh</td>
                            <td>: {!! $profil->createdBy->name !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
