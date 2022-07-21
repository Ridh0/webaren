@extends('layouts.auth')

@section('content')
<div class="row align-items-center justify-content-center">
    <div class="col-md-7">
        <h3>Silahkan <strong>Login</strong></h3>
        <p class="mb-4">
            masukkan username dan password
        </p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group first">
                <label for="username">Username</label>
                <input id="email" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                @error('username')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
           
            <input type="submit" value="Log In" class="btn btn-block btn-primary" />
        </form>
    </div>
</div>
@endsection