@extends('layouts.app')


@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Keuangan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">data keuangan</li>
    </ol>
    @include('sweetalert::alert')

    <div class="card mb-4">
        <div class="card-header ">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight"> <i class="fas fa-table me-1"></i>
                    Data Keuangan
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm float-right" href="{{route('keuangan.create')}}">
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
            <table id="table_id" class=" table display cell-border" width="100%">
                <thead>
                    <tr class="table bg-dark text-white">
                        <th scope="col">No <small>Urutan</small></th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Uang Masuk</th>
                        <th scope="col">Uang Keluar</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Kode</th>
                        <th scope="col">FD</th>
                        <th scope="col">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                <?php
                    function rupiah($angka){
	
                        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                        return $hasil_rupiah;
                     
                    }
                    ?>
                    @foreach($keuangan as $row)
                    <?php
                    $n = date('Y-m-d', strtotime($row->created_at . " +1 days"));
                    ?>
                    <tr>

                        <th class="text-center" scope="row">{{ $loop->iteration}}</th>
                        <td>{{ $row->created_at->diffForHumans() }}</td>
                        <td>{{ rupiah($row->masuk)}}</td>
                        <td>{{ rupiah($row->keluar)}}</td>
                        <td>{{ $row->status}}</td>
                        <td>@if($row->kode == 1)
                            <h4><span class="badge bg-warning">DW</span></h4>
                            @elseif($row->kode==2)
                            <h4><span class="badge bg-primary">AM</span></h4>
                            @else
                            <h4><span class="badge bg-danger">FD</span></h4>
                            @endif
                        </td>
                        <td>@if($row->fd == 1)
                            <h5><span class="badge bg-dark text-white">Hutang</span></h5>
                            @else
                            <h5><span class="badge bg-secondary ">Lunas</span></h5>
                            @endif</td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <a href="{{route('keuangan.show',$row->id)}}" class="btn btn-primary btn-sm ">Detail</a>
                                <a href="{{route('keuangan.edit',$row->id)}}" class="btn btn-warning btn-sm ">Edit</a>

                                <form method="POST" action="{{ route('keuangan.delete', $row->id) }}">
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