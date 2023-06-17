@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>
    <div class="row">
        <div class="col-12">
            <div class="card-header">
                <div class="col-md-6 text-right mt-3 mx-3">
                    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-1 mx-1">Tambah Kategori Informasi</a>
                </div>
                <table class="{{ config('app.table_style') }}">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Konten</th>
                            <th>Diinput Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($models as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ strip_tags($item->konten) }}</td>
                                <td>{{ $item->createdBy->name }}</td>
                                <td>
                                    <a href="{{ route('kategori.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning mb-1 mx-1">Edit</a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['kategori.destroy', $item->id],
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
