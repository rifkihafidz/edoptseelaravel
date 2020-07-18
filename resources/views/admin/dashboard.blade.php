@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-4 justify-content-md-center">
      <div class="col-sm-8 text-center">
        <h1>Selamat datang di halaman admin E-dopt-see!</h1>
      </div>
    </div><!-- /.container-fluid -->
    <div class="row justify-content-md-center">
      <div class="col-sm-2">
        <div class="card">
          <div class="card-body text-center">
            <img src="{{ url('images/img/120px/connect.png') }}">
            <a href="{{ route('admin.adoptdata') }}" class="btn btn-block btn-info">Adopsi Berhasil</a>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="card">
          <div class="card-body text-center">
            <img src="{{ url('images/img/120px/folder.png') }}">
            <a href="{{ route('admin.applicationdata') }}" class="btn btn-block btn-info">Permohonan Adopsi</a>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="card">
          <div class="card-body text-center">
            <img src="{{ url('images/img/120px/paw.png') }}">
            <a href="{{ route('admin.postingdata') }}" class="btn btn-block btn-info">Post Hewan</a>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="card">
          <div class="card-body text-center">
            <img src="{{ url('images/img/120px/user.png') }}">
            <a href="{{ route('admin.userdata') }}" class="btn btn-block btn-info">Data Pengguna</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">

</section>
<!-- /.content -->
@endsection