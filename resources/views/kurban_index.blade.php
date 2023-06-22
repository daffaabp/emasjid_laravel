@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="col-md-6 text-right mt-3 mb-3">
                    <a href="{{ route('kurban.create') }}" class="btn btn-primary">Tambah Kurban</a>
                </div>
                <table class="{{ config('app.table_style') }}">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tahun Kurban</th>
                            <th>Tanggal Akhir Daftar</th>
                            <th>Konten</th>
                            <th>Dibuat Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($models as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tahun_hijriah }}H / {{ $item->tahun_masehi }}M</td>
                                <td>{{ $item->tanggal_akhir_pendaftaran->format('d-m-Y') }}</td>
                                <td>
                                    <div class="fw-bold">{{ $item->judul }}</div>
                                    {{ strip_tags($item->konten) }}
                                </td>

                                <td>{{ $item->createdBy->name }}</td>
                                <td>
                                    <a href="{{ route('kurban.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning mb-1 mx-1">Edit</a>
                                    <a href="{{ route('kurban.show', $item->id) }}"
                                        class="btn btn-sm btn-primary mb-1 mx-1">Detail</a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['kurban.destroy', $item->id],
                                        'style' => 'display:inline',
                                    ]) !!}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mb-1 mx-1"
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
