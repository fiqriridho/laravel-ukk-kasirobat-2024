public function store(Request $request)
{
$request->validate([
'pelanggan_id' => 'required|exists:pelanggans,id',
'pembayaran_id' => 'required|exists:pembayarans,id',
'obat_id' => 'required|exists:obats,id',
'user_id' => 'required|exists:users,id',
'tanggal' => 'required|date',
'jumlah' => 'required|numeric|min:1',
]);

$obat = Obat::findOrFail($request->input('obat_id'));

// Validasi stok obat
if ($obat->stok < $request->input('jumlah')) {
    return redirect()->back()->with('error', 'Stok obat tidak cukup!');
    }

    // Kurangi stok obat
    $obat->stok -= $request->input('jumlah');
    $obat->save();

    $harga_obat = $obat->harga;

    $total = $harga_obat * $request->input('jumlah');

    $penjualan = new Penjualan([
    'pelanggan_id' => $request->input('pelanggan_id'),
    'pembayaran_id' => $request->input('pembayaran_id'),
    'obat_id' => $request->input('obat_id'),
    'user_id' => $request->input('user_id'),
    'tanggal' => $request->input('tanggal'),
    'jumlah' => $request->input('jumlah'),
    'total' => $total,
    ]);

    $penjualan->save();

    return redirect('/penjualan')->with('success', 'Data berhasil disimpan!');
    }
