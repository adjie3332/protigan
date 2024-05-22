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
    <h2 class="text-center">Laporan Data Cuti Karyawan</h2>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th width="20px">No.</th>
                <th>Nama Karyawan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Total Hari</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?> {{-- Inisialisasi nomor urut --}}
            @foreach ($cuti as $item)
                <tr>
                    <td>{{ $i++ }}</td> {{-- Tampilkan dan tambahkan nomor urut --}}
                    <td>{{ $item->karyawan->nama }}</td>
                    <td>{{ formatToDate($item->tanggal_mulai) }}</td>
                    <td>{{ formatToDate($item->tanggal_selesai) }}</td>
                    <td>{{ $item->total_hari }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>