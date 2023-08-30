@extends('dashboard.layouts.app')
{{-- JUDUL --}}
@section('title')
Tabel Harga
@endsection

@section('container')

<head>
     
</head>


<div class="card shadow mt-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="container">
            <h6 class="m-0 font-weight-bold text-dark">DATA HARGA BAHAN KEBUTUHAN POKOK
                </h6>
        </div>


    </div>
   
    <div class="card-body">

        <div class="container">
            @if (auth()->user()->operator == 'hanyalihat')

            @else
            <a class="btn btn-primary mb-4" style="background-color: rgb(195, 0, 255); border:0ch" data-toggle="modal"
                data-target=".bd-example-modal-lg">+ Input Data</a>
            @endif

            <div class="input-group mb-2">


                @if (auth()->user()->operator == 'hanyalihat')

                @else
                @can('admin')

                <form class="form-inline" action="/dashboard/master-data">
                    <div class="input-group">
                        <input type="date" name="periode" class="form-control">
                    </div>
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="fas fa-filter fa-sm">Filter</i>
                    </button>
                </form>

                <form class="form-inline spaced col" action="/dashboard/master-data">
                    <div class="input-group">

                        <select class="form-control " id="theSelect" name="komoditas">
                            <option>
                                --komoditas--
                            </option>
                            @foreach ($komoditas as $kmd )

                            <option>
                                {{ $kmd->nama }}
                            </option>
                            @endforeach

                        </select>
                    </div>
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="fas fa-filter fa-sm">Filter</i>
                    </button>
                </form>

                <form class="form-inline spaced col" action="/dashboard/master-data">
                    <div class="input-group">

                        <select class="form-control " id="theSelect" name="pasar">
                            <option>
                                --Pasar--
                            </option>
                            @foreach ($pasars as $pasar )

                            <option>
                                {{ $pasar->nama }}
                            </option>
                            @endforeach

                        </select>
                    </div>
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="fas fa-filter fa-sm">Filter</i>
                    </button>
                </form>
                @endcan
                @endif



                @if (auth()->user()->operator == 'hanyalihat')
                <a class="btn btn-outline-secondary" data-toggle="modal" data-target="#filter">
                    <i class="fas fa-filter fa-sm"> Filter</i>
                </a>
                @else

                @endif


                @if (auth()->user()->is_admin == false)
                <a class="btn btn-outline-secondary" data-toggle="modal" data-target="#filter">
                    <i class="fas fa-filter fa-sm"> Filter</i>
                </a>
                @else

                @endif

                &nbsp;
                <a class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal"><i
                        class="fas fa-file-excel"> Export</i></a>
            </div>
        </div>

        @if (request('search'))
        <div class="container mt-4 mb-4">

            <a class="text-decoration-none text-dark">Filter Data: <kbd> "{{ request('search') }}"</kbd></a>

        </div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="overflow-auto">
                        <div class="d-flex flex-nowrap">
                            <!-- Content here -->

                            <table id="myTable" class="table text-dark table-bordered table-hover text-center">
                                <tr>
                                    <th class="align-middle">No</th>
                                    <th class="align-middle">Pasar</th>
                                    <th class="align-middle">Komoditas</th>
                                    <th class="align-middle">Jenis Barang</th>
                                    <th class="align-middle">Satuan</th>
                                    <th class="align-middle">Harga Sebelum</th>
                                    <th class="align-middle">Harga Terkini</th>
                                    <th class="align-middle">Periode</th>
                                    <th class="align-middle">Keterangan</th>
                                    @if (auth()->user()->operator == 'hanyalihat')

                                    @else
                                    <th class="align-middle">Aksi</th>
                                    @endif


                                </tr>
                                @if($pangans->count())
                                @foreach ($pangans as $pangan )

                                <tr class="align-middle">

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pangan->pasar }}</td>
                                    <td>{{ $pangan->komoditas }}</td>
                                    <td>-{{ $pangan->jenis_barang }}</td>
                                    <td>{{ $pangan->satuan }}</td>
                                    <td>
                                        @if ($pangan->harga_sebelum == null)
                                        -
                                        @else
                                        Rp{{ number_format($pangan->harga_sebelum) }}
                                        @endif

                                    </td>
                                    <td>Rp{{ number_format($pangan->harga) }} </td>
                                    <td>{{ $pangan->periode->format('d/m/Y') }}</td>
                                    <td>
                                        {{ $pangan->keterangan }}
                                    </td>
                                    @if (auth()->user()->operator == 'hanyalihat')

                                    @else
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#exampleModalku{{ $pangan->id }}">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#exampleModaldelete{{ $pangan->id }}">
                                            <i class="fas fa-fw fa-trash"></i>
                                        </button>
                                    </td>
                                    @endif

                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center" colspan="10">Tidak ada data..<img
                                            src="https://img.icons8.com/ios/24/000000/sad.png" /></td>
                                </tr>
                                @endif
                            </table>



                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
        <div class="container">
            <div class="text-center">
                {{ $pangans->links() }}
            </div>
    
        </div>
        
    </div>
