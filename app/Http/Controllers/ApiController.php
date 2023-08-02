<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $response = Http::get('http://127.0.0.1:8080/blog');
        
        $data = $response->json()['data'];

        // dd($data);
        return view('api',compact('data'));
    }

    
}
