@extends('frontend.layouts.main')
{{-- JUDUL --}}
@section('title')
Bapokting | Kota Palu
@endsection

@section('container')

<head>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    --}}
<br>    <div class="text-center text-dark mt-2">
        <h2><b>Tabel Harga Pangan</b></h2>
    </div>
    <section id="harga" class="harga">
    
        <div class="container">


            <div class="d-flex justify-content-center">
                <form action="/" method="get">
                    <div class="row g-3 align-items-center mb-2">
                        {{-- <div class="col-auto">
                          <label  class="col-form-label">Search Data</label>
                        </div> --}}
                        <div class="col-auto">
                          <input type="text"  required class="form-control" placeholder="Kata Kunci.." name="filter">
                        </div>
                        <div class="col-auto">
                          <button class="btn btn-primary" type="submit">Filter</button>
                         
                        </div>
                      </div>
                   </form>
            </div>
           
           <div class="overflow-auto">
            <table class="table table-bordered table-hover text-center" >
                <thead>
                    <tr>
                        {{-- <th scope="col">#</th> --}}
                        
                        <th scope="col">Komoditas</th>
                        <th scope="col">Jenis Barang</th>
                        <th scope="col">Nama Pasar</th>
                        <th scope="col">Harga Sebelum</th>
                        <th scope="col">Harga Terkini</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody id="price-list">
                    @if ($pangans->count())    
                    
                    
                    @foreach ($pangans as $pangan )
                    <tr>
                        
    
                        <td>{{ $pangan->komoditas }}</td>
                        <td>{{ $pangan->jenis_barang }}/{{ $pangan->satuan }} <br> <small class=""><kbd>{{ Carbon\Carbon::parse($pangan->periode)->format('d/m/Y') }}</kbd></small></td>
                        <td>{{ $pangan->pasar }}</td>
                        <td> @if ($pangan->harga_sebelum == null)
                            -
                            @else
                            Rp{{ number_format($pangan->harga_sebelum) }}
                            @endif</td>
                        <td>Rp{{ number_format($pangan->harga) }}</td>
                        <td>{{ $pangan->keterangan }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data..<img src="https://img.icons8.com/ios/24/000000/sad.png"/></td>
                    </tr>
                    @endif


                </tbody>
            </table>
           </div>
            
            <div class="d-flex justify-content-center">
                {{ $pangans->links() }}
            </div>
    
        </div>
   
   
</section>
@endsection