</div>

<!-- Modal Input Data -->
<div class="modal fade bd-example-modal-lg" id="inputModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card  shadow mt-4">
                <div class="modal-header">
                    <h5 class="modal-title text-dark text-center" id="exampleModalLabel">INPUT DATA HARGA BAHAN
                        KEBUTUHAN POKOK
                        TAHUN <kbd class="bg-primary"> @php echo date('Y') @endphp</kbd></h5>

                </div>
                <div class="container">
                    <div class="card-body">

                        <form method="post" action="/dashboard/master-data" class="text-dark">
                            @csrf

                            @if (Auth::user()->is_admin == true)
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Pasar</label>
                                <select required class="form-control" name="pasar">
                                    <option>-Pilih pasar-</option>
                                    @foreach ($pasars as $pasar )

                                    <option value="{{ $pasar->nama }}" @selected(old('pasar')==$pasar->nama)>
                                        {{ $pasar->nama }}
                                    </option>
                                    @endforeach

                                </select>

                                @error('pasar')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @else
                            <input type="hidden" name="pasar" id="" value="{{ Auth::user()->operator }}">
                            @endif

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Komoditas</label>
                                <select required class="form-control"  name="komoditas">
                                    <option>-Pilih Komoditas-</option>
                                    @foreach ($komoditas as $kmd )

                                    <option value="{{ $kmd->nama }}">
                                        {{ $kmd->nama }}
                                    </option>
                                    
                                    @endforeach

                                </select>

                                @error('komoditas')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Jenis Barang</label>
                                <select required class="form-control" data-live-search="true" name="jenis_barang">
                                    
                                    <option>-Pilih Barang-</option>
                                    @foreach ($barangs as $barang )

                                    <option value="{{ $barang->nama }}">
                                        {{ $barang->nama }}
                                    </option>
                                    
                                    @endforeach

                                </select>

                                @error('jenis_barang')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                           

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Satuan</label>
                                <select class="form-control " name="satuan" id="exampleFormControlSelect1">
                                    <option>-Pilih Satuan-</option>
                                    @foreach ($satuans as $satuan )
                                    <option value="{{ $satuan->nama }}">{{ $satuan->nama }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('satuan')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <input type="radio" id="showButton" name="check"> Harga Sebelumnya
                            <div class="form-group" id="myElement" style="display: none">
                                <input type="number" id="harga_sebelum" value="{{ old('harga_sebelum') }}"
                                    name="harga_sebelum" class="form-control sum">

                                <input type="radio" id="hideButton" name="check"> Tutup
                            </div>


                            <div class="form-group">
                                <label for="">Harga Terkini</label>
                                <input type="number" id="harga" value="{{ old('harga') }}" name="harga"
                                    class="form-control sum">

                                @error('harga')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Periode</label>
                                <input type="date" id="periode" value="{{ old('periode') }}" name="periode"
                                    class="form-control">

                                @error('periode')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Upload</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>

                        </form>





                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal edit harga -->
@foreach ($pangans as $pangan )
<div class="modal fade" id="exampleModalku{{ $pangan->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Edit Data
                    <kbd>{{ $pangan->jenis_barang }}</kbd><small>
                        {{ Carbon\Carbon::parse($pangan->periode)->format('d-m-Y') }}</small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('master-data.update',$pangan->id)}}" class="text-dark">
                    @csrf
                    @method('put')
                    @if (Auth::user()->is_admin == true)
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pasar</label>
                        <select required class="form-control" name="pasar">
                            <option>---------------------Pilih pasar---------------------</option>
                            <option selected value="{{ old('pasar',$pangan->pasar) }}">{{ $pangan->pasar }}
                            </option>
                            @foreach ($pasars as $pasar )
                            <option value="{{ $pasar->nama }}">
                                {{ $pasar->nama }}
                            </option>
                            @endforeach

                        </select>

                        @error('pasar')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @else
                    <input type="hidden" name="pasar" id="" value="{{ Auth::user()->operator }}">
                    @endif
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Komoditas</label>
                        <select required class="form-control text-success" name="komoditas">
                            <option>---------------------Pilih Komoditas---------------------</option>
                            <option selected value="{{ old('komoditas',$pangan->komoditas) }}">{{ $pangan->komoditas }}
                                @foreach ($komoditas as $kmd )

                            <option value="{{ old('komoditas' ,$kmd->nama) }}" @selected(old('komoditas')==$kmd->nama)>
                                {{ $kmd->nama }}
                            </option>
                            @endforeach

                        </select>


                    </div>

                    <div class="form-group">
                        <label for="">Jenis Barang</label>
                        <input type="text" id="jenis_barang" value="{{ old('jenis_barang',$pangan->jenis_barang) }}"
                            onkeyup="sum();" name="jenis_barang" class="form-control text-success">


                    </div>



                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Satuan</label>
                        <select class="form-control text-success " name="satuan" id="exampleFormControlSelect1">
                            <option>---------------------Pilih Satuan---------------------</option>
                            <option selected value="{{ old('satuan',$pangan->satuan) }}">{{ $pangan->satuan }}
                                @foreach ($satuans as $satuan )
                            <option value="{{ $satuan->nama }}" @selected(old('satuan'))>{{ $satuan->nama }}</option>
                            @endforeach

                        </select>


                    </div>



                    <div class="form-group">
                        <label for="">Harga Sebelum</label>
                        <input type="number" value="{{ old('harga_sebelum',$pangan->harga_sebelum) }}"
                            name="harga_sebelum" class="form-control text-success">

                    </div>



                    <div class="form-group">
                        <label for="">Harga Terkini</label>
                        <input type="number" id="harga" value="{{ old('harga',$pangan->harga) }}" name="harga"
                            class="form-control text-success">

                    </div>



                    <div class="form-group">
                        <label for="">Periode</label>
                        <input type="date" id=""  value="{{ old('harga',$pangan->periode->format('Y-m-d')) }}" name="periode"
                            class="form-control text-success">


                    </div>
                   

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($pangans as $pangan )
<!-- Modal Delete Data -->
<div class="modal fade" id="exampleModaldelete{{ $pangan->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Delete Data <kbd>{{ $pangan->jenis_barang }} | {{ $pangan->periode->format('d/m/Y') }}</kbd></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('master-data.destroy',$pangan->id) }}}}" class="mb-5"
                    enctype="multipart/form-data">
                    @csrf
                    @method('delete')
                    <h2 class="text-dark">Apakah anda yakin ingin menghapus <span
                            class="badge badge-danger">{{ $pangan->jenis_barang }}</span> ?? </h2>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Hapus</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal filter -->
