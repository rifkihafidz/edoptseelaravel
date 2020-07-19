@extends('layouts.app')

@section('content')

<!-- My CSS -->
<link href=" {{ URL::asset('css/style.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3 pt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background:#f9f9f9">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('adopt') }}">Adopsi Hewan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil {{ $user->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 mt-1 mb-2">
            <div class="card text-center" style="background:#f9f9f9;">
                <div class="card-body active animate__animated animate__fadeIn">
                    <img src="/assets/uploads/avatars/{{ $user->avatar }}" style="width:75px; height:75px; border-radius:50%;" class="img-fluid mx-auto d-block mb-3">
                    <p style="font-size:24px;">
                        <strong>{{ $user->name }}</strong><br>
                        <strong style="font-size:20px;">{{ $user->alamat }}</strong><br>
                        <strong class="text-muted" style="font-size: 16px;">Anggota sejak : {{ $user->created_at }}</strong>
                    </p>
                </div>
                <div class="col-md-12">
                    <div class="card mb-3" style="background:#f9f9f9">
                        <!-- Nav Tabs -->
                        <div class="navtabsatas">
                            <ul class="nav nav-tabs justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#allposts">Semua Post</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#availableposts">Post Tersedia</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#adoptedposts">Post Teradopsi</a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Nav Tabs -->
                        <!-- Tab Panes -->
                        <div class="row justify-content-center">
                            <div class="tab-content justify-content-center">
                                <!-- Tab Content -->
                                <!-- All posts -->
                                <div class="container tab-pane active animate__animated animate__fadeIn" id="allposts">
                                    <div class="container">
                                        <div class="card-body" style="text-align: center;">
                                            <div class="row justify-content-center mt-1">
                                                @if(count($allposts) > 0)
                                                @foreach($allposts as $post)
                                                <div class="col-md-4 mb-3">
                                                    <img src="{{ url('assets/uploads') }}/{{ $post->img }}" class="img-fluid" style="border-top-left-radius:15px; border-top-right-radius:15px">
                                                    <div class="card-body" style="background:#f1f1f6; border-bottom-left-radius:15px; border-bottom-right-radius:15px; height:240px;">
                                                        <h5 class="card-subtitle">{{ $post->name }}</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">Tanggal Post : {{ $post->date }}</h6>
                                                        <p class="card-text" style="text-align: center;">
                                                            <strong>Status : {{ $post->status }}</strong><br>
                                                            <strong>Umur : {{ $post->age }} year(s)</strong><br>
                                                            <strong>Latar Belakang : {{ $post->background }} </strong><br>
                                                        </p>
                                                        <a class="btn btn-info btn-block mt-3" href="{{ route('details',$post->id) }}"><i class="fa fa-paw"></i> Detail</a>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <strong>{{ $user->name }} belum membuat post apapun.</strong>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End All Posts -->

                                <!-- Available Posts -->
                                <div class="container tab-pane fade animate__animated animate__fadeIn" id="availableposts">
                                    <div class="container">
                                        <div class="card-body">
                                            <div class="row justify-content-center mt-1">
                                                @if(count($availableposts) > 0)
                                                @foreach($availableposts as $post)
                                                <div class="col-md-4 mb-3">
                                                    <img src="{{ url('assets/uploads') }}/{{ $post->img }}" class="img-fluid" style="border-top-left-radius:15px; border-top-right-radius:15px">
                                                    <div class=" card-body" style="background:#f1f1f6; border-bottom-left-radius:15px; border-bottom-right-radius:15px; height:240px;">
                                                        <h5 class="card-subtitle">{{ $post->name }}</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">Tanggal Post : {{ $post->date }}</h6>
                                                        <p class="card-text" style="text-align: center;">
                                                            <strong>Status : {{ $post->status }}</strong><br>
                                                            <strong>Umur : {{ $post->age }} year(s)</strong><br>
                                                            <strong>Latar Belakang : {{ $post->background }} </strong><br>
                                                        </p>
                                                        <a class="btn btn-info btn-block mt-3" href="{{ route('details',$post->id) }}"><i class="fa fa-paw"></i> Detail</a>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <strong>Tidak ada post {{ $user->name }} yang tersedia.</strong>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Available Posts -->

                                <!-- Adopted Posts -->
                                <div class="container tab-pane fade animate__animated animate__fadeIn" id="adoptedposts">
                                    <div class="container">
                                        <div class="card-body">
                                            <div class="row justify-content-center mt-1">
                                                @if(count($adoptedposts) > 0)
                                                @foreach($adoptedposts as $post)
                                                <div class="col-md-4 mb-3">
                                                    <img src="{{ url('assets/uploads') }}/{{ $post->img }}" class="img-fluid" style="border-top-left-radius:15px; border-top-right-radius:15px">
                                                    <div class=" card-body" style="background:#f1f1f6; border-bottom-left-radius:15px; border-bottom-right-radius:15px; height:240px;">
                                                        <h5 class="card-subtitle">{{ $post->name }}</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">Tanggal Post : {{ $post->date }}</h6>
                                                        <p class="card-text" style="text-align: center;">
                                                            <strong>Status : {{ $post->status }}</strong><br>
                                                            <strong>Umur : {{ $post->age }} year(s)</strong><br>
                                                            <strong>Latar Belakang : {{ $post->background }} </strong><br>
                                                        </p>
                                                        <a class="btn btn-info btn-block mt-3" href="{{ route('details',$post->id) }}"><i class="fa fa-paw"></i> Detail</a>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <strong>Tidak ada post {{ $user->name }} yang teradopsi.</strong>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Adopted Posts -->
                                <!-- End Tab Content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection