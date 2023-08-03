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
                        {!! Form::label('kategori', 'Kategori') !!}
                        {!! Form::select('kategori', $listKategori, null, [
                            'class' => 'form-control',
                            'placeholder' => 'Pilih Kategori Informasi',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('kategori') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('judul', 'Judul') !!}
                        {!! Form::text('judul', null, ['clas-s' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('judul') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('konten', 'Konten / Isi Profil') !!}
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
