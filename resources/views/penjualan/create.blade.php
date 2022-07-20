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
    <form action="{{ route('penjualan.store') }}" method="POST">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex bd-highlight ">
                    <div class="me-auto p-2 bd-highlight">
                        <a href="{{route('produksi')}}" class="float-right text-white btn btn-primary">

                            Back
                        </a>
                    </div>

                </div>
            </div>

            <div class="card-body">
                @csrf
                <div class="row g-3 mb-2">
                    <div class="col-sm ">
                        <label for="">No User </label>
                        <select name="user_id" id="" class="form-select">
                            @foreach($pembeli as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm ">
                        <label for="">No Faktur </label>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon">F-</span>
                                    <input type="text" name="nofaktur1" class="form-control" placeholder="No Faktur 1" aria-label="Username" aria-describedby="basic-addon1">
                                    <span class="input-group-text" id="basic-addon">-</span>
                                    <input class="form-control showthis" name="nofaktur2" type="text" placeholder="No Faktur 2" aria-label="State">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm ">
                        <label for="">Nota Gudang </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon">G-</span>
                            <input type="text" name="notagudang1" class="form-control" placeholder="Nota Gudang 1" aria-label="Username" aria-describedby="basic-addon1">
                            <span class="input-group-text" id="basic-addon">-</span>
                            <input class="form-control showthis" name="notagudang2" type="text" placeholder="Nota Gudang 2" aria-label="State">
                        </div>
                    </div>

                </div>

            </div>


        </div>
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
                        <label for="">T Jawa</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="gulabatok" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">kg</span>
                        </div>
                    </div>

                    <div class="col-sm ">
                        <label for="">GSM</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="gsm" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">pcs</span>
                        </div>
                    </div>
                    <div class="col-sm ">
                        <label for="">CR</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="cr" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">kg</span>
                        </div>
                    </div>
                    <div class="col-sm ">
                        <label for="">AJ</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="aj" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">kg</span>
                        </div>
                    </div>
                    <div class="col-sm ">
                        <label for="">K</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="k" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">kg</span>
                        </div>
                    </div>
                    <div class="col-sm ">
                        <label for="">TO-I</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="toi" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">kg</span>
                        </div>
                    </div>


                </div>
                <div class="row g-3 mb-2">
                    <div class="col-sm ">
                        <label for="">AR 25</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="ar25" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">kg</span>
                        </div>
                    </div>
                    <div class="col-sm ">
                        <label for="">AR 5</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="ar5" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">kg</span>
                        </div>
                    </div>
                    <div class="col-sm ">
                        <label for="">AR 1</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="ar1" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">kg</span>
                        </div>

                    </div>
                    <div class="col-sm ">
                        <label for="">RG 25</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="rg25" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">kg</span>
                        </div>
                    </div>
                    <div class="col-sm ">
                        <label for="">RG 5</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="rg5" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">kg</span>
                        </div>
                    </div>
                    <div class="col-sm ">
                        <label for="">RG 1</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="rg1" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">kg</span>
                        </div>
                    </div>
                    <div class="col-sm ">
                        <label for="">RG K 1</label>
                        <div class="input-group mb-3">
                            <input class="form-control showthis" name="rgk1" type="text" placeholder="" aria-label="State">
                            <span class="input-group-text" id="basic-addon">kg</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="card">
            <div class="card-header">
                <div class="d-flex  bd-highlight ">
                    <div class="me-auto p-2 bd-highlight">
                        <h3>Perhitungan</h3>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @csrf
                <div class="row g-3 mb-2">
                    <div class="col-sm ">
                        <label for="">Harga </label>
                        <div class="input-group mb-3">
                            <input type="text" name="harga" class="form-control" placeholder="Harga" aria-label="Username" aria-describedby="basic-addon1">
                            <span class="input-group-text" id="basic-addon">Rupiah</span>
                        </div>
                    </div>
                    <div class="col-sm ">
                        <label for="">Status </label>
                        <select name="status" class="form-select  mb-3" id="">
                            <option value="1">Lunas</option>
                            <option value="2">Hutang</option>
                        </select>
                    </div>
                    <div class="col-sm ">
                        <label for="">Kode</label>
                        <select name="kode" class="form-select mb-3" id="">
                            <option value="1" selected>DW</option>
                            <option value="2">AM</option>
                            <option value="3">FD</option>
                        </select>
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