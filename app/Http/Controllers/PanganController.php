<?php

namespace App\Http\Controllers;

use App\Models\Pangan;
use App\Models\Komoditas;
use App\Models\User;
use App\Models\Pasar;
use App\Models\Satuan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Alert;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exports\DataTableExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class PanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // -----------------------------------------------
        
        // Post::with('category')->get();
        $komoditas = Komoditas::select('nama')->latest()->get();
        $pasar = Pasar::select('nama')->latest()->get();
        $satuan = Satuan::select('nama')->oldest()->get();
        $barangs = Barang::select('nama')->latest()->get();
        

        if (auth()->user()->is_admin == true) {
            $pangan = Pangan::latest()->paginate(8);
        }else {
            
            $pangan = Pangan::where('user_id', auth()->user()->id)->latest()->paginate(10);
        }

        if (auth()->user()->is_admin == true) {
            if (request('periode')){
                $pangan =  Pangan::where('periode', 'like', '%' . request('periode') . '%')->paginate(10);
            }
            if (request('komoditas')){
                $pangan =  Pangan::where('komoditas', 'like', '%' . request('komoditas') . '%')->latest()->paginate(10);
            }
            if (request('pasar')){
                $pangan =  Pangan::where('pasar', 'like', '%' . request('pasar') . '%')->paginate(10);
            }
        }else {
            
            if (request('periode')){
                $pangan =  Pangan::where('periode', 'like', '%' . request('periode') . '%')->where('user_id', auth()->user()->id)->latest()->paginate(10);
            }
            if (request('komoditas')){
                $pangan =  Pangan::where('komoditas', 'like', '%' . request('komoditas') . '%')->where('user_id', auth()->user()->id)->paginate(10);
            }
            if (request('pasar')){
                $pangan =  Pangan::where('pasar', 'like', '%' . request('pasar') . '%')->where('user_id', auth()->user()->id)->paginate(10);
            }
        }


        return view('dashboard.data.index',[
            'pangans' => $pangan,
            'komoditas' => $komoditas,
            'pasars' => $pasar,
            'satuans' => $satuan,
            'barangs' => $barangs
        ]);
    }
   
    /**
     * Show the form for creating a new resource.
     */
    public function create(Komoditas $komoditas)
    {
        return view('dashboard.data.create', [
            'title' => 'Input Data',
            'komoditas' => Komoditas::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pangan $pangan)
    {

        // custom pesan error
        $messages = [
            'required' => ':attribute Wajib diisi!',
            'exists' => ':attribute Wajib diisi!'
        ];
       

        // validasi input
        $request->validate([
            'pasar' => 'required|exists:pasars,nama',
            'komoditas' => 'required|exists:komoditas,nama',
            'satuan' => 'required|exists:satuans,nama',
            'jenis_barang' => 'required|exists:barangs,nama',
            'harga' => 'required',
            'periode' => 'required'
        ],$messages);

        
        $komoditas = $request->input('komoditas');
        $pasar = $request->input('pasar');
        $user_id = $request['user_id'] = auth()->user()->id;
        $satuan = $request->input('satuan');
        $jenis_barang = $request->input('jenis_barang');
        $periode = $request->input('periode');
        $harga_sebelum = $request->input('harga_sebelum');
        $harga_terkini = $request->input('harga');
        
        // Membandingkan harga
    
    if (isset($harga_sebelum)) {
        if ($harga_terkini > $harga_sebelum ) {
            $keterangan = 'Naik';
        } elseif ($harga_terkini < $harga_sebelum) {
            $keterangan = 'Turun';
        } elseif ($harga_terkini == $harga_sebelum) {
            $keterangan = 'Tetap';
        } 
    } else {
        $keterangan = 'Tetap' ;
    }
        
       

        $data = new Pangan();

        
        $data->user_id  = $user_id;
        $data->komoditas = $komoditas;
        $data->pasar = $pasar;
        $data->satuan = $satuan;
        $data->jenis_barang = $jenis_barang;
        $data->periode = $periode;
        $data->harga_sebelum = $harga_sebelum;
        $data->harga = $harga_terkini;
        $data->keterangan = $keterangan;

        // Pangan::create($data);

        // dd($data);
        $data->save();

        $request->session(Alert::success('success', 'Data berhasil terinput!'));
        return redirect('/dashboard/master-data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pangan $pangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pangan $pangan,Komoditas $komoditas)
    {
        return view('dashboard.data.edit', [
            'komoditas' => $komoditas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pangan $pangan, $id)
    {
        
        $komoditas = $request->input('komoditas');
        $pasar = $request->input('pasar');
        $user_id = $request['user_id'] = auth()->user()->id;
        $satuan = $request->input('satuan');
        $jenis_barang = $request->input('jenis_barang');
        $periode = $request->input('periode');
        $harga_sebelum = $request->input('harga_sebelum');
        $harga_terkini = $request->input('harga');
        

        if (isset($harga_sebelum)) {
            if ($harga_terkini > $harga_sebelum ) {
                $keterangan = 'Naik';
            } elseif ($harga_terkini < $harga_sebelum) {
                $keterangan = 'Turun';
            } elseif ($harga_terkini == $harga_sebelum) {
                $keterangan = 'Tetap';
            } 
        } else {
            $keterangan = 'Tetap' ;
        }

        $pangan = Pangan::find($id);
       
        $pangan->komoditas = $komoditas;
        $pangan->user_id  = $user_id;
        $pangan->pasar = $pasar;
        $pangan->satuan = $satuan;
        $pangan->jenis_barang = $jenis_barang;
        $pangan->periode = $periode;
        $pangan->harga_sebelum = $harga_sebelum;
        $pangan->harga = $harga_terkini;
        $pangan->keterangan = $keterangan;
        
        $pangan->update();
        

            $request->session(Alert::success('success', 'Data berhasil diupdate!'));
            return redirect('/dashboard/master-data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Pangan $pangan,$id)
    {

        $pangan = Pangan::find($id);


        $pangan->delete();

        $request->session(Alert::success('success', 'Data berhasil dihapus!'));
            return redirect('/dashboard/master-data');
    }




    public function dashboard(Pangan $pangan)
    {

        if (auth()->user()->is_admin == false) {
            $pangan = Pangan::where('user_id', auth()->user()->id)->count();
        } else {
            $pangan = Pangan::all()->count();
        }
        
        $komoditas = Komoditas::all()->count();
        
        $user = User::all()->count();
        
        $satuan = Satuan::all()->count();

        
        $pasar = Pasar::all()->count();
        
        return view('dashboard.dashboard',[
            'pangan' => $pangan,
            'komoditas' => $komoditas,
            'user' => $user,
            'pasar' => $pasar,
            'satuan' => $satuan
        ]);

    }

    public function export(Request $request, Pangan $pangan)
    {
        
        if (request('exporttanggal')) {
            $pangan = Pangan::where('periode', 'like', '%' . request('exportperiode') . '%')->get();

            return Excel::download(new DataTableExport($pangan), 'Daftar-harga.xlsx');
       
        }
    
        if (request('exportkomoditas')) {
            $pangan = Pangan::where('komoditas', 'like', '%' . request('exportkomoditas') . '%')->get();

            return Excel::download(new DataTableExport($pangan), 'Daftar-harga.xlsx');
       
        }
    
        return Excel::download(new DataTableExport(), 'Daftar-harga.xlsx');
        
    }



    public function updateketerangan(Request $request,$id)
    {

        
        $pangan = Pangan::find($id);
        
        $pangan->keterangan = $request->input('keterangan');
        

        $pangan->update();
        

            $request->session(Alert::success('success', 'keterangan berhasil di update!'));
            return redirect('/dashboard/master-data');

    }

   

}
