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
                        <th scope="col">Gula Batok</th>
                        <th scope="col">AR 25</th>
                        <th scope="col">AR 5</th>
                        <th scope="col">AR 1</th>
                        <th scope="col">RG 1</th>
                        <th scope="col">RG 5 </th>
                        <th scope="col">RG 25 </th>
                        <th scope="col">RG K 1</th>
                        <th scope="col">GSM</th>
                        <th scope="col">CR</th>
                        <th scope="col">AJ</th>
                        <th scope="col">K</th>
                        <th scope="col">TOI</th>
                   
                    </tr>
                </thead>
                <tbody>

                    @foreach($penjualan as $row)
                    
                    <tr>

                        <th class="text-center" scope="row">{{ $loop->iteration}}</th>
                        <td>{{ $row->total_gulabatok}}</td>
                        <td>{{ $row->total_ar25}}</td>
                        <td>{{ $row->total_ar5}}</td>
                        <td>{{ $row->total_ar1}}</td>
                        <td>{{ $row->total_rg1}}</td>
                        <td>{{ $row->total_rg5}}</td>
                        <td>{{ $row->total_rg25}}</td>
                        <td>{{ $row->total_rgk1}}</td>
                        <td>{{ $row->total_gsm}}</td>
                        <td>{{ $row->total_cr}}</td>
                        <td>{{ $row->total_aj}}</td>
                        <td>{{ $row->total_k}}</td>
                        <td>{{ $row->total_toi}}</td>
                    
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
    $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
<script>
     $('.delete-confirm').on('click', function (event) {
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