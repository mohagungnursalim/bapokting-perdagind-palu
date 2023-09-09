@extends('dashboard.layouts.app')
{{-- JUDUL --}}
@section('title')
    Dashboard
@endsection

@section('container')


<head>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
    integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


</head>
  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Jenis Barang</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $barang }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-solid fa-pepper-hot fa-2x text-gray-300"></i>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Harga Barang Di Input</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pangan }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Satuan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $satuan }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-balance-scale fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Komoditas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $komoditas }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-database fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    @can('admin')
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Akun
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    @if (Auth::user()->is_admin == true)
                                    {{ $user }}
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endcan
    
    @can('admin')
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Pasar
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $pasar }}</div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
    
    <!-- Pending Requests Card Example -->
    {{-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Sebaran Data</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body text-center">
                <div class="overflow-auto">
                    <div id="piechart" style="width: 100%; height: 100%;" ></div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    {{-- <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Sebaran Data</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    
                    <div id="piechart" width="500px" height="208" ></div>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Referral
                    </span>
                </div>
            </div>
        </div>
    </div> --}}
</div>


{{-- pie chart --}}
@if (Auth::user()->is_admin == true)
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
  
    function drawChart() {
  
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Jenis Barang', {{ $barang }}],
        ['Harga Barang Di Input',  {{ $pangan }}],
        ['Satuan', {{ $satuan }}],
        ['Komoditas',  {{ $komoditas }}],
        ['Akun',  {{ $user }}],
        ['Pasar', {{ $pasar }}],
        
        
      ]);
  
      var options = {
      width:400,
        height:200,
        title: 'Sebaran Data',
        is3D:true,
        colors: [
          '#f44336',
          '#0275d8', 
          '#FFC107',
          '#5cb85c', 
          '#5bc0de',
          '#000000',
          
      ]
      };
  
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  
      chart.draw(data, options);
    }
  </script>
@else
{{-- <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
  
    function drawChart() {
  
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Jenis Barang', {{ $barang }}]
        ['Harga Barang Di Input',     {{ $pangan }}],
        ['Komoditas',      {{ $komoditas }}],
        ['Satuan', {{ $satuan }}]
      ]);
  
      var options = {
      width:400,
        height:200,
        title: 'Sebaran Data',
        is3D:true,
        colors: [
          '#0275d8', 
          '#5cb85c', 
          '#5cb85c',
          '#FFC107'
      ]
      };
  
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  
      chart.draw(data, options);
    }
</script> --}}
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
  
    function drawChart() {
  
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Jenis Barang', {{ $barang }}],
        ['Harga Barang Di Input',  {{ $pangan }}],
        ['Satuan', {{ $satuan }}],
        ['Komoditas',  {{ $komoditas }}],
        
        
      ]);
  
      var options = {
      width:400,
        height:200,
        title: 'Sebaran Data',
        is3D:true,
        colors: [
          '#f44336',
          '#0275d8', 
          '#FFC107',
          '#5cb85c'
          
      ]
      };
  
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  
      chart.draw(data, options);
    }
  </script>
@endif



@endsection

