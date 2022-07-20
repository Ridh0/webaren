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
        <strong>Error!</strong>  @foreach ($errors->all() as $error)
        <p class="mt-1">{{$error}}</p>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
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
            <form action="{{ route('inventori.storebs') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-sm aj[0]">
                        <label for="">Jumlah BS </label>

                        <input class="form-control showthis" name="bs" type="text" placeholder="Jumlah BS" aria-label="State">
                    </div>
                </div>
                <div class="row g-12">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block mt-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>


    </div>

    @endsection
    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>

    @endsection