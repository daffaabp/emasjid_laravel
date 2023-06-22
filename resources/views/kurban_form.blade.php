<!-- kas_form.blade.php -->

@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    {!! Form::model($model, [
                        'route' => $route,
                        'method' => $method,
                    ]) !!}

                    <div class="form-group mb-3">
                        {!! Form::label('tahun_hijriah', 'Judul') !!}
                        {!! Form::selectRange('tahun_hijriah', 1445, 1460, null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tahun_hijriah') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('tahun_masehi', 'Tahun Masehi') !!}
                        {!! Form::selectRange('tahun_masehi', 2023, date('Y'), null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tahun_masehi') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('tanggal_akhir_pendaftaran', 'Tanggal Akhir Pendaftaran') !!}
                        {!! Form::date('tanggal_akhir_pendaftaran', now(), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_akhir_pendaftaran') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('konten', 'Informasi Kurban') !!}
                        {!! Form::textarea('konten', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Isi Profil',
                            'id' => 'summernote',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('konten') }}</span>
                    </div>

                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    @endsection
