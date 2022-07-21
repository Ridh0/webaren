@include('sweetalert::alert')
@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header ">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight"> <i class="fas fa-table me-1"></i>
                    Data Produksi
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm float-right" href="{{route('distributor.create')}}">
                        <span class="fas fa-table me-1"></span>
                        Tambah Data
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class=" table display cell-border" width="100%">
                <thead>
                    <tr class="table bg-dark text-white">
                        <th scope="col" width="5%">No <small>Urutan</small></th>
                        <th scope="col" width="50%">Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($distributor as $row)
                    <tr>
                        <th scope="row">{{ $loop->iteration}}</th>
                        <td>{{ $row ->nama }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection