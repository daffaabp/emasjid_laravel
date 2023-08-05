@extends('layouts.app_adminkit_laporan')
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
    <h1 class="h3 text-center">{{ auth()->user()->masjid->nama }}</h1>
    <p class="mb-3 text-center">{{ auth()->user()->masjid->alamat }}</p>
    <div class="row m-3">
        <div class="col">
            <div class="table-responsive mt-3">
                <h5>Laporan Kas Masjid</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="1%">NO</th>
                            <th width="12%">Diinputkan Oleh</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th class="text-end">Pemasukkan</th>
                            <th class="text-end">Pengeluaran</th>
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
                            </tr>
                        @endforeach
                    </tbody>

                    {{-- Penambahan Footer untuk menampilkan Total Jumlah --}}
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-center fw-bold">TOTAL</td>
                            <td class="text-end">{{ formatRupiah($totalPemasukan) }}</td>
                            <td class="text-end">{{ formatRupiah($totalPengeluaran) }}</td>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>

    </div>
@endsection
