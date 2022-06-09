@extends('layouts.app')

@section('content')
<form action="{{ route('produksi.store') }}" method="POST">
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
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="card mb-4">

      <input type="hidden" name="moreFields[0][id_user]" value="{{ Auth::user()->id }} ">

      <div class="card-header">
        <div class="d-flex bd-highlight ">
          <div class="me-auto p-2 bd-highlight">
            <a href="{{route('produksi')}}" class="float-right text-white btn btn-primary">

              Back
            </a>
          </div>
          <div class="p-2 bd-highlight">
            <button type="button" name="add" id="add-btn" class="float-right text-white btn btn-danger">
              Add More

            </button>

          </div>
          <div class="p-2 bd-highlight">
            <button type="submit" id="add-btn" class="btn text-white btn-success">
              Selesai
            </button>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row g-3">

          <div class="col-sm nwo">
            <label for="">Nomor Wo </label>

            <input class="form-control" name="moreFields[0][nwo]" value="{{ old('moreFields.0.nwo') }}" type="text" placeholder="Nomor WO" aria-label="City">
          </div>
          <div class="col-sm aj[0]">
            <label for="">Jumlah AJ </label>

            <input class="form-control showthis" name="moreFields[0][aj]" type="text" placeholder="Jumlah AJ" aria-label="State">
          </div>

          <div class="col-sm ar[0]">
            <label for="">Jumlah AR </label>

            <input class="form-control" name="moreFields[0][ar]" type="text" placeholder="Jumlah AR" aria-label="Zip">
          </div>


        </div>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-sm gp[0]">
            <label for="">Jumlah GP </label>

            <input class="form-control" name="moreFields[0][gp]" type="text" placeholder="Jumlah GP" aria-label="Zip">
          </div>
          <div class="col-sm gt[0]">
            <label for="">Jumlah GT </label>

            <input class="form-control" name="moreFields[0][toi]" type="text" placeholder="Jumlah GT" aria-label="Zip">
          </div>
          <div class="col-sm toi[0]">
            <label for="">Jumlah TOI </label>

            <input class="form-control" name="moreFields[0][k]" type="text" placeholder="Jumlah TOI" aria-label="Zip">
          </div>
          <div class="col-sm k[0]">
            <label for="">Jumlah K </label>

            <input class="form-control" name="moreFields[0][tjawa]" type="text" placeholder="Jumlah K" aria-label="Zip">
          </div>
          <div class="col-sm t-jawa[0]">
            <label for="">Jumlah T-Jawa </label>
            <input class="form-control" name="moreFields[0][rbs]" type="text" placeholder="Jumlah T-Jawa" aria-label="Zip">
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
  var i = 0;
  $("#add-btn").click(function() {
    i++;

    $("#dynamicAddRemove").append(
      '<div class="card mb-4" >' +
      '<div class="card-header">' +
      '<button type="button" class="btn text-white  btn-danger remove-tr">Remove</button></div><input type="hidden" name="moreFields[' + i + '][id_user]" value="{{ Auth::user()->id }} ">' +
      '<div class="card-body" ><div class="row g-3">' +
      '<div class="col-sm"><label for="">Nomor Wo ' + i + '  </label><input class="form-control" name="moreFields[' + i + '][nwo]"  type="text" placeholder="Nomor WO" aria-label="City"></div>' +
      '<div class="col-sm aj[' + i + '] "><label for="">Jumlah AJ  </label><input class="form-control" name="moreFields[' + i + '][aj]" type="text" placeholder="Jumlah AJ" aria-label="State"></div>' +
      '<div class="col-sm ar[' + i + ']"><label for="">Jumlah AR  </label><input class="form-control" name="moreFields[' + i + '][ar]" type="text" placeholder="Jumlah AR" aria-label="Zip"></div>' +
      '</div></div><div class="card-body" ><div class="row g-3">' +
      '<div class="col-sm gp[' + i + ']"><label for="">Jumlah GP  </label><input class="form-control" name="moreFields[' + i + '][gp]" type="text" placeholder="Jumlah GP" aria-label="Zip"></div>' +
      '<div class="col-sm gt[' + i + ']"><label for="">Jumlah GT  </label><input class="form-control" name="moreFields[' + i + '][gt]" type="text" placeholder="Jumlah GT" aria-label="Zip"></div>' +
      '<div class="col-sm toi[' + i + ']"><label for="">Jumlah TOI  </label><input class="form-control" name="moreFields[' + i + '][toi]" type="text" placeholder="Jumlah TOI" aria-label="Zip"></div>' +
      '<div class="col-sm k[' + i + ']"><label for="">Jumlah K  </label><input class="form-control" name="moreFields[' + i + '][k]" type="text" placeholder="Jumlah K" aria-label="Zip"></div>' +
      '<div class="col-sm t-jawa[' + i + ']"><label for="">Jumlah T-Jawa  </label><input class="form-control" name="moreFields[' + i + '][tjawa]" type="text" placeholder="Jumlah T-Jawa" aria-label="Zip">' +
      '</div></div></div></div>');
  });
  $(document).on('click', '.remove-tr', function() {
    $(this).closest('.card').remove();
  });
</script>
@endsection