<!-- kas_form.blade.php -->

@extends('layouts.app_adminkit')

@section('content')
    <h1>{{ $title }}</h1>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    {!! Form::model($model, [
                        'route' => $route,
                        'method' => $method,
                    ]) !!}

                    {{-- Disini kita akan membuat dropdown list Data Bank yang dimana diambil dari SQL yg mengacu pada Model Bank --}}
                    <div class="form-group mb-3">
                        {!! Form::label('nama_bank', 'Nama Bank') !!}
                        {!! Form::select('bank_id', $listBank, null, ['class' => 'form-control select2']) !!}
                        <span class="text-danger">{{ $errors->first('nama_bank') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('nama_rekening', 'Nama Pemilik Rekening') !!}
                        {!! Form::text('nama_rekening', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nama_rekening') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('nomor_rekening', 'Nomor Rekening') !!}
                        {!! Form::text('nomor_rekening', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nomor_rekening') }}</span>
                    </div>

                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    @endsection
