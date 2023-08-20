<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;

class AduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('aduan');
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
            'no_hp' => 'required',
            'pasar' => 'required',
            'gambar' => 'required',
            'isi_aduan' => 'required'
        ]);

        if($request->file('gambar')){
            $validatedData['gambar'] = $request->file('gambar')->store('komoditas-image','public');
        }

        Aduan::create($validatedData);
       
        return redirect('/aduan-pasar')->with('status', 'Aduan telah disampaikan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aduan $aduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aduan $aduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aduan $aduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aduan $aduan)
    {
        //
    }
}
