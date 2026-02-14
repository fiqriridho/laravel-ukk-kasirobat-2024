<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = Penjualan::with('obat', 'user', 'pelanggan', 'pembayaran')->get();
        $obat = Obat::all();
        $user = User::all();
        $pelanggan = Pelanggan::all();
        $pembayaran = Pembayaran::all();
        return view('admin.penjualan.index', compact('penjualan', 'obat', 'user', 'pelanggan', 'pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penjualan = Penjualan::all();
        $obat = Obat::all();
        $user = User::all();
        $pelanggan = Pelanggan::all();
        $pembayaran = Pembayaran::all();
        return view('admin.penjualan.index', compact('penjualan', 'obat', 'user', 'pelanggan', 'pembayaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'pembayaran_id' => 'required|exists:pembayarans,id',
            'obat_id' => 'required|exists:obats,id',
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
        ]);

        // Periksa stok obat
        $obat = Obat::findOrFail($request->input('obat_id'));
        $stok = $obat->stok;
        $jumlah_diminta = $request->input('jumlah');

        if ($jumlah_diminta > $stok) {
            return redirect()->back()->with('error', 'Stok obat tidak mencukupi.');
        }

        // Hitung total harga
        $harga_obat = $obat->harga;
        $total = $harga_obat * $jumlah_diminta;

        // Simpan data penjualan
        $penjualan = new Penjualan([
            'pelanggan_id' => $request->input('pelanggan_id'),
            'pembayaran_id' => $request->input('pembayaran_id'),
            'obat_id' => $request->input('obat_id'),
            'user_id' => $request->input('user_id'),
            'tanggal' => $request->input('tanggal'),
            'jumlah' => $jumlah_diminta,
            'total' => $total,
        ]);

        $penjualan->save();

        // Update stok obat
        $obat->stok -= $jumlah_diminta;
        $obat->save();

        return redirect('/penjualan')->with('success', 'Data Successfully Saved!');
    }

    public function cetakStruk($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        return view('cetak', compact('penjualan'));
    }

    public function history()
    {
        $penjualan = Penjualan::with('obat', 'user', 'pelanggan', 'pembayaran')->get();
        return view('history', compact('penjualan'));
    }
}
