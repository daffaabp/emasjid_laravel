@extends('layouts.app_adminkit')
@section('js')
    <script>
        $(document).ready(function() {
            $("#cetak").click(function(e) {
                var tanggalMulai = $("#tanggal_mulai").val();
                var tanggalSelesai = $("#tanggal_selesai").val();
                var q = $("#q").val();
                params = "?page=laporan&tanggal_mulai=" + tanggalMulai + "&tanggal_selesai=" +
                    tanggalSelesai + "&q=" + q;
                window.open("/kas" + params, "_blank");
            })
        });
    </script>
@endsection

@section('content')
    <h1 class="h3 mb-3">Kas Masjid</h1>
    <div class="row">
        <div class="card">
            <div class="card-body">
                {!! Form::open([
                    'url' => url()->current(),
                    'method' => 'GET',
                ]) !!}

                {{-- Bootstrap 5.2 Horizontal Form --}}
                <div class="d-flex bd-highlight mb-3 align-items-center">
                    <div class="me-auto bd-highlight">
                        <a href="{{ route('kas.create') }}" class="btn btn-primary">Tambah Data Kas</a>
                    </div>
                    <div class="bd-highlight mx-1">
                        {!! Form::label('tm', 'Tanggal Mulai', []) !!}
                        {!! Form::date('tanggal_mulai', request('tanggal_mulai'), [
                            'class' => 'form-control',
                            'placeholder' => 'Tanggal Mulai',
                            'id' => 'tanggal_mulai',
                        ]) !!}
                    </div>
                    <div class="bd-highlight mx-1">
                        {!! Form::label('tm', 'Tanggal Selesai', []) !!}
                        {!! Form::date('tanggal_selesai', request('tanggal_selesai'), [
                            'class' => 'form-control',
                            'placeholder' => 'Tanggal Selesai',
                            'id' => 'tanggal_selesai',
                        ]) !!}
                    </div>
                    <div class="bd-highlight me-1">
                        {!! Form::label('tm', 'Keterangan', []) !!}
                        {!! Form::text('q', request('q'), [
                            'class' => 'form-control',
                            'placeholder' => 'Keterangan Transaksi',
                            'id' => 'q',
                        ]) !!}
                    </div>
                    <div class="bd-highlight">
                        <button type="submit" class="btn btn-primary mt-3"
                            style="margin-top:20px !important;">Cari</button>
                        <button target="blank" type="button" class="btn btn-primary mt-3"
                            style="margin-top:20px !important;" id="cetak">Cetak Laporan </button>
                    </div>
                </div>
                {!! Form::close() !!}

                <div class="table-responsive mt-3">
                    <table class="{{ config('app.table_style') }}">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Diinputkan Oleh</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th class="text-end">Pemasukkan</th>
                                <th class="text-end">Pengeluaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->createdBy->name }}</td>
                                    <td>{{ $item->tanggal->translatedFormat('d-m-Y') }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td class="text-end">
                                        {{ $item->jenis == 'masuk' ? formatRupiah($item->jumlah) : '-' }}
                                    </td>
                                    <td class="text-end">
                                        {{ $item->jenis == 'keluar' ? formatRupiah($item->jumlah) : '-' }}
                                    </td>
                                    <td>

                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['kas.destroy', $item->id],
                                            'style' => 'display:inline',
                                        ]) !!}
                                        @csrf
                                        <a href="{{ route('kas.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary mb-1 mx-1">Edit</a>
                                        <button type="submit" class="btn btn-sm btn-danger mb-1 mx-1"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kas ini?')">Hapus</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        {{-- Penambahan Footer untuk menampilkan Total Jumlah --}}
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-center fw-bold">TOTAL</td>
                                <td class="text-end">{{ formatRupiah($totalPemasukan) }}</td>
                                <td class="text-end">{{ formatRupiah($totalPengeluaran) }}</td>
                            </tr>
                        </tfoot>

                    </table>
                </div>

                <h3>Saldo AkhirRp. {{ formatRupiah($saldoAkhir) }}</h3>
                {{ $kas->links() }}
            </div>
        </div>

    </div>
@endsection
