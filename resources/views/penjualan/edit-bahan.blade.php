@extends('layouts.app')

@section('content')



<div class="container-fluid" id="dynamicAddRemove">


    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show " role="alert">
        <strong>Berhasil!</strong>
        <p>{{ Session::get('success') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show " role="alert">
        <strong>Error!</strong> @foreach ($errors->all() as $error)
        <p class="mt-1">{{$error}}</p>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="{{ route('penjualan.updatebahan',$penjualan->id) }}" method="POST">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex  bd-highlight ">
                    <div class="me-auto p-2 bd-highlight">
                        <h3>Data Produk</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @csrf
                <div class="row g-3 mb-2">
                    <div class="col-sm ">
                        <label for="">Gula Batok</label>
                        <input value="{{$penjualan->gulabatok}}" class="form-control showthis" name="gulabatok" type="text" placeholder="" aria-label="State">
                    </div>

                    <div class="col-sm ">
                        <label for="">GSM</label>
                        <input value="{{$penjualan->gsm}}" class="form-control showthis" name="gsm" type="text" placeholder="" aria-label="State">
                    </div>
                    <div class="col-sm ">
                        <label for="">CR</label>
                        <input value="{{$penjualan->cr}}" class="form-control showthis" name="cr" type="text" placeholder="" aria-label="State">
                    </div>
                    <div class="col-sm ">
                        <label for="">AJ</label>
                        <input value="{{$penjualan->aj}}" class="form-control showthis" name="aj" type="text" placeholder="" aria-label="State">
                    </div>
                    <div class="col-sm ">
                        <label for="">K</label>
                        <input value="{{$penjualan->k}}" class="form-control showthis" name="k" type="text" placeholder="" aria-label="State">
                    </div>
                    <div class="col-sm ">
                        <label for="">TO-I</label>
                        <input value="{{$penjualan->toi}}" class="form-control showthis"  name="toi" type="text" placeholder="" aria-label="State">
                    </div>


                </div>
                <div class="row g-3 mb-2">
                    <div class="col-sm ">
                        <label for="">AR 25</label>
                        <input value="{{$penjualan->ar25}}" class="form-control showthis" name="ar25" type="text" placeholder="" aria-label="State">
                    </div>
                    <div class="col-sm ">
                        <label for="">AR 5</label>
                        <input value="{{$penjualan->ar5}}" class="form-control showthis" name="ar5" type="text" placeholder="" aria-label="State">
                    </div>
                    <div class="col-sm ">
                        <label for="">AR 1</label>
                        <input value="{{$penjualan->ar1}}" class="form-control showthis" name="ar1" type="text" placeholder="" aria-label="State">
                    </div>
                    <div class="col-sm ">
                        <label for="">RG 25</label>
                        <input value="{{$penjualan->rg25}}" class="form-control showthis" name="rg25" type="text" placeholder="" aria-label="State">
                    </div>
                    <div class="col-sm ">
                        <label for="">RG 5</label>
                        <input value="{{$penjualan->rg5}}" class="form-control showthis" name="rg5" type="text" placeholder="" aria-label="State">
                    </div>
                    <div class="col-sm ">
                        <label for="">RG 1</label>
                        <input value="{{$penjualan->rg1}}" class="form-control showthis" name="rg1" type="text" placeholder="" aria-label="State">
                    </div>
                    <div class="col-sm ">
                        <label for="">RG K 1</label>
                        <input value="{{$penjualan->rgk1}}" class="form-control showthis" name="rgk1" type="text" placeholder="" aria-label="State">
                    </div>
                </div>
            </div>


        </div>
      
        <div class="d-grid gap-2 pt-2 mb-2">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>

    @endsection
    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>

    @endsection