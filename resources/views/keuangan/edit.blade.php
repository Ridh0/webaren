@extends('layouts.app')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

<div class="container-fluid" id="dynamicAddRemove">
    @include('sweetalert::alert')


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
    <form action="{{ route('keuangan.update',$keuangan) }}" method="POST">
        @csrf

        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex bd-highlight ">
                    <div class="me-auto p-2 bd-highlight">
                        <a href="{{route('keuangan')}}" class="float-right text-white btn btn-primary">

                            Back
                        </a>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <div class="row g-3 mb-2 ">
                    <div class="col-sm-12">
                        <label for="">Tanggal </label>
                        <input class="date form-control" name="tanggal" value="{{$keuangan->tanggal}}" type="text">
                    </div>
                    <div class="col-sm-12 ">
                        <label for="">Jumlah Uang Masuk </label>
                        <input value="{{$keuangan->masuk}}" class="form-control showthis" name="masuk" type="text" placeholder="" aria-label="State">
                    </div>
                    <div class="col-sm-12 ">
                        <label for="">Jumlah Uang Keluar </label>
                        <input value="{{$keuangan->keluar}}" class="form-control showthis" name="keluar" type="text" placeholder="" aria-label="State">
                    </div>
                    <div class="col-sm-12 ">
                        <label for="">Kode</label>
                        <select name="kode" class="form-select" id="">
                            <optgroup label="Sumber Dana">
                           
                                <option value="1" <?php if($keuangan->kode ==1) echo"selected"; ?>>Kas</option>
                                <option value="2" <?php if($keuangan->kode ==2) echo"selected"; ?>>Pribadi </option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-sm-12 ">
                        <label for="">FD</label>
                        <select name="fd" class="form-select" id="">
                            <option value="1" <?php if($keuangan->kode ==1) echo"selected"; ?>>Hutang</option>
                            <option value="2" <?php if($keuangan->kode ==2) echo"selected"; ?>>Lunas</option>
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
    <script src="{{ asset('datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    @section('scripts')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            language: "id"

        });
    </script>

    @endsection