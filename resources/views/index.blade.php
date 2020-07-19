@extends('layouts.app')

@section('content')
<!-- My CSS -->
<link href="css/style.css" rel="stylesheet">

<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h5 class="display-4 animate__animated animate__slideInDown">Pilih dan Adopsi Hewan yang Sesuai dengan Keinginanmu.</h5>
    <a href="{{ route('adopt') }}"><button class="glow-on-hover">Adopsi Sekarang</button></a>
  </div>
</div>
<!-- Akhir Jumbotron -->


<!-- Container -->
<div class="container">

  <!-- Info Panel -->
  <div class="row justify-content-center animate__animated animate__zoomIn">
    <div class="col-10 info-panel">
      <div class="row">
        <div class="col-lg">
          <img src="{{ url('images/img/120px/love.png') }}" alt="Love" class="float-left">
          <h4>Love</h4>
          <p>Pilih hewan yang kamu<br>inginkan dari kota di<br>sekitarmu.</p>
        </div>
        <div class="col-lg">
          <img src="{{ url('images/img/120px/house.png') }}" alt="House" class="float-left">
          <h4>Home</h4>
          <p>Berikan rumah baru<br>kepada hewan melalui<br>E-dopt-see!</p>
        </div>
        <div class="col-lg">
          <img src="{{ url('images/img/120px/connect.png') }}" alt="Connect" class="float-left">
          <h4>Connect</h4>
          <p>Hubungkan pemilik hewan<br>dengan calon pengadopsi<br>secara online.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Info Panel -->

  <!-- Workingspace -->
  <div class="row workingspace mb-5 animate__animated animate__slideInUp">
    <div class="col-lg-6">
      <div id="carouselExampleIndicators" class="carousel slide" data-interval="2500" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{ url('images/img/resized/carousel1.png') }}" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ url('images/img/resized/carousel2.png') }}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ url('images/img/resized/carousel3.png') }}" alt="Third slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ url('images/img/resized/carousel4.png') }}" alt="Fourth slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ url('images/img/resized/carousel5.png') }}" alt="Fifth slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ url('images/img/resized/carousel6.png') }}" alt="Sixth slide">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <h3 style="text-align: center;">Berikan rumah <span><b>baru</b></span> kepada <span><b>hewan</b></span></h3>
      <p>E-dopt-see dibuat untuk membantu hewan liar atau hewan peliharaan yang ditinggalkan untuk menemukan pemilik dan rumah baru dan membantu pemilik hewan peliharaan untuk mengiklankan hewan mereka untuk diadopsi oleh calon pengadopsi secara online.</p>
    </div>
  </div>
  <!-- Akhir Workingspace -->
</div>
<!-- Akhir Container -->

<!-- Login Modal -->
<div class="container" align="center">
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="auth">
        <div class="modal-content">
          <div class="modal-body mt-3">
            <img src="{{ url('images/Logooo.png') }}" class="rounded mx-auto d-block">
            <h3 align="center"><strong>Masuk</strong></h3>

            <form action=" {{ route('login') }}" method="POST">
              @csrf
              <div class="input-group mb-3">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" placeholder="Email" autofocus>
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

              <button type="submit" class="glow-on-hover mb-2 mt-2" style="height: 50px; width:150px;">
                {{ __('Masuk') }}
              </button>

            </form>
            <p>
              <a href="{{ route('register') }}" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Belum punya akun ?</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Login Modal -->

<!-- Register Modal -->
<div class="container" align="center">
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="auth">
        <div class="modal-content">
          <div class="modal-body mt-3">
            <img src="{{ url('images/Logooo.png') }}" class="rounded mx-auto d-block mb-2">
            <h3 align="center" class="mb-3"><strong>Daftar</strong></h3>

            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="input-group mb-3">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Masukkan nama" autofocus>
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
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan email" required autocomplete="email">

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
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan password" required autocomplete="new-password">

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
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi password" required autocomplete="new-password">
              </div>

              <button type="submit" class="glow-on-hover" style="height: 50px; width:150px;">
                {{ __('Daftar') }}
              </button>
            </form>

            <p class="mt-2">
              <a href="{{ route('login') }}" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Sudah punya akun ?</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Register Modal -->
@endsection

@section('scripts')
<script type="text/javascript">
  @if(count($errors) > 0)
  $('#loginModal').modal('show');
  @endif
</script>
@endsection