<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="container">
                    <label for="">Urut berdasarkan periode</label>
                    <form class="form-inline mb-3" action="/dashboard/master-data">
                        <div class="input-group">
                            <input type="date" name="periode" class="form-control">
                        </div>
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="fas fa-filter fa-sm">Filter</i>
                        </button>
                    </form>

                    <label for="">Urut berdasarkan komoditas </label>
                    <form class="form-inline mb-3" action="/dashboard/master-data">
                        <div class="input-group">
                            <select class="form-control " id="theSelect" name="komoditas">
                                <option>
                                    --komoditas--
                                </option>
                                @foreach ($komoditas as $kmd )

                                <option>
                                    {{ $kmd->nama }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="fas fa-filter fa-sm">Filter</i>
                        </button>
                    </form>

                    @can('admin')
                    <label for="">Urut berdasarkan pasar </label>
                    <form class="form-inline spaced" action="/dashboard/master-data">
                        <div class="input-group">

                            <select class="form-control " id="theSelect" name="pasar">
                                <option>
                                    --Pasar--
                                </option>
                                @foreach ($pasars as $pasar )

                                <option>
                                    {{ $pasar->nama }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="fas fa-filter fa-sm">Filter</i>
                        </button>
                    </form>
                    @endcan
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Modal Export excel --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Export Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/export" class="form-inline mb-4" method="get">
                    <button type="submit" class="btn btn-outline-success">Download semua <i
                            class="fas fa-fw fa-download"></i></button>
                </form>
                <form action="/export" class="form-inline" method="get">


                    <input type="date" class="form-control" name="exportperiode" required>
                    <button type="submit" class="btn btn-outline-success"> <i
                            class="fas fa-fw fa-download"></i></button>
                </form>

                <form action="/export" class="form-inline mt-3" method="get">

                    <select class="form-control" name="exportkomoditas">
                        <option>--Komoditas--</option>
                        @foreach ($komoditas as $kmd )

                        <option required value="{{ $kmd->nama }}" @selected(old('komoditas')==$kmd->nama)>
                            {{ $kmd->nama }}
                        </option>
                        @endforeach

                    </select>
                    <button type="submit" class="btn btn-outline-success"> <i
                            class="fas fa-fw fa-download"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- show/hide input field modal input --}}

{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        $('.js-example-basic-single').select2({
            theme: "classic"
        });
    });
    </script>
<script>
    $(document).ready(function () {
        // Show the element when the "Show Element" button is clicked
        $("#showButton").click(function () {
            $("#myElement").show();
        });

        // Hide the element when the "Hide Element" button is clicked
        $("#hideButton").click(function () {
            $("#myElement").hide();
        });
    });

</script>

{{-- show/hide input field modal edit --}}
<script>
    $(document).ready(function () {
        // Show the element when the "Show Element" button is clicked
        $("#showButton2").click(function () {
            $("#myElement2").show();
        });

        // Hide the element when the "Hide Element" button is clicked
        $("#hideButton2").click(function () {
            $("#myElement2").hide();
        });
    });

</script>
<!-- Tambahkan kode jQuery untuk membuka modal -->
@if ($errors->any())
<script>
    $(document).ready(function () {
        $('#inputModal').modal('show');
    });

</script>


{{-- Select2 --}}
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endif










@endsection
