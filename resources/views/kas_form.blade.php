<!-- kas_form.blade.php -->

@extends('layouts.app_adminkit')

@section('content')
    <h1>Form Transaksi Kas</h1>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4>Saldo Akhir Saat Ini : {{ formatRupiah($saldoAkhir) }}</h4>
                    {!! Form::model($kas, [
                        'route' => isset($kas->id) ? ['kas.update', $kas->id] : 'kas.store', // jika id ada nilai, kita akan melakukan update, klo tidak maka kita akan melakukan penyimpanan atau store
                        'method' => isset($kas->id) ? 'PUT' : 'POST',
                    ]) !!}

                    <div class="form-group mb-3">
                        {!! Form::label('tanggal', 'Tanggal') !!}
                        {!! Form::date('tanggal', $kas->tanggal ?? now(), ['class' => 'form-control'] + $disable) !!}
                        <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('kategori', 'Kategori') !!}
                        {!! Form::text('kategori', null, ['class' => 'form-control', 'placeholder' => 'Kategori']) !!}
                        <span class="text-danger">{{ $errors->first('kategori') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('keterangan', 'Keterangan') !!}
                        {!! Form::textarea('keterangan', null, [
                            'class' => 'form-control',
                            'rows' => 4,
                            'placeholder' => 'Keterangan',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('jenis', 'Jenis Transaksi') !!}
                        <div class="form-check mb-2 mt-2">
                            {!! Form::radio('jenis', 'masuk', 1, ['class' => 'form-check-input', 'id' => 'jenis_masuk'] + $disable) !!}
                            {!! Form::label('jenis_masuk', 'Pemasukan', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::radio('jenis', 'keluar', null, ['class' => 'form-check-input', 'id' => 'jenis_keluar'] + $disable) !!}
                            {!! Form::label('jenis_keluar', 'Pengeluaran', ['class' => 'form-check-label']) !!}
                        </div>
                        <span class="text-danger ">{{ $errors->first('jenis') }}</span>
                    </div>


                    <div class="form-group mb-3">
                        {!! Form::label('jumlah', 'Jumlah Transaksi') !!}
                        {!! Form::number('jumlah', null, ['class' => 'form-control rupiah', 'placeholder' => 'Jumlah']) !!}
                        <span class="text-danger ">{{ $errors->first('jumlah') }}</span>
                    </div>

                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    @endsection
