<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slip Gaji</title>

    <style>
        * {
            font-family: "consolas", sans-serif;
        }
        p {
            display: block;
            margin: 3px;
            font-size: 10pt;
        }
        table td {
            font-size: 9pt;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }

        @media print {
            @page {
                margin: 0;
                size: 75mm;
            }
            html, body {
                width: 70mm;
            }
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <button class="btn-print" style="position: absolute; right: 1rem; top: rem;" onclick="window.print()">Print</button>
    <div class="text-center">
        <h3 style="margin-bottom: 5px;">Perkebunan Bapak Dwi Haryanto</h3>
        <p>Blok V Batumarta XI</p>
    </div>
    <br>
    <div>
        <p style="float: left;">{{ date('d-m-Y') }}</p>
    </div>
    <div class="clear-both" style="clear: both;"></div>
    <p class="text-center">===================================</p>

    <br>
    <table width="100%">
        <tr>
            <td>Nama Karyawan</td>
            <td>Harga</td>
            <td>Total Hasil</td>
        </tr>
        <tr>
            <td>{{ $panen->karyawan->nama }}</td>
            <td>{{ formatToRupiah($panen->harga->harga_per_kg) }}</td>
            <td>{{ formatToKg($panen->total_hasil_kg) }}</td>
        </tr>
        <tr>
            <td colspan="2" class="text-right">Total Gaji : </td>
            <td>{{ formatToRupiah($panen->total_gaji) }}</td>
        </tr>
    </table>
    <p class="text-center">===================================</p>
    <p class="text-center">-- TERIMA KASIH --</p>
</body>
</html>
