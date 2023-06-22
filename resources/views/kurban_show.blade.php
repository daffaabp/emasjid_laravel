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

                    @if ($kurban->kurbanHewan->count() >= 1)
                        <a href="{{ route('kurbanhewan.create', ['kurban_id' => $kurban->id]) }}"
                            class="btn btn-primary">Buat Baru</a>
                    @endif


                    {{-- Jika kondisi Data Kurban masih kosong, maka tampilkan dibawah ini --}}
                    @if ($kurban->kurbanHewan->count() == 0)
                        <div class="text-center">Belum ada data.
                            <a href="{{ route('kurbanhewan.create', ['kurban_id' => $kurban->id]) }}">Buat Baru</a>
                        </div>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td width="1%">NO</td>
                                    <td>HEWAN</td>
                                    <td>IURAN</td>
                                    <td>HARGA</td>
                                    <td>BIAYA OPERASIONAL</td>
                                    <td>AKSI</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kurban->kurbanHewan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->hewan }} ({{ $item->kriteria }})</td>
                                        <td>{{ formatRupiah($item->iuran_perorang) }}</td>
                                        <td>{{ formatRupiah($item->harga) }}</td>
                                        <td>{{ formatRupiah($item->biaya_operasional) }}</td>
                                        <td>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['kurbanhewan.destroy', [$item->id, 'kurban_id' => $item->kurban_id]],
                                                'style' => 'display:inline',
                                            ]) !!}
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('kurbanhewan.edit', [$item->id, 'kurban_id' => $item->kurban_id]) }}"
                                                class="btn btn-sm btn-warning mb-1 mx-1">Edit</a>
                                            <button type="submit" class="btn btn-sm btn-danger mb-1 mx-1"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kas ini?')">Hapus</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif


                </div>
            </div>
        </div>

    </div>
@endsection