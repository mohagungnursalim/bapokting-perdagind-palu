<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use App\Models\Pangan;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;

class KomoditasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $komoditas = Komoditas::latest()->paginate(10);

        if (request('search')) {
            $komoditas = Komoditas::where('nama', 'like', '%' . request('search') . '%')->latest()->paginate(10);
        } 
        
        
        
        
        return view('dashboard.komoditas.index',[
            'komoditas' => $komoditas
        ]);
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
       $validatedData = $request->validate([
            'nama' => 'required',
            'image' => 'required'       
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('komoditas-image','public');
        }

        Komoditas::create($validatedData);
        $request->session(Alert::success('success', 'Data berhasil ditambahkan!'));
        return redirect('/dashboard/komoditas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Komoditas $komoditas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komoditas $komoditas)
    {
        
        return view('dashboard.komoditas.edit', [
            'komoditas' => $komoditas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Komoditas $komoditas, $id)
    {
        $komoditas = Komoditas::find($id);
        

       $validatedData = $request->validate([
            'nama' => 'required',
            'image' => 'required'     
        ]);
       
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('komoditas-image','public');
        }

        
        $komoditas->update($validatedData);
        

            $request->session(Alert::success('success', 'Komoditas berhasil diupdate!'));
            return redirect('/dashboard/komoditas');

           
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komoditas $komoditas,Request $request,$id)
    {

        $komoditas = Komoditas::find($id);

        
        $komoditas->delete();

        $request->session(Alert::success('success', 'Komoditas berhasil dihapus!'));
            return redirect('/dashboard/komoditas');
    }

    
}
