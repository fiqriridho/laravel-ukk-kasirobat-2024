@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                <h3>Tabel Kategori Obat</h3>
            </div>
            <div class="card-body container">
                <div class="my-2">
                    <form action="create" method="get">
                        <div class="form-group">
                            <a href="#">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#tambah"
                                    class="btn btn-primary btn-md">Tambah Data</button>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($kategori as $no => $k)
                                <tr>
                                    <th scope="row">{{ ++$no }}</th>
                                    <td>{{ $k->nama_kategori }}</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{ $k->id }}"
                                            class="btn btn-success btn-md">Edit</a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete{{ $k->id }}"
                                            class="btn btn-danger btn-md">Hapus</a>
                                    </td>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('modal')
    {{-- modal --}}
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"></label>
                            <input type="text" class="form-control"
                                @error('nama_kategori')
                                is-invalid
                            @enderror
                                name ="nama_kategori" placeholder="Masukkan Nama Kategori"
                                @error('nama_kategori')
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

    {{-- modal edit --}}
    @foreach ($kategori as $k)
        <div class="modal fade" id="edit{{ $k->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kategori.update', $k->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control"
                                    @error('nama_kategori')
                                is-invalid
                            @enderror
                                    name ="nama_kategori" value="{{ old('nama_kategori', $k->nama_kategori) }}"
                                    placeholder="Masukkan Nama Kategori">

                                @error('nama_kategori')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @error('kompetensi_keahlian')
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
    @endforeach

    {{-- modal hapus --}}
    @foreach ($kategori as $k)
        <div class="modal fade" id="delete{{ $k->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin Ingin Menghapus Data <b>{{ $k->nama_kategori }}</b></p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <form action="{{ route('kategori.destroy', $k->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>

                        </form>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    @endforeach
@endpush
