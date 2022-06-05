@extends('layouts.app')

@section('content')

   
<div class="container-fluid px-4 mb-3" >
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
    <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
    <div class="card">
        <div class="card-header">
        @if (session('status'))
                                {{ session('status') }}
                            @endif
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
                                <h3 class="card-title">POS</h3>
                                @if($produksi_detail->count() > 0)
                                <small>Total Data : {{$keranjang->total()}}</small>
                                @else
                                <small>Total Data : 0</small>
                                @endif
        </div>
        @if($produksi_detail->count() > 0)

        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    @foreach ($keranjang as $row)
                    <div id="Mylist" class="list-group  pb-3">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">NWO</h5>
                                <small>{{$row->created_at->diffForHumans()}}</small>
                            </div>
                            <div class="d-flex w-100  justify-content-between">
                                <p class="mb-1">{{$row->nwo}}</p>
                            
                            </div>
                            <button  data-id="{{$row->id}}" data-ar="{{$row->ar}}" data-nwo="{{$row->nwo}}" 
                                data-aj="{{$row->aj}}" 
                                data-toi="{{$row->toi}}" 
                                data-gt="{{$row->gt}}" 
                                data-gp="{{$row->gp}}" 
                                data-k="{{$row->k}}" 
                                data-tjawa="{{$row->tjawa}}" 
                                data-rbs="{{$row->rbs}}" 
                                class="btn btn-warning"   id="submit{{$row->id}}" type="button"  data-toggle="modal" data-target="#exampleModal" ><i class="fas fa-edit"></i></button>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between  align-items-center">
                                    <div class="d-inline p-2 text-light bg-dark rounded ">AJ<span class="ml-2 badge badge-light">{{$row->aj}} kg</span></div>
                                    <div class="d-inline p-2 bg-dark text-white rounded justify-content-between">AR<span class="ml-2 badge badge-light">{{$row->ar}} kg</span></div>
                                    <div class="d-inline p-2 bg-dark text-white rounded justify-content-between">GP<span class="ml-2 badge badge-light">{{$row->gp}} kg</span></div>
                                    <div class="d-inline p-2 bg-dark text-white rounded">GT<span class="ml-2 badge badge-light">{{$row->gt}} kg</span></div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-inline p-2 text-light bg-dark rounded text-white">TOI<span class="ml-2 badge badge-light">{{$row->toi}} kg</span></div>
                                    <div class="d-inline p-2 bg-dark text-white rounded justify-content-between">K<span class="ml-2 badge badge-light">{{$row->k}} kg</span></div>
                                    <div class="d-inline p-2 bg-dark text-white rounded justify-content-between">T-J<span class="ml-2 badge badge-light">{{$row->tjawa}} kg</span></div>
                                    <div class="d-inline p-2 bg-dark text-white rounded">R-BS<span class="ml-2 badge badge-light">{{$row->rbs}} kg</span></div>
                                </li>
                            </ul>
                        </a>
                    </div>
                    @endforeach

                </div>
            
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                            
                            {{$keranjang->links()}}
                        
            </div>
        </div>
        @else
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div id="Mylist" class="list-group  pb-3">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">
                            <div class="d-flex w-100 justify-content-between">
                                Kosong     
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-header">
                                <form action="{{route('produksi.create.cek.update')}}" method="post">
                                @CSRF

                                <h3 class="card-title">
                                        Customer
                                        <span>
                                            @if($total_k > 0 && $total_gt > 0 && $total_aj > 0 && $total_ar > 0 && $total_tjawa > 0 && $total_gp > 0 && $total_toi > 0  && $total_gt > 0)
                                            <button type="submit" class="btn btn-sm btn-info float-md-right ml-3" >Selesai</button>
                                            
                                            @else
                                            <button type="submit" class="btn btn-sm btn-danger float-md-right ml-3" disabled="disabled" alt="error">Selesai</button>
                                            
                                            @endif
                                        </span>
                                    </h3>
                                    <input type="hidden" name="aj" value="{{$total_aj}}">
                                    </form>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            @if($produksi_detail->count() > 0)
                            <ul class="list-group ">
                                <!-- <li class="alert list-group-item bg-danger ">
                                    <ul class="list-group text-white  ">
                                        <li class="list-group-item bg-danger justify-content-between align-items-center">
                                            Quisque hendrerit orci
                                            <span class="badge badge-primary badge-pill float-right">14</span>
                                        </li>
                                        <li class="list-group-item bg-danger justify-content-between align-items-center">
                                            Quisque hendrerit orci
                                            <span class="badge badge-primary badge-pill float-right">14</span>
                                        </li>
                                      
                                    </ul>
                                </li> -->
                                <li class=" list-group-item text-dark d-flex justify-content-between align-items-center">
                                    AJ<span class="badge {{($total_aj < 0) ? 'bg-secondary' : 'bg-success';}} ">{{$total_aj}}</span>
                                </li>
                                <li class=" list-group-item text-dark d-flex justify-content-between align-items-center">
                                    AR
                                    <span class="badge  {{($total_ar < 0) ? 'bg-danger' : 'bg-success';}}">{{$total_ar}}</span>
                                </li>
                                <li class=" list-group-item text-dark d-flex justify-content-between align-items-center">
                                    GP
                                    <span class="badge {{($total_gp < 0) ? 'bg-danger' : 'bg-success';}}">{{$total_gp}}</span>
                                </li>
                                <li class=" list-group-item text-dark d-flex justify-content-between align-items-center">
                                    GT
                                    <span class="badge {{($total_gt < 0) ? 'bg-danger' : 'bg-success';}}">{{$total_gt}}</span>
                                </li>
                                <li class=" list-group-item text-dark d-flex justify-content-between align-items-center">
                                    TOI
                                    <span class="badge {{($total_toi < 0) ? 'bg-danger' : 'bg-success';}}">{{$total_toi}}</span>
                                </li>
                                <li class=" list-group-item text-dark d-flex justify-content-between align-items-center">
                                    K
                                    <span class="badge {{($total_k < 0) ? 'bg-danger' : 'bg-success';}}">{{$total_k}}</span>
                                </li>
                                <li class=" list-group-item text-dark d-flex justify-content-between align-items-center">
                                    T-JAWA
                                    <span class="badge {{($total_tjawa < 0) ? 'bg-danger' : 'bg-success';}}">{{$total_k}}</span>
                                </li>
                                <li class=" list-group-item text-dark d-flex justify-content-between align-items-center">
                                    R-BS
                                    <span class="badge {{($total_rbs < 0) ? 'bg-danger' : 'bg-success';}}">{{$total_rbs}}</span>
                                </li>
                            </ul>
                            @else
                            <ul class="list-group ">
                                <!-- <li class="alert list-group-item bg-danger ">
                                    <ul class="list-group text-white  ">
                                        <li class="list-group-item bg-danger justify-content-between align-items-center">
                                            Quisque hendrerit orci
                                            <span class="badge badge-primary badge-pill float-right">14</span>
                                        </li>
                                        <li class="list-group-item bg-danger justify-content-between align-items-center">
                                            Quisque hendrerit orci
                                            <span class="badge badge-primary badge-pill float-right">14</span>
                                        </li>
                                      
                                    </ul>
                                </li> -->
                                <li class=" list-group-item text-dark d-flex justify-content-between align-items-center">
                                    Kosong
                                </li>
                            </ul>
                                    @endif
                               
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<script type="text/javascript">

</script>
@endsection