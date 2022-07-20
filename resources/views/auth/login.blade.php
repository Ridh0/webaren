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
            <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <div class="control__indicator"></div>
                </label>
                @if (Route::has('password.request'))
                <span class="ml-auto"><a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password</a></span>
                @endif
            </div>

            <input type="submit" value="Log In" class="btn btn-block btn-primary" />
        </form>
    </div>
</div>
@endsection