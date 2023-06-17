@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>
    <div class="row">
        <div class="col-12">
            <div class="card-header">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td width="15%">Judul</td>
                            <td>: {{ $model->judul }}</td>
                        </tr>
                        <tr>
                            <td>Konten</td>
                            <td>{!! $model->konten !!}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Posting</td>
                            <td>: {!! $model->created_at->translatedFormat('l, d F Y') !!}</td>
                        </tr>
                        <tr>
                            <td>Dibuat Oleh</td>
                            <td>: {!! $model->createdBy->name !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
