@extends('frontend.layouts.main')
{{-- JUDUL --}}
@section('title')
Komoditas
@endsection

@section('container')

<head>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    --}}
    <br>
    <div class="text-center text-dark mt-2">
        <h2><b>Komoditas</b></h2>
    </div>
    <section id="portfolio" class="portfolio">
        <div class="container">
  
          
  
        
  
          <div class="row portfolio-container aos-init aos-animate" data-aos="fade-up" data-aos-delay="200" style="position: relative; height: 3030.75px;">
  
            @foreach ($komoditas as $kmd)

            <div class="col-lg-4 col-md-6 portfolio-item filter-app" style="position: absolute; left: 0px; top: 0px;">
              <div class="portfolio-wrap">
                <img src="{{ asset('storage/' .$kmd->image) }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>{{ $kmd->nama }}</h4>
                  
                  <div class="portfolio-links">
                    <a href="{{ asset('storage/' .$kmd->image) }}" data-gallery="portfolioGallery" class="portfolio-lightbox" ><i class="bx bx-plus"></i></a>
                    <a href="/komoditas/{{ $kmd->nama}}" title="More Details"><i class="bx bx-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
                            
            @endforeach
        
          </div>
  
        </div>
      </section>
    @endsection
