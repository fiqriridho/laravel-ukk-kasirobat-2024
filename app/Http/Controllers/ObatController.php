<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obat = Obat::with('kategori')->get();
        $kategori = Kategori::all();
        return view('admin.obat.index', compact('obat', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $obat = Obat::with('kategori')->get();
        $kategori = Kategori::all();
        return view('admin.obat.index', compact('obat', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori_id' => 'required',
            'nama_obat' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'stok' => 'required',
            'exp' => 'required',

        ]);

        $obat = Obat::create([
            'kategori_id' => $request->input('kategori_id'),
            'nama_obat' => $request->input('nama_obat'),
            'harga' => $request->input('harga'),
            'keterangan' => $request->input('keterangan'),
            'stok' => $request->input('stok'),
            'exp' => $request->input('exp'),
        ]);

        if ($obat) {
            return redirect()->route('obat.index')->with(['success' => 'Data obat Berhasil Disimpan']);
        } else {
            return redirect()->route('obat.index')->with(['error' => 'Data obat Gagal Disimpan']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $obat = Obat::find($id);
        return view('admin.obat.show', compact('obat'));
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_obat' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'stok' => 'required|numeric|min:0',
            'exp' => 'required',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->nama_obat = $request->input('nama_obat');
        $obat->harga = $request->input('harga');
        $obat->keterangan = $request->input('keterangan');
        $obat->stok = $request->input('stok');
        $obat->exp = $request->input('exp');
        $obat->save();


        if ($obat) {
            return redirect()->route('obat.index')->with(['success' => 'Stok obat berhasil diperbarui']);
        } else {
            return redirect()->route('obat.index')->with(['error' => 'Gagal memperbarui stok obat']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        if ($obat) {
            return redirect()->route('obat.index')->with('success', 'Data Berhasil Dihapus!');
        } else {
            return redirect()->route('obat.index')->with('error', 'Data Gagal Dihapus');
        }
    }

}
