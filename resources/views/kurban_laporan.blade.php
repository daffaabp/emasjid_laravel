@extends('layouts.app_adminkit_laporan')

@section('content')
    <h2 class="m-5 text-center">LAPORAN DATA KURBAN TAHUN {{ $kurban->tahun_hijriah . 'H/' . $kurban->tahun_masehi }}M
    </h2>
    <div class="row">
        <div class="col-12">
            <div class="card-header">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <h3>Tahun Kurban {{ $kurban->tahun_hijriah . '/' . $kurban->tahun_masehi }}</h3>
                    </div>
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

                    {{-- Jika kondisi Data Kurban masih kosong, maka tampilkan dibawah ini --}}
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <td width="1%">NO</td>
                                <td>HEWAN</td>
                                <td>IURAN</td>
                                <td>HARGA</td>
                                <td>BIAYA OPERASIONAL</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>




                    {{-- Modul Peserta Kurban --}}
                    <hr>
                    <h3>Data Peserta Kurban</h3>
                    {{-- Jika kondisi Data Kurban masih kosong, maka tampilkan dibawah ini --}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td width="1%">NO</td>
                                <td>NAMA</td>
                                <td>NOMOR HP</td>
                                <td>ALAMAT</td>
                                <td>JENIS HEWAN</td>
                                <td>STATUS PEMBAYARAN</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kurban->kurbanPeserta as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div>{{ $item->peserta->nama }}</div>
                                        <div>({{ $item->peserta->nama_tampilan }})</div>
                                    </td>
                                    <td>{{ $item->peserta->nohp }}</td>
                                    <td>{{ $item->peserta->alamat }}</td>
                                    <td>
                                        {{ ucwords($item->kurbanHewan->hewan) }} -
                                        {{ $item->kurbanHewan->kriteria }} -
                                        {{ formatRupiah($item->kurbanHewan->iuran_perorang) }}
                                    </td>
                                    <td>
                                        @if ($item->status_bayar == 'lunas')
                                            <span class="badge bg-success me-1 my-1">{{ $item->getStatusTeks() }}</span>
                                        @else
                                            <span class="badge bg-secondary me-1 my-1">{{ $item->getStatusTeks() }}</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="h4">Total Peserta: {{ $kurban->kurbanPeserta->count() }}</div>
                    <div class="h4">Total Sudah
                        Bayar:{{ $kurban->kurbanPeserta->where('status_bayar', 'lunas')->count() }}</div>
                    <div class="h4">Total Iuran Peserta: {{ formatRupiah($kurban->kurbanPeserta->sum('total_bayar')) }}
                    </div>
                    <div class="h4">Total Peserta Sudah Bayar:
                        {{ formatRupiah($kurban->kurbanPeserta->where('status_bayar', 'lunas')->sum('total_bayar')) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
