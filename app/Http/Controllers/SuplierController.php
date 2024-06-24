<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suplier;

class SuplierController extends Controller
{
    //
    public function index()
    {
        $suplier = Suplier::all();
        return view('suplier.index', compact('suplier'));
    }

    public function create()
    {
        return view('suplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
        ]);

        Suplier::create($request->all());

        return redirect()->route('suplier.index')
            ->with('success', 'Suplier created successfully.');
    }

    public function edit(Suplier $suplier)
    {
        return view('suplier.edit', compact('suplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
        ]);

        Suplier::find($id)->update($request->all());

        return redirect()->route('suplier.index')
            ->with('success', 'Suplier updated successfully');
    }

    public function destroy($id)
    {
        Suplier::destroy($id);
        return redirect()->route('suplier.index')
            ->with('success', 'Suplier deleted successfully');
    }

}
