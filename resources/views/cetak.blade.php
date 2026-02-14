<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk</title>
    <style>
        /* Define your CSS styles for the print view here */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .row span {
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Struk Transaksi</h1>
        <div class="row">
            <span>Nama Obat:</span>
            <span>{{ $penjualan->obat->nama_obat }}</span>
        </div>
        <div class="row">
            <span>Jumlah:</span>
            <span>{{ $penjualan->jumlah }}</span>
        </div>
        <div class="row">
            <span>Total:</span>
            <span>Rp {{ number_format($penjualan->total, 0, ',', '.') }}</span>
        </div>
        <div class="footer">
            Terima kasih atas pembelian Anda.
        </div>
    </div>

    <!-- Script untuk otomatis mengarahkan ke halaman cetak saat halaman dimuat -->
    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>

</html>
