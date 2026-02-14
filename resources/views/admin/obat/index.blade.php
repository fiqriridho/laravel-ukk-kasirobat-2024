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
                            <th>Nama Kategori</th>
                            <th>Nama Obat</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>Stok</th>
                            <th>Expired</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($obat as $no => $o)
                            <tr>
                                <th>{{ ++$no }}</th>
                                <td>{{ $o->kategori->nama_kategori }}</td>
                                <td>{{ $o->nama_obat }}</td>
                                <td>{{ $o->harga }}</td>
                                <td>{{ $o->keterangan }}</td>
                                <td>{{ $o->stok }}</td>
                                <td>{{ $o->exp }}</td>
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#edit-{{ $o->id }}"
                                        class="btn btn-success">Edit</button>
                                    <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#delete-{{ $o->id }}" class="btn btn-danger">Hapus</button>
                                </td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('obat.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <select class="form-select" name="kategori_id" aria-label="Pilih Kategori">
                                <option disabled selected> Pilih Kategori</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                @endforeach

                            </select @error('nama_kategori') is-invalid @enderror>
                            @error('nama_kategori')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" name="nama_obat"
                                placeholder="Masukkan Nama Obat dengan Benar">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" placeholder="Tambahkan Keterangan">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" name="stok"
                                placeholder="Masukkan Stok dengan Benar">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expired</label>
                            <input type="date" class="form-control" name="exp">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Edit-->
    @foreach ($obat as $o)
        <div class="modal fade" id="edit-{{ $o->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('obat.update', $o->id) }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <select class="form-select" name="kategori_id" aria-label="Pilih Kategori">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('nama_kategori')
                                    is-invalid
                                @enderror


                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Obat</label>
                                <input type="text" class="form-control" name="nama_obat"
                                    value="{{ old('nama_obat', $o->nama_obat) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga"
                                    value="{{ old('harga', $o->harga) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan"
                                    value="{{ old('keterangan', $o->keterangan) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" class="form-control" name="stok"
                                    value="{{ old('stok', $o->stok) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Expired</label>
                                <input type="date" class="form-control" name="exp"
                                    value="{{ old('exp', $o->exp) }}">
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($obat as $o)
        <div class="modal fade" id="delete-{{ $o->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data <b>{{ $o->nama_obat }}</b></p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                        <form action="{{ route('obat.destroy', $o->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
