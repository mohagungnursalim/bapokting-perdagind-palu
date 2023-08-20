@extends('frontend.layouts.main')
{{-- JUDUL --}}
@section('title')
Aduan Pasar
@endsection

@section('container')

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    --}}
    <script src="https://kit.fontawesome.com/824747cfe7.js" crossorigin=”anonymous”></script>
    <br>
    <div class="text-center text-dark mt-2">
        <h2><b>Form Aduan Pasar</b></h2>
    </div>
    <section id="aduan" class="aduan">

        <div class="container">
            @if ($message = Session::get('status'))

                <div class="alert alert-success d-flex align-items-center" role="alert">
                    {{-- icon --}}
                    <i class="fa-solid fa-check"></i> &nbsp;
                    <div>
                     {{ $message }}
                    </div>
                  </div>
                @endif
            <div class="d-flex justify-content-center">
                
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('aduan-pasar.store') }}" method="post">

                            @csrf
                            <div class="mb-2 row">
                                <label for="staticEmail" class=""><b>Nama Lengkap</b></label>
                                <div class="col">
                                    <input type="text" name="nama" autofocus class="form-control-plaintext"
                                        placeholder="Masukan Nama Lengkap..">
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label for="staticEmail" class=""><b>No.Hp/Wa</b></label>
                                <div class="col">
                                    <input type="text" name="no_hp" autofocus class="form-control-plaintext" placeholder="Masukan No.Hp/Wa..">
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label for="staticEmail" class=""><b>Lokasi Pasar</b></label>
                                <div class="col">
                                    <select name="pasar" class="form-select" aria-label="Default select example" required>
                                        <option selected>Pilih Pasar</option>
                                        @foreach ($pasars as $pasar)
                                        <option value="{{ $pasar->nama }}">{{ $pasar->nama }}</option>
                                        @endforeach
            
                                    </select>
                                </div>
            
                            </div>
                            <div class="mb-2 row">
                                <label for="staticEmail" class=""><b>Lampiran Foto</b></label>
                                <div class="col">
                                    <input class="form-control" name="gambar" type="file">
                                </div>
            
                            </div>
                            <div class="mb-2 row">
                                <label for="staticEmail" class=""><b>Isi Aduan</b></label>
                                <div class="col">
                                    <textarea name="isi_aduan" class="form-control" id="" cols="30" rows="5"
                                        placeholder="Masukan Aduan Anda.."></textarea>
                                </div>
                            </div>
            
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-primary">Kirim</button>
                            </div>
                            
                        </form>
                    </div>
                  </div>
            </div>
          




        </div>


    </section>
    @endsection



    {{-- script --}}

  <script>
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 3000);
</script>