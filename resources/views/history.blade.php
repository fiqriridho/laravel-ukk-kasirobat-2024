<!-- resources/views/admin/penjualan/history.blade.php -->
@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                <h3>History Transaksi</h3>
            </div>
            <div class="card-body container">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Nama Pelanggan</th>
                            <th>Nama Obat</th>
                            <th>Jenis Pembayaran</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penjualan as $no => $p)
                            <tr>
                                <th>{{ ++$no }}</th>
                                <td>{{ $p->user->name }}</td>
                                <td>{{ $p->pelanggan->name }}</td>
                                <td>{{ $p->obat->nama_obat }}</td>
                                <td>{{ $p->pembayaran->nama_pembayaran }}</td>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ $p->jumlah }}</td>
                                <td>{{ $p->total }}</td>
                                <td><a href="{{ route('cetak-struk', $p->id) }}" class="btn btn-primary" target="_blank">Cetak Struk</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">Belum ada data transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
