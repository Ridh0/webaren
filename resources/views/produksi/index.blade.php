@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
<h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark  text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <div class="card-body" >
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
                            <table  id="datatablesSimple" class=" table display cell-border" width="100%">
                                <thead>
                                    <tr class="table bg-dark text-white">
                                        <th scope="col">No <small>Urutan</small></th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nomor WO</th>
                                        <th scope="col">AJ</th>
                                        <th scope="col">AR</th>
                                        <th scope="col">GP</th>
                                        <th scope="col">GT</th>
                                        <th scope="col">T-OI</th>
                                        <th scope="col">K</th>
                                        <th scope="col">T-JAWA</th>
                                        <th scope="col">R/BS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($produksi as $row)
                                    <?php 
                                        $n = date('Y-m-d', strtotime( $row ->created_at . " +1 days"));
                                        ?>
                                        <tr>
                                            
                                            <th scope="row">{{ $loop->iteration}}</th>
                                            <td>{{ $row ->created_at }}</td>
                                            <td>{{ $row->nwo}}</td>
                                            <td>{{ $row->aj}}</td>
                                            <td>{{ $row->ar}}</td>
                                            <td>{{ $row->gp}}</td>
                                            <td>{{ $row->gt}}</td>
                                            <td>{{ $row->toi}}</td>
                                            <td>{{ $row->k}}</td>
                                            <td>{{ $row->tjawa}}</td>
                                            <td>{{ $row->rbs}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
<div class="card mb-4 p-3">
    
        <div class="card-header">
            <div class="pb-2">
              
                <a class="btn btn-primary " href="{{route('produksi.export')}}">
                <span class="cil-plus btn-icon mr-2"></span>
                    Export
                </a>
                <a class="btn btn-primary " href="{{route('produksi.export.pdf')}}">
                <span class="cil-plus btn-icon mr-2"></span>
                    PDF
                </a>
            
            <div class="btn btn-primary btnnn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <span class="cil-description btn-icon mr-2"> </span>Cetak Data
            </div>
        </div>
        <div class="collapse btnn " id="collapseExample">
            <div class="card card-body">
                <form action="">
                    <div class="form-row align-items-center">
                        <div class="col-sm-5 my-1">
                            <label for="formGroupExampleInput">Tanggal Mulai</label>
                            
                            <label class="sr-only" for="inlineFormInputName">Name</label>
                            <input type="date" class="form-control" id="inlineFormInputName" placeholder="Jane Doe">
                        </div>
                        <div class="col-sm-5 my-1">
                            <label for="formGroupExampleInput">Tanggal Akhir</label>
                            
                            <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                            <div class="input-group">
                                
                                <input type="date" class="form-control" id="inlineFormInputGroupUsername" placeholder="Username">
                            </div>
                        </div>
                        
                        <div class="col-auto my-1 pt-4 mt-2">
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card-body">
            
            
            
            </div>
        </div>
    </div>    
</div>
@endsection
