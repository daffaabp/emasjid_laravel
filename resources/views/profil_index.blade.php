@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3">Profil Masjid</h1>
    <div class="row">
        <div class="col-12">
            <div class="card-header">
                <div class="col-md-6 text-right mt-3 mx-3">
                    <a href="{{ route('profil.create') }}" class="btn btn-primary">Tambah Profil</a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Pemasukkan</th>
                            <th>Pengeluaran</th>
                            <th>Diinputkan Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profil as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                {{-- <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $item->tanggal)->format('d-m-Y') }}</td> --}}
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->kategori ?? 'umum' }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    {{ $item->jenis == 'masuk' ? formatRupiah($item->jumlah) : '-' }}
                                </td>
                                <td>
                                    {{ $item->jenis == 'keluar' ? formatRupiah($item->jumlah) : '-' }}
                                </td>
                                <td>{{ isset($item->createdBy->name) ? $item->createdBy->name : '' }}</td>
                                <td>
                                    <a href="{{ route('kas.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['kas.destroy', $item->id],
                                        'style' => 'display:inline',
                                    ]) !!}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kas ini?')">Hapus</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
