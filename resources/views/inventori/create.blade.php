@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<form action="{{ route('inventori.store') }}" method="POST">
    @csrf
    @method('post')
    <div class="container-fluid" id="dynamicAddRemove">
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
        <h1 class="mt-4">Data Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Tambah Data Barang</li>
        </ol>
        <div class="row">
            <div class="col-sm-4">
                <div class="card mb-4">

                    <input type="hidden" name="moreFields[0][id_user]" value="{{ Auth::user()->id }} ">

                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm nwo">
                                <label for="">Keterangan </label>
                                <select name="keterangan" class="form-select">
                                    <option value="Masuk">Masuk</option>
                                    <option value="Keluar">Keluar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-sm nwo">
                                <label for="">Waktu & Tanggal </label>

                                <input class="form-control" name="moreFields[0][nwo]" value="{{ old('moreFields.0.nwo') }}" type="datetime-local" placeholder="Nomor WO" aria-label="City">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-12 nwo">
                                <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mb-4">

                    <div class="card-header">
                        Data Bahan Baku
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <style>
                                .addScroll {
                                    overflow-y: auto;
                                    height: 170px;
                                }
                            </style>
                            <div class="col-sm addScroll">
                                @php
                                $i=-1;
                                @endphp
                                @foreach ($databaku as $row)
                                @php
                                $i++;
                                @endphp
                                <label class="mt-2"><span class="badge bg-dark mb-1">{{strtoupper($row->name)}} </span></label>
                                <input class="form-control" name="{{ $row->name }}" id="h{{$i}}" value="" type="text" placeholder="Silahkan Isi {{ strtoupper($row->name) }}" aria-label="City" onkeyup="calculate_bahan()">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon3">
                                        Jumlah Bahan </span>
                                    <input type="text" name="jmlbahan" class="form-control" id="jmlbahan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mb-4">
                    <div class="card-header">
                        Data Barang Hasil
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <style>
                                .addScroll {
                                    overflow-y: auto;
                                    height: 170px;
                                }
                            </style>
                            <div class="col-sm addScroll">
                                @php
                                $i=-1;
                                @endphp
                                @foreach ($datahasil as $row)
                                @php
                                $i++;
                                @endphp
                                <label class="mt-2"><span class="badge bg-dark mb-1">{{strtoupper($row->name)}} </span></label>
                                <input class="form-control" name="{{ $row->name }}" id="v{{$i}}" value="" type="text" placeholder="Silahkan Isi {{ strtoupper($row->name) }}" aria-label="City" onkeyup="calculate_hasil()">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm">
                                <input type="text" name="jmlhasil" class="form-control" id="jmlhasil">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</form>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function formatNumber(num) {
        let nf = new Intl.NumberFormat('en-US');
        nf.format(num); // "1,234,567,890"
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function calculate_hasil() {
        var result = document.getElementById('jmlhasil');
        var el, i = 0,
            total = 0;

        while (el = document.getElementById('v' + (i++))) {
            el.value = el.value.toString().replace(/\B(?=(\ d{3})+(?!\ d))/g, ',');
            total = total + Number(el.value);
        }
        result.value = numberWithCommas(total);

    }

    function calculate_bahan() {
        var hasil = document.getElementById('jmlbahan');
        var el, i = 0,
            total = 0;

        while (el = document.getElementById('h' + (i++))) {
            el.value = el.value.toString().replace(/\B(?=(\ d{3})+(?!\ d))/g, ',');
            total = total + Number(el.value);
        }
        hasil.value = numberWithCommas(total);

    }
</script>
@endsection