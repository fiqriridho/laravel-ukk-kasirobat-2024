@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                <h3>Tabel Obat</h3>
            </div>
            <div class="card-body container">
                <div class="my-2">
                    <form action="create" method="get">
                        <div class="form-group">
                            <a href="#">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#tambah"
                                    class="btn btn-primary">Tambah Data</button>
                            </a>
                        </div>
                    </form>
                </div>
                <table class="table table-hoverd">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembayaran as $no => $o)
                            <tr>
                                <th>{{ ++$no }}</th>
                                <td>{{ $o->nama_pembayaran }}</td>
                            @empty
                        @endforelse
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@push('modal')
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pembayaran.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"></label>
                            <input type="text" class="form-control"
                                @error('nama_pembayaran')
                                is-invalid
                            @enderror
                                name ="nama_pembayaran" placeholder="Masukkan Nama Pembayaran"
                                @error('nama_pembayaran')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
