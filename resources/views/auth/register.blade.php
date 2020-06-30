@extends('layouts.app')

@section('content')
<!-- My CSS -->
<link href=" {{ URL::asset('css/style.css') }}" rel="stylesheet">

<div class="container" align="center">
    <div class="auth">
        <div class="card mt-4">
            <div class="card-body"><br>
                <a href="/AdminLTE/index2.html"><img src="{{ url('images/Logooo.png') }}" class="rounded mx-auto d-block" width="250" height="150"></a><br>
                <h3 align="center"><strong>Register</strong></h3><br>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Masukkan nama..." autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan email..." required autocomplete="email">

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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan password..." required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi password..." required autocomplete="new-password">
                    </div>

                    <div class="col-4 mt-4 mb-4">
                        <button type="submit" class="btn btn-info btn-block">
                            {{ __('Daftar') }}
                        </button>
                    </div>
                </form>

                <p class="mb-4">
                    <a href="{{ route('login') }}">Sudah punya akun ?</a>
                </p>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
</div>
@endsection