@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3">Form Masjid</h1>
    <div class="row">

        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-0">Silahkan isi data masjid yang ada kelola.</h3>
            </div>
            <div class="card-body">
                {!! Form::model($masjid, [
                    'route' => 'masjid.store',
                    'method' => 'POST',
                ]) !!}

                <div class="form-group mb-3">
                    <label for="nama">Nama Masjid</label>
                    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{!! $errors->first('nama') !!}</span>
                </div>

                <div class="form-group mb-3">
                    <label for="alamat">Alamat Masjid</label>
                    {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{!! $errors->first('alamat') !!}</span>
                </div>

                <div class="form-group mb-3">
                    <label for="telp">No Telp / Nomor HP Pengurus</label>
                    {!! Form::text('telp', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{!! $errors->first('telp') !!}</span>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email Masjid</label>
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{!! $errors->first('email') !!}</span>
                </div>

                {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection
