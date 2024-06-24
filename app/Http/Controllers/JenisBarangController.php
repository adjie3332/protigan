<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;

class JenisBarangController extends Controller
{
    public function index()
    {
        $jenis_barang = JenisBarang::all();
        return view('JenisBarang.index', compact('jenis_barang'));
    }

    public function create()
    {
        return view('jenis_barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_barang' => 'required',
        ]);

        JenisBarang::create($request->all());

        return redirect()->route('jenis-barang.index')
            ->with('success', 'Jenis Barang created successfully.');
    }

    public function edit(JenisBarang $jenis_barang)
    {
        return view('jenis_barang.edit', compact('jenis_barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_barang' => 'required',
        ]);

        $jenis_barang = JenisBarang::findOrFail($id);
        $jenis_barang->update($request->all());

        return redirect()->route('jenis-barang.index')
            ->with('success', 'Jenis Barang updated successfully');
    }

    public function destroy($id)
    {
        $jenis_barang = JenisBarang::findOrFail($id);
        $jenis_barang->delete();

        return redirect()->route('jenis-barang.index')
            ->with('success', 'Jenis Barang deleted successfully');
    }
}
