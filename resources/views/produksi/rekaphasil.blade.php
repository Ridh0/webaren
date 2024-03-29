@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Hasil Produksi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Data Hasil Produksi</li>
    </ol>
    <div class="card mb-4">
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
            <table id="datatablesSimple" class="table" width="100%">
                <thead>
                    <tr class="table bg-dark text-white">
                        <th scope="col">Urutan Masak</th>
                        <th scope="col">Nomor WO</th>
                        <th scope="col">AR-25</th>
                        <th scope="col">AR-5</th>
                        <th scope="col">AR-1</th>
                        <th scope="col">RG-25</th>
                        <th scope="col">RG-5</th>
                        <th scope="col">RG-1</th>
                        <th scope="col">RG-K-1</th>
                        <th scope="col">Jumlah Hasil <small>(kg)</small></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($a as $row)
                    <tr>
                        <th scope="row">{{ $loop->iteration}}</th>
                        <td>{{ $row->nwo }}</td>
                        <td>{{ $row->total_ar25 }}</td>
                        <td>{{ $row->total_ar5 }}</td>
                        <td>{{ $row->total_ar1 }}</td>
                        <td>{{ $row->total_rg25 }}</td>
                        <td>{{ $row->total_rg5 }}</td>
                        <td>{{ $row->total_rg1 }}</td>
                        <td>{{ $row->total_rgk1 }}</td>
                        <td>{{ $row->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection