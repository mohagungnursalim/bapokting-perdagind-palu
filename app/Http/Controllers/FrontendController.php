<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use Illuminate\Http\Request;
use App\Models\Pangan;
use App\Models\Pasar;
use Illuminate\Support\Carbon;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pangans = Pangan::latest()->paginate(6);
        
        if (request('filter')) {
            $pangans = Pangan::where('jenis_barang', 'like', '%' . request('filter') . '%')->
                                orWhere('komoditas', 'like', '%' . request('filter') . '%')->
                                orWhere('pasar', 'like', '%' . request('filter') . '%')->
                                orWhere('periode', 'like', '%' . request('filter') . '%')
            ->latest()->paginate(6)->withQueryString();
        } 

       

        return view('index',compact('pangans'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $komoditas = Komoditas::find($id);

    //     return view('komoditas-show',compact($komoditas));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function allharga()
    // {
    //     $pangans = Pangan::latest()->get();
    //     return response()->json($pangans);
    // }

    public function komoditas()
    {

        $komoditas = Komoditas::latest()->get();
       
       

        return view('komoditas',compact('komoditas'));
    }

     public function showkomoditas(string $nama)
    {

       

        $now = Carbon::now()->subDay()->toDateString();

        $komoditas = Komoditas::where('nama', $nama)->first();
        $pasars = Pasar::latest()->get();
        $pangans = Pangan::where('komoditas', $nama)->where('periode',$now)->latest()->paginate(5)->withQueryString();

        if (request('pasar')){
            $pangans =  Pangan::where('pasar', 'like', '%' . request('pasar') . '%')->where('komoditas', $nama)->where('periode',$now)->latest()->paginate(5)->withQueryString();
        }

        
        

        return view('komoditas-show',compact('komoditas','pangans','pasars'));
    }

}
