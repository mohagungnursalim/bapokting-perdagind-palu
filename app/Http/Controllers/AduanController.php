<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Exports\AduanExport;
use Alert;
use Maatwebsite\Excel\Facades\Excel;
class AduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        
        
        return view('aduan');
    }

    // dashboard index aduan
    public function aduan()
    {

        if (auth()->user()->is_admin == true) {
            $aduans = Aduan::latest()->paginate(20);
        }else {
            
            $aduans = Aduan::where('pasar', auth()->user()->operator)->latest()->paginate(20);
        }

        // $aduans = Aduan::paginate(20);

        if (auth()->user()->is_admin == true) {
            if (request('search')) {
                $aduans = Aduan::where('nama', 'like', '%' . request('search') . '%')->
                                 orWhere('no_hp', 'like', '%' . request('search') . '%')->
                                 orWhere('pasar', 'like', '%' . request('search') . '%')->
                                 orWhere('isi_aduan', 'like', '%' . request('search') . '%')->
                                 
                latest()->paginate(20);
                
            } 
        }elseif (auth()->user()->is_admin == false) {

            // if (request('search')) {

            //     $aduans = Aduan::where('nama', 'like', '%' . request('search') . '%')->where('pasar', Auth::user()->operator)->                           
            //                      orWhere('no_hp', 'like', '%' . request('search') . '%')->
            //                      orWhere('isi_aduan', 'like', '%' . request('search') . '%')->
            //                      orWhere('pasar', 'like', '%' . request('search') . '%')->                           
            //     latest()->paginate(20);
                
            if (request('search')) {
                $aduans = Aduan::where(function ($query) {
                    $query->where(function ($subquery) {
                        $subquery->where('nama', 'like', '%' . request('search') . '%')
                                 ->orWhere('no_hp', 'like', '%' . request('search') . '%')
                                 ->orWhere('isi_aduan', 'like', '%' . request('search') . '%');
                    })
                    ->where(function ($subquery) {
                        $subquery->where('pasar', Auth::user()->operator)
                                 ->orWhere('pasar', 'like', '%' . request('search') . '%');
                    });
                })->latest()->paginate(20);
            }
        }

       


        return view('dashboard.aduan.index',compact('aduans'));
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
            $validatedData['gambar'] = $request->file('gambar')->store('aduan-image','public');
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
    public function destroy(Aduan $aduan,Request $request,$id)
    {
        $aduan = Aduan::find($id);

        
        $aduan->delete();

        $request->session(Alert::success('success', 'Aduan berhasil dihapus!'));
            return redirect('/dashboard/aduan-masuk');
    }

    public function export(Request $request, Aduan $aduan)
    {
        
        if (request('periode')) {
            $aduan = Aduan::where('created_at', 'like', '%' . request('periode') . '%')->get();

            return Excel::download(new AduanExport($aduan), 'Aduan Masyarakat.xlsx');
       
        }
    
    
        return Excel::download(new AduanExport(), 'Aduan Masyarakat.xlsx');
        
    }
}
