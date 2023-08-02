<?php

namespace App\Http\Controllers;

use App\Models\Pasar;
use Illuminate\Http\Request;
use Alert;

class PasarController extends Controller
{
    public function index()
    {
        
        $sertifikatada = Pasar::where('sertifikat', 'Ada')->count();
        $sertifikattidak = Pasar::where('sertifikat', 'Tidak')->count();
        
        $pedagang = Pasar::sum('pedagang');
        $kios_petak = Pasar::sum('kios_petak');
        $los_petak = Pasar::sum('los_petak');
        $lapak_pelataran = Pasar::sum('lapak_pelataran');
        $ruko = Pasar::sum('ruko');
        $baik = Pasar::sum('baik');
        $rusak = Pasar::sum('rusak');
        $terpakai = Pasar::sum('terpakai');
        $kepala_pasar = Pasar::sum('kepala_pasar');
        $kebersihan = Pasar::sum('kebersihan');
        $keamanan = Pasar::sum('keamanan');
        $retribusi = Pasar::sum('retribusi');

        return view('dashboard.pasar.index',[
            'pasars' => Pasar::latest()->get(),
            'sertifikatada' => $sertifikatada,
            'sertifikattidak' => $sertifikattidak,
            'pedagang' => $pedagang,
            'kios_petak' => $kios_petak,
            'los_petak' => $los_petak,
            'lapak_pelataran' => $lapak_pelataran,
            'ruko' => $ruko,
            'baik' => $baik,
            'rusak' => $rusak,
            'terpakai' => $terpakai,
            'kepala_pasar' => $kepala_pasar,
            'kebersihan' => $kebersihan,
            'keamanan' => $keamanan,
            'retribusi' => $retribusi
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
            'image' => 'nullable|max:4096', 
            'tahun_pembangunan' => 'required',
            'luas_lahan' => 'required',
            'sertifikat' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'status_pasar' => 'required',
            'pedagang' => 'required',
            'kios_petak' => 'required',
            'los_petak' => 'required',
            'lapak_pelataran' => 'required',
            'ruko' => 'required',
            'baik' => 'required',
            'rusak' => 'required',
            'terpakai' => 'required',
            'kepala_pasar' => 'required',
            'kebersihan' => 'required',
            'keamanan' => 'required',
            'retribusi' => 'required'     
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('pasar-image','public');
        }
    
        Pasar::create($validatedData);
        
        $request->session(Alert::success('success', 'Pasar berhasil ditambahkan!'));
        return redirect('/dashboard/pasar');
       
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasar $pasar)
    {
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $pasar = Pasar::find($id);
        $pasar->nama = $request->input('nama');
        $pasar->tahun_pembangunan = $request->input('tahun_pembangunan');
        $pasar->luas_lahan = $request->input('luas_lahan');
        $pasar->sertifikat = $request->input('sertifikat');
        $pasar->kecamatan = $request->input('kecamatan');
        $pasar->kelurahan = $request->input('kelurahan');
        $pasar->status_pasar = $request->input('status_pasar');
        $pasar->pedagang = $request->input('pedagang');
        $pasar->kios_petak = $request->input('kios_petak');
        $pasar->los_petak = $request->input('los_petak');
        $pasar->lapak_pelataran = $request->input('lapak_pelataran');
        $pasar->ruko = $request->input('ruko');
        $pasar->terpakai = $request->input('terpakai');
        $pasar->kepala_pasar = $request->input('kepala_pasar');
        $pasar->kebersihan = $request->input('kebersihan');
        $pasar->keamanan = $request->input('keamanan');
        $pasar->retribusi = $request->input('retribusi');
        $pasar->update($request->all());
        

        $request->session(Alert::success('success', 'Pasar berhasil diupdate!'));
        return redirect('/dashboard/pasar');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {

        $pasar = Pasar::find($id);

        
        $pasar->delete();

        $request->session(Alert::success('success', 'Pasar berhasil dihapus!'));
            return redirect('/dashboard/pasar');
    }

   

    
}
