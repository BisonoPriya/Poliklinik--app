<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obat.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'nama_obat'=> $request->nama_obat,
        'kemasan' => $request->kemasan,
        'harga'=> $request->harga
    ]);
    return redirect()->route('obat.index')
    ->with('massage','Data Obat Berhasil dibuat')
    ->with('type','succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $obat = Obat::findorFail($id);
        return view('view.obat.edit')->with([
            'obat'=> $obat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'nama_obat'=> 'required|string',
        'kemasan' => 'required|string',
        'harga'=> 'required|integer',
    ]);
         $obat = Obat::findorFail($id);
         $obat->update([
        'nama_obat'=> $request->nama_obat,
        'kemasan' => $request->kemasan,
        'harga'=> $request->harga
         ]);
         return redirect()->route('obat.index')
            ->with('massage','Data Obat Berhasil diedit')
            ->with('type','succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obat = Obat::findorFail($id);
        $obat->delete();
         return redirect()->route('obat.index')
            ->with('massage','Data Obat Berhasil dihapus')
            ->with('type','succes');
    }
}
