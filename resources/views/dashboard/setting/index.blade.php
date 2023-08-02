@extends('dashboard.layouts.app')
{{-- JUDUL --}}
@section('title')
Pengaturan Aplikasi
@endsection

@section('container')


<div class="row mt-3">

    <!-- Area Chart -->
   @can('admin')
   <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Nama App</h6>
            <div class="dropdown no-arrow">
                
            </div>
        </div>
        <!-- Card Body -->
        @foreach ( $settings as $setting )
            
        <div class="card-body">
            <form method="post" action="{{ route('setting-app.update',$setting->id) }}">
                @csrf
                @method('put')
                <div class="form-group">
                  <label for="">Nama App</label>
                  <input type="text" placeholder="{{ $setting->nama }}" required class="form-control" name="nama" aria-describedby="emailHelp">                  
                </div>
               <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
               </div>

              </form>
        </div>
        @endforeach
    </div>
</div>

<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Text</h6>
            <div class="dropdown no-arrow">
                
            </div>
        </div>
        <!-- Card Body -->
        @foreach ( $settings as $setting )
            
        <div class="card-body">
            <form method="post" action="{{ route('update-text',$setting->id) }}">
                @csrf
                @method('put')
                <div class="form-group">
                  <label for="">Masukan Text</label>
                  {{-- <input type="text" placeholder="{{ $setting->nama }}" required class="form-control" name="nama" aria-describedby="emailHelp">                  
                 --}}
                  <textarea name="text" id="" class="form-control" cols="30" rows="10">{{ $setting->text }}</textarea>
                </div>
               <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
               </div>

              </form>
        </div>
        @endforeach
    </div>
</div>
   @endcan

    <!-- Pie Chart -->
    {{-- <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Warna Dashboard</h6>
                <div class="dropdown no-arrow">
                   
                    
                </div>
            </div>
            <!-- Card Body -->
            @foreach ($settings as $setting)
                
            <div class="card-body">        
                    
                        @foreach ($settings as $setting )
                            
                        
                        <form action="{{ route('update-font',$setting->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group container">
                                <input type="radio" class="form-check-input" id="font_size" name="font_size" value="success" >
                                <label class="form-check-label h1" for="check1">Font size </label><br>

                                <input type="radio" class="form-check-input h2" id="font_size" name="font_size" value="primary" >
                                <label class="form-check-label  h2" for="check1">Font size</label><br>

                                <input type="radio" class="form-check-input" id="font_size" name="font_size" value="warning" >
                                <label class="form-check-label h3" for="check1">Font size</label><br>

                                <input type="radio" class="form-check-input " id="font_size" name="font_size" value="dark" >
                                <label class="form-check-label h4" for="check1">Font size</label><br>

                                <input type="radio" class="form-check-input " id="font_size" name="font_size" value="dark" >
                                <label class="form-check-label h5" for="check1">Font size</label><br>

                                <input type="radio" class="form-check-input " id="font_size" name="font_size" value="dark" >
                                <label class="form-check-label h6" for="check1">Font size</label><br>
                            </div>
                            
                            <button type="submit" class="btn btn-success mt-2">Simpan</button>
                        </form>

                        @endforeach
                    
            </div>
            @endforeach
        </div>
    </div> --}}
</div>


@endsection