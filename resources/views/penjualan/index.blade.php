@extends('layouts.app')


@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    @include('sweetalert::alert')

    <div class="card mb-4">
        <div class="card-header ">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight"> <i class="fas fa-table me-1"></i>
                    Data Produksi
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm float-right" href="{{route('penjualan.create')}}">
                        <span class="fas fa-table me-1"></span>
                        Tambah Data
                    </a>
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Cetak
                    </a>
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm" data-bs-toggle="collapse" href="#collapseExamples" role="button" aria-expanded="false" aria-controls="collapseExamples">
                        Tambah Distributor
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
            <div class="collapse" id="collapseExamples">
                <div class="card card-body mb-3">
                    <form action="{{ route('distributor.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sort_by" value="id">
                        <div class="row align-items-center justify-content-end">
                            <div class="col-sm my-1">
                                <label for="formGroupExampleInput">Tambah Distributor</label>
                                <div class="input-group">
                                    <input class="form-control" name="nama" type="text" required>
                                </div>
                            </div>
                            <div class="col-auto my-1 pt-3 mt-2">

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table id="table_id" class=" table display cell-border" width="100%">
                <thead>
                    <tr class="table bg-dark text-white">
                        <th scope="col">No <small>Urutan</small></th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nomor Faktur</th>
                        <th scope="col">No Gudang</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Status</th>
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($penjualan as $row)
                    <?php
                    $n = date('Y-m-d', strtotime($row->created_at . " +1 days"));
                    ?>
                    <tr>

                        <th class="text-center" scope="row">{{ $loop->iteration}}</th>
                        <td>{{ $row->created_at->diffForHumans() }}</td>
                        <td>{{ $row->nofaktur}}</td>
                        <td>{{ $row->notagudang}}</td>
                        <td>{{ $row->harga}}</td>
                        <td>{{ $row->status}}</td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <a href="{{route('penjualan.show',$row->id)}}" class="btn btn-primary btn-sm ">Detail</a>
                                <a href="{{route('penjualan.editbahan',$row->id)}}" class="btn btn-warning btn-sm ">Edit</a>

                                <form method="POST" action="{{ route('penjualan.delete', $row->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>
<script>
    $('.delete-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Lanjutkan menghapus data?`,
                text: "data tidak akan bisa di kembalikan",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
</script>
@endsection