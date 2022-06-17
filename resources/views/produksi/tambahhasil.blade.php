@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Hasil </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tambah Hasil</li>
    </ol>
    <div class="card mb-4">
        @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
        @endif
        @if($errors->any())

        <div class="alert alert-danger text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
        </div>
        @endif
        <div class="card-header ">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight"> <i class="fas fa-table me-1"></i>
                    Data Produksi
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm float-right" href="{{route('produksi.create')}}">
                        <span class="fas fa-table me-1"></span>
                        Tambah Data
                    </a>
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Link with href
                    </a>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="collapse" id="collapseExample">
                <div class="card card-body mb-3">
                    <form action="{{route('produksi.export.pdf')}}" method="GET">
                        @csrf
                        <input type="hidden" name="sort_by" value="id">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-5 my-1">
                                <label for="formGroupExampleInput">Tanggal Mulai</label>

                                <label class="sr-only" for="inlineFormInputName">Name</label>
                                <input type="date" name="from_date" class="form-control" id="inlineFormInputName" placeholder="Jane Doe">
                            </div>
                            <div class="col-5 my-1">
                                <label for="formGroupExampleInput">Tanggal Akhir</label>

                                <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                                <div class="input-group">

                                    <input type="date" name="to_date" class="form-control" id="inlineFormInputGroupUsername" placeholder="Username">
                                </div>
                            </div>

                            <div class="col-auto my-1 pt-3 mt-2">

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <form class="row g-3" action="{{route('produksi.hasil.store')}}" method="post">
                @csrf
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Nwo</label>
                    <select name="produksi_id" id="inputState" class="form-control">
                        <option value="0" selected>Choose...</option>
                        @foreach ($produksi as $row)
                        <option value="{{$row->id}}">{{$row->nwo}}-{{$row->id}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">AR-25</label>
                    <input name="ar25" type="text" class="form-control" placeholder="AR-25">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">AR-5</label>
                    <input name="ar5" type="text" class="form-control" placeholder="AR-5">
                </div>
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label">AR-1</label>
                    <input name="ar1" type="text" class="form-control" placeholder="AR-1">
                </div>
                <div class="col-md-6">
                    <label for="inputAddress2" class="form-label">RG-25</label>
                    <input name="rg25" type="text" class="form-control" placeholder="RG-25">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">RG-5</label>
                    <input name="rg5" type="text" class="form-control" placeholder="RG-5">
                </div>
                <div class="col-md-6">
                    <label for="inputState" class="form-label">RG-1</label>
                    <input name="rg1" type="text" class="form-control" placeholder="RG-1">

                </div>
                <div class="col-md-6">
                    <label for="inputZip" class="form-label">RG-K-1</label>
                    <input name="rgk1" type="text" class="form-control" placeholder="RG-K-1">
                </div>
                <div class="col-md-6">
                    <label for="inputZip" class="form-label">Tekan</label>
                    <button type="submit" class="form-control btn btn-primary">Submit</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection