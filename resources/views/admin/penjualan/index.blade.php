@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                <h3>Tabel Transaksi</h3>
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
                                <td><a href="{{ route('cetak-struk', $p->id) }}" class="btn btn-primary"
                                        target="_blank">Cetak Struk</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('penjualan.store') }}" method="POST" onsubmit="return validateForm()">
                        @csrf
                        <div class="mb-3">
                            <label for="user" class="form-label">Nama Pengguna</label>
                            <select class="form-select" id="user" name="user_id">
                                <option value="" disabled selected>Pilih user</option>
                                @foreach ($user as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pelanggan" class="form-label">Nama Pengguna</label>
                            <select class="form-select" id="pelanggan" name="pelanggan_id">
                                <option value="" disabled selected>Pilih Pelanggan</option>
                                @foreach ($pelanggan as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="obat_id" class="form-label">Nama Obat</label>
                            <select class="form-select" name="obat_id" id="obat_id" aria-label="Pilih Obat">
                                <option value="" disabled selected>Pilih Obat</option>
                                @foreach ($obat as $data)
                                    <option value="{{ $data->id }}" data-harga="{{ $data->harga }}"
                                        data-stok="{{ $data->stok }}">
                                        {{ $data->nama_obat }} | Stok: {{ $data->stok }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pembayaran_id" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="pembayaran_id" name="pembayaran_id">
                                <option value="" disabled selected>Pilih Metode</option>
                                @foreach ($pembayaran as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_pembayaran }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label-sm">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" id="tanggal"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label-sm">Jumlah</label>
                            <input type="text" name="jumlah" id="jumlah" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label-sm">Total</label>
                            <input type="text" name="total" id="total" class="form-control" readonly>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        // Function to calculate total
        function validateForm() {
            var pembayaranId = document.getElementById('pembayaran_id').value;
            if (pembayaranId === '') {
                alert('Harap pilih metode pembayaran!');
                return false;
            }
            return true;
        }

        function calculateTotal() {
            var selectedObat = document.getElementById('obat_id').options[document.getElementById('obat_id').selectedIndex];
            var harga = parseFloat(selectedObat.dataset.harga);
            var stok = parseInt(selectedObat.dataset.stok);
            var jumlah = parseInt(document.getElementById('jumlah').value);

            if (jumlah > stok) {
                alert('Jumlah melebihi stok yang tersedia!');
                return false;
            }

            var total = harga * jumlah;
            document.getElementById('total').value = total.toFixed(2); // Fix to 2 decimal places

            // Move total to the bottom input
            document.getElementById('total_bottom').value = total.toFixed(2);
        }

        // Event listener for change in obat selection
        document.getElementById('obat_id').addEventListener('change', function() {
            calculateTotal();
        });

        // Event listener for input in jumlah
        document.getElementById('jumlah').addEventListener('input', function() {
            calculateTotal();
        });

        // Function to validate form before submission
    </script>
@endpush
