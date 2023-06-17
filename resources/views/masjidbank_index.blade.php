@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="col-md-6 text-right mt-3 mb-3">
                    <a href="{{ route('masjidbank.create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
                <table class="{{ config('app.table_style') }}">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>BANK</th>
                            <th>NO. REKENING</th>
                            <th>AN. REKENING</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($models as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <div class="fw-bold">{{ $item->nama_bank }}</div>
                                </td>
                                <td>{{ $item->nomor_rekening }}</td>
                                <td>{{ $item->nama_rekening }}</td>
                                <td>
                                    <a href="{{ route('masjidbank.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning mb-1 mx-1">Edit</a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['masjidbank.destroy', $item->id],
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
