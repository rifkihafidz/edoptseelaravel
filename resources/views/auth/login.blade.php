@extends('layouts.app')

@section('content')
<!-- My CSS -->
<link href=" {{ URL::asset('css/style.css') }}" rel="stylesheet">

<div class="container" align="center">
  <div class="auth">
    <div class="card mt-4">
      <div class="card-body">
        <a href="/AdminLTE/index2.html"><img src="{{ url('images/Logooo.png') }}" class="rounded mx-auto d-block" width="250" height="150"></a><br>
        <h3 align="center"><strong>Silahkan Login</strong></h3><br>

        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="input-group mb-3">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="input-group mb-3">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <!-- /.col -->
          <div class="col-4 mb-4 mt-4">
            <button type="submit" class="btn btn-info btn-block">
              {{ __('Login') }}
            </button>
          </div>
          <!-- /.col -->
        </form>

        <p class="mb-1">
          <a href="{{ route('register') }}">Belum punya akun ?</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Lupa password ?</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</div>
@endsection