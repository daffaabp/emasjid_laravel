@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>
    <div class="row">
        <div class="col-12">
            <div class="card-header">
                <div class="card-body">
                    <h3>Tahun Kurban {{ $kurban->tahun_hijriah . '/' . $kurban->tahun_masehi }}</h3>
                    <h6>
                        <i class="align-middle" data-feather="calendar"></i>Tanggal Akhir Pendaftaran:
                        <b>{{ $kurban->tanggal_akhir_pendaftaran->format('d-m-Y') }}</b>
                    </h6>
                    <h6>
                        <i class="align-middle" data-feather="user"></i>Create By:
                        <b>{{ $kurban->createdBy->name }}</b>
                    </h6>
                    <p>{!! $kurban->konten !!}</p>
                    <hr>
                    <h3>Data Hewan Kurban</h3>

                    @if ($kurban->kurbanHewan->count() == 0)
                        <div class="text-center">Belum ada data.
                            <a href="{{ route('kurbanhewan.create', ['kurban_id' => $kurban->id]) }}">Buat Baru</a>
                        </div>
                    @endif


                </div>
            </div>
        </div>

    </div>
@endsection
