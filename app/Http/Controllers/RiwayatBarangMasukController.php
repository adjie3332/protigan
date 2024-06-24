<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\BarangMasuk;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class RiwayatBarangMasukController extends Controller
{
    public function index()
    {
        $barang_masuk = BarangMasuk::all();
        $barang = Barang::all();
        return view('RiwayatMasuk.index', compact('barang_masuk', 'barang'));
    }

    public function cetakPdf()
    {
        $barang_masuk = BarangMasuk::all();
        $barang = Barang::all();
        $pdf = PDF::loadView('RiwayatMasuk.cetak-pdf', compact('barang_masuk', 'barang'));
        return $pdf->download('riwayat-barang-masuk.pdf');
    }

    public function cetakExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        // Judul
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'Riwayat Barang Masuk');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // Kolom Lebar
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);

        // Header Table
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Barang');
        $sheet->setCellValue('C2', 'Jenis Barang');
        $sheet->setCellValue('D2', 'Suplier');
        $sheet->setCellValue('E2', 'Jumlah Masuk');
        $sheet->setCellValue('F2', 'Tanggal Masuk');

        $barang_masuk = BarangMasuk::all();
        $no = 1;
        $cell = 3;
        foreach ($barang_masuk as $data) {
            $sheet->setCellValue('A' . $cell, $no++);
            $sheet->setCellValue('B' . $cell, $data->barang->nama_barang);
            $sheet->setCellValue('C' . $cell, $data->barang->jenis_barang->jenis_barang);
            $sheet->setCellValue('D' . $cell, $data->suplier->nama_suplier);
            $sheet->setCellValue('E' . $cell, $data->jumlah_masuk);
            $sheet->setCellValue('F' . $cell, $data->tanggal_masuk);
            $cell++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'riwayat-barang-masuk.xlsx';
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
