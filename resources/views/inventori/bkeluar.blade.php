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
                    <a class="btn btn-primary btn-sm float-right" href="{{route('produksi.create')}}">
                        <span class="fas fa-table me-1"></span>
                        Tambah Data
                    </a>
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                       Cetak
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

                                <label class="sr-only" for="inlineFormInputName">Produksi</label>
                                <input type="date" name="from_date" class="form-control" id="inlineFormInputName" placeholder="Jane Doe">
                            </div>
                            <div class="col-5 my-1">
                                <label for="formGroupExampleInput">Tanggal Akhir</label>

                                <label class="sr-only" for="inlineFormInputGroupUsername">Produksi</label>
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
            <table id="datatablesSimple" class=" table display cell-border" width="100%">
                <thead>
                    <tr class="table bg-dark text-white">
                        <th scope="col">No <small>Urutan</small></th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">AJ</th>
                        <th scope="col">AR</th>
                        <th scope="col">GP</th>
                        <th scope="col">GT</th>
                        <th scope="col">T-OI</th>
                        <th scope="col">K</th>
                        <th scope="col">T-JAWA</th>
                        <th scope="col">CR</th>
                        <th scope="col">CR</th>
                        <th scope="col">GSM</th>
                        <th scope="col">AR-25</th>
                        <th scope="col">AR-5</th>
                        <th scope="col">AR-1</th>
                        <th scope="col">RG-25</th>
                        <th scope="col">RG-5</th>
                        <th scope="col">RG-1</th>
                        <th scope="col">RG-KOTAK</th>
                        <th scope="col">R/BS</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($inventori as $row)
                    <?php
                    $n = date('Y-m-d', strtotime($row->created_at . " +1 days"));
                    ?>
                    <tr>

                        <th scope="row">{{ $loop->iteration}}</th>
                        <td>{{ $row ->created_at }}</td>
                        <td>{{ $row->keterangan}}</td>
                        <td>{{ $row->aj}}</td>
                        <td>{{ $row->ar}}</td>
                        <td>{{ $row->gp}}</td>
                        <td>{{ $row->gt}}</td>
                        <td>{{ $row->toi}}</td>
                        <td>{{ $row->k}}</td>
                        <td>{{ $row->tjawa}}</td>
                        <td>{{ $row->cr}}</td>
                        <td>{{ $row->gsm}}</td>
                        <td>{{ $row->ar25}}</td>
                        <td>{{ $row->ar5}}</td>
                        <td>{{ $row->ar1}}</td>
                        <td>{{ $row->rg25}}</td>
                        <td>{{ $row->rg5}}</td>
                        <td>{{ $row->rg1}}</td>
                        <td>{{ $row->rgkotak}}</td>
                        <td>{{ $row->rbs}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection