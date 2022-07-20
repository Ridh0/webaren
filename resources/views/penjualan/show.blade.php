@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    @foreach($penjualans as $penjualans)
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="card mb-4">

                        <div class="card-header d-flex justify-content-between">
                            <div class="float-left">
                                <h3 class="">Data Details</h3>

                            </div>
                            <div class="float-right">
                                <a href="" class="btn btn-primary btn-sm"><i class="la la-angle-left"></i> Kembali</a>

                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <div class="d-flex justify-content-between border mb-3 p-3">
                                        <div>
                                            <span class="d-block">Nama Pembeli</span>
                                        </div>
                                        <div>
                                            {{$penjualans->user->name}}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between border mb-3 p-3">
                                        <div>
                                            <span class="d-block">Tanggal</span>
                                        </div>
                                        <div>
                                            {{$penjualans->tanggal}}

                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between border mb-3 p-3">
                                        <div>
                                            <span class="d-block">Nama</span>
                                        </div>
                                        <div>
                                            {{$penjualans->nama}}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between border mb-3 p-3">
                                        <div>
                                            <span class="d-block">No Faktur</span>
                                        </div>
                                        <div>
                                            {{$penjualans->nofaktur}}

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center">

                                    <div class="d-flex justify-content-between border mb-3 p-3">
                                        <div>
                                            <span class="d-block">Nota Gudang</span>
                                        </div>
                                        <div>
                                            {{$penjualans->notagudang}}

                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between border mb-3 p-3">
                                        <div>
                                            <span class="d-block">Harga</span>
                                        </div>
                                        <div>
                                            {{$penjualans->harga}}

                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between border mb-3 p-3">
                                        <div>
                                            <span class="d-block">Kode</span>
                                        </div>
                                        <div>
                                            {{$penjualans->kode}}

                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between border mb-3 p-3">
                                        <div>
                                            <span class="d-block">Status</span>
                                        </div>
                                        <div>
                                            {{$penjualans->status}}

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 mb-4">
                    <div class="card ">

                        <div class="card-header d-flex justify-content-between">
                            <div class="float-left">
                                <h3 class="">Bahan Baku</h3>

                            </div>

                        </div>
                        <div class="card-body ">
                            @if($penjualans->aj > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">AJ</span>
                                </div>
                                <div>
                                    {{$penjualans->aj}}

                                </div>
                            </div>
                            @endif
                            @if($penjualans->k > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">K</span>
                                </div>
                                <div>
                                    {{$penjualans->k}}

                                </div>
                            </div>
                            @endif
                            @if($penjualans->toi > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">TO-I</span>
                                </div>
                                <div>
                                    {{$penjualans->toi}}

                                </div>
                            </div>
                            @endif
                            @if($penjualans->gsm > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">GSM</span>
                                </div>
                                <div>
                                    {{$penjualans->gsm}}

                                </div>
                            </div>
                            @endif
                            @if($penjualans->cr > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">CR</span>
                                </div>
                                <div>
                                    {{$penjualans->cr}}

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card ">

                        <div class="card-header d-flex justify-content-between">
                            <div class="float-left">
                                <h3 class="">Bahan Sudah Jadi</h3>

                            </div>

                        </div>
                        <div class="card-body ">
                            @if($penjualans->gulabatok > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">Gula Batok</span>
                                </div>
                                <div>
                                    {{$penjualans->gulabatok}}

                                </div>
                            </div>
                            @endif
                            @if($penjualans->ar25 > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">AR 25</span>
                                </div>
                                <div>
                                    {{$penjualans->ar25}}

                                </div>
                            </div>
                            @endif
                            @if($penjualans->ar5 > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">AR 5</span>
                                </div>
                                <div>
                                    {{$penjualans->ar5}}

                                </div>
                            </div>
                            @endif
                            @if($penjualans->ar1 > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">AR 1</span>
                                </div>
                                <div>
                                    {{$penjualans->ar1}}

                                </div>
                            </div>
                            @endif
                            @if($penjualans->rg1 > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">RG 1</span>
                                </div>
                                <div>
                                    {{$penjualans->rg1}}

                                </div>
                            </div>
                            @endif
                            @if($penjualans->rg25 > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">RG 25</span>
                                </div>
                                <div>
                                    {{$penjualans->rg25}}

                                </div>
                            </div>
                            @endif
                            @if($penjualans->rg5 > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">RG 5</span>
                                </div>
                                <div>
                                    {{$penjualans->rg5}}

                                </div>
                            </div>
                            @endif
                            @if($penjualans->rgk1 > 1)
                            <div class="d-flex justify-content-between border mb-3 p-3">
                                <div>
                                    <span class="d-block">RG Kotak</span>
                                </div>
                                <div>
                                    {{$penjualans->rgk1}}

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection