@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Rekap {{ (request()->segment(3)=='harian') ? 'Harian' : 'Bulanan' }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Data Inventori</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header ">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight"> <i class="fas fa-table me-1"></i>
                    Data Rekap Inventori <small class="fw-bold">( Barang Masuk )</small>
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm float-right" href="{{route('produksi.create')}}">
                        <span class="fas fa-table me-1"></span>
                        Tambah Data
                    </a>
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm" data-bs-toggle="collapse" href="#masuk" role="button" aria-expanded="false" aria-controls="masuk">
                        Link with href
                    </a>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="collapse" id="masuk">
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
            <table id="datatablesSimple" class="table" width="100%">
                <thead>
                    <tr class="table bg-dark text-white">
                        <th scope="col">No</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Tanggal</small></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($a as $row)
                    <tr>
                        <th scope="row">{{ $loop->iteration}}</th>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header ">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight"> <i class="fas fa-table me-1"></i>
                    Data Rekap Inventori <small class="fw-bold">( Barang Keluar )</small>
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm float-right" href="{{route('produksi.create')}}">
                        <span class="fas fa-table me-1"></span>
                        Tambah Data
                    </a>
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm" data-bs-toggle="collapse" href="#keluar" role="button" aria-expanded="false" aria-controls="keluar">
                        Cetak
                    </a>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="collapse" id="keluar">
                <div class="card card-body mb-3">
                    <form action="{{route('inventori.export.pdf')}}" method="GET">
                        @csrf
                        <input type="hidden" name="sort_by" value="id">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-4 my-1">
                                <label for="formGroupExampleInput">Tanggal Mulai</label>

                                <label class="sr-only" for="inlineFormInputName">Name</label>
                                <input type="date" name="from_date" class="form-control" id="inlineFormInputName" placeholder="Jane Doe">
                            </div>
                            <div class="col-4 my-1">
                                <label for="formGroupExampleInput">Tanggal Akhir</label>

                                <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                                <div class="input-group">

                                    <input type="date" name="to_date" class="form-control" id="inlineFormInputGroupUsername" placeholder="Username">
                                </div>
                            </div>
                            <div class="col-sm my-1">
                                <label for="formGroupExampleInput">Jenis</label>

                                <div class="input-group">
                                    <select name="jenis" class="form-select" id="">
                                        <option value="1">Bahan Baku</option>
                                        <option value="2">Barang Hasil</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-auto my-1 pt-3 mt-2">

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table id="datatablesSimple" class="table" width="100%">
                <thead>
                    <tr class="table bg-dark text-white">
                        <th scope="col">No</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Tanggal</small></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($a as $row)
                    <tr>
                        <th scope="row">{{ $loop->iteration}}</th>
                        <td>{{$row->total_aj}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection