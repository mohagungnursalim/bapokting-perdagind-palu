<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Alert;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::latest()->paginate(10);

        if (request('search')) {
            $barangs = Barang::where('nama', 'like', '%' . request('search') . '%')->latest()->paginate(10);
        } 
        
        return view('dashboard.barang.index',compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',       
        ]);

        Barang::create($request->all());
        $request->session(Alert::success('success', 'Barang berhasil ditambahkan!'));
        return redirect('/dashboard/barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        $barang->nama = $request->input('nama');

        $request->validate([
            'nama' => 'required',       
        ]);
       
        $barang->update($request->all());
        

            $request->session(Alert::success('success', 'Barang berhasil diupdate!'));
            return redirect('/dashboard/barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
       
        $barang = Barang::find($id);

        
        $barang->delete();

        $request->session(Alert::success('success', 'Barang berhasil dihapus!'));
            return redirect('/dashboard/barang');
    }
}
