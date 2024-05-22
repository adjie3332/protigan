<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Keuangan</title>

    <style>
        * {
            {{-- font-family: "consolas", sans-serif; --}}
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <h2 class="text-center">Laporan Keuangan Perkebunan Karet Bapak Dwi Haryanto</h2>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th width="20px">No.</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?> {{-- Inisialisasi nomor urut --}}            
            {{-- Loop untuk menampilkan data dari $panen --}}
            @if ($panen->count() > 0)
                @foreach ($panen as $item)
                    <tr>
                        <td>{{ $i++ }}</td> {{-- Tampilkan dan tambahkan nomor urut --}}
                        <td>{{ formatToDate($item->tanggal_panen) }}</td>
                        <td>Hasil dari {{ $item->karyawan->nama }}</td>
                        <td>{{ formatToRupiah($item->hasil_pemilik) }}</td>
                        <td>-</td>
                    </tr>
                @endforeach
            @endif

            {{-- Loop untuk menampilkan data dari $pengeluaran --}}
            @if ($pengeluaran->count() > 0)
                @foreach ($pengeluaran as $item)
                    <tr>
                        <td>{{ $i++ }}</td> {{-- Tampilkan dan tambahkan nomor urut --}}
                        <td>{{ formatToDate($item->tanggal_masuk) }}</td>
                        <td>Membeli {{ $item->inventory->nama_barang }}</td>
                        <td>-</td>
                        <td>{{ formatToRupiah($item->harga) }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th>{{  formatToRupiah($panen->sum('hasil_pemilik')) }}</th>
                <th>{{  formatToRupiah($pengeluaran->sum('harga')) }}</th>
            </tr>
            <tr>
                <th colspan="3">Saldo</th>
                <th colspan="2" class="text-center">{{  formatToRupiah($panen->sum('hasil_pemilik') - $pengeluaran->sum('harga')) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>