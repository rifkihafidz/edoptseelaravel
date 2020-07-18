@extends('layouts.app')

@section('content')

<!-- My CSS -->
<link href=" {{ URL::asset('css/style.css') }}" rel="stylesheet">

<div class="profilepage">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3 pt-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background:#f9f9f9">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-12 mt-1 mb-2 animate__animated animate__fadeIn">
                <div class="card" style="background:#f9f9f9">
                    <div class="card-body">
                        <div class="float-left pb-2 pl-2">
                            <img src="/assets/uploads/avatars/{{ $user->avatar }}" style="width:75px; height:75px; border-radius:50%;" class="img-fluid">
                        </div>
                        <div class="float-right pb-2 pt-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-info">
                                <i class="fa fa-pencil-alt"></i> Ubah Profile
                            </a>
                        </div>
                        <table class="table table-responsive-sm">
                            <tbody class="tbody">
                                <tr>
                                    <td class="tdprofile">Nama</td>
                                    <td class="tdprofile" width="3">:</td>
                                    <td class="tdprofile">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="tdprofile">E-mail</td>
                                    <td class="tdprofile" width="3">:</td>
                                    <td class="tdprofile">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="tdprofile">No. HP</td>
                                    <td class="tdprofile" width="3">:</td>
                                    <td class="tdprofile">{{ $user->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td class="tdprofile">Alamat</td>
                                    <td class="tdprofile" width="3">:</td>
                                    <td class="tdprofile">{{ $user->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mb-3" style="background:#f9f9f9">
                    <!-- Nav tabs -->
                    <div class="navtabsatas">
                        <ul class="nav nav-tabs justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#myposts">Post Saya</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#appreceived">Permohonan Masuk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#appsent">Permohonan Keluar</a>
                            </li>
                        </ul>
                        <!-- End nav tabs -->
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- Tab 1 (My Posts) -->
                            <div id="myposts" class="container tab-pane active">
                                <!-- Nav tabs -->
                                <div class="navtabsbawah">
                                    <ul class="nav nav-tabs justify-content-center mt-2">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#allposts"><i class="fa fa-list"></i> Semua</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#availableposts"><i class="fa fa-check"></i> Tersedia</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#adoptedposts"><i class="fa fa-paw"></i> Teradopsi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#ripposts"><i class="fa fa-skull-crossbones"></i> Tiada</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End nav tabs -->
                                <div class="row justify-content-center">
                                    <div class="tab-content">
                                        <!-- Content -->
                                        <!-- All posts -->
                                        <div class="container tab-pane active animate__animated animate__fadeIn" id="allposts">
                                            <div class="container">
                                                <div class="card-body" style="text-align: center;">
                                                    <div class="row justify-content-center mt-1">
                                                        @if(count($postings) > 0)
                                                        @foreach($postings as $posting)
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <img src="{{ url('assets/uploads') }}/{{ $posting->img }}" class="img-fluid" style="border-top-left-radius:15px; border-top-right-radius:15px">
                                                                <div class="allpost">
                                                                    <div class="card-body" style="background:#f1f1f6; border-bottom-left-radius:15px; border-bottom-right-radius:15px;">
                                                                        <h5 class="card-subtitle">{{ $posting->name }}</h5>
                                                                        <h6 class="card-subtitle mb-2 text-muted">Tanggal post : {{ $posting->date }}</h6>
                                                                        <p class="card-text" style="text-align: center;">
                                                                            <strong>Status : {{ $posting->status }}</strong><br>
                                                                            <strong>Umur : {{ $posting->age }} year(s)</strong><br>
                                                                            <strong>Latar Belakang : {{ $posting->background }} </strong><br>
                                                                        </p>
                                                                        @if($posting->status != 'Tersedia' && $posting->status != 'Tiada' && $posting->status != 'Teradopsi')
                                                                        <h6 class="card-subtitle mb-2" style="text-align:center;"><strong>Tanggal adopsi : {{ $adopt->adoptdate }}</strong></h6>
                                                                        @endif
                                                                        @if($posting->status == 'Tersedia' || $posting->status == 'Teradopsi' || $posting->status == 'Tiada')
                                                                        <a href="{{ route('posting.edit',$posting->id) }}" class="btn btn-info btn-block"><i class="fa fa-pencil-alt"></i> Ubah</a>

                                                                        <button type="button" class="btn btn-danger btn-block mt-2 btn-trash" data-toggle="modal" data-target="#deleteModalAll{{$posting->id}}" data-id={{ $posting->id }}><i class="fa fa-trash"></i> Hapus</button>
                                                                        </form>
                                                                        @else
                                                                        <button type="button" class="btn btn-info btn-block mt-3" data-toggle="modal" data-target="#modalDetailPost{{ $posting->id }}"><i class="fa fa-paw"></i> Detail</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">Anda belum membuat post.</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End all posts -->

                                        <!-- Avaliable posts -->
                                        <div class="container tab-pane fade animate__animated animate__fadeIn" id="availableposts">
                                            <div class="container">
                                                <div class="card-body">
                                                    <div class="row justify-content-center mt-1">
                                                        @if(count($postavail) > 0)
                                                        @foreach($postavail as $posting)
                                                        <div class="col-md-4">
                                                            <div class="mb-4">
                                                                <img src="{{ url('assets/uploads') }}/{{ $posting->img }}" class="img-fluid" style="border-top-left-radius:15px; border-top-right-radius:15px">
                                                                <div class="card-body" style="background:#f1f1f6; border-bottom-left-radius:15px; border-bottom-right-radius:15px;">
                                                                    <h5 class="card-subtitle" style="text-align:center;">{{ $posting->name }}</h5>
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Tanggal post : {{ $posting->date }}</h6>
                                                                    <p class="card-text" style="text-align: center;">
                                                                        <strong>Status : {{ $posting->status }}</strong><br>
                                                                        <strong>Umur : {{ $posting->age }} year(s)</strong><br>
                                                                        <strong>Latar Belakang : {{ $posting->background }} </strong><br>
                                                                    </p>
                                                                    <a href="{{ route('posting.edit',$posting->id) }}" class="btn btn-info btn-block"><i class="fa fa-pencil-alt"></i> Ubah</a>
                                                                    <button type="button" class="btn btn-danger btn-block mt-2 btn-trash" data-toggle="modal" data-target="#deleteModalAvailable{{$posting->id}}" data-id={{ $posting->id }}><i class="fa fa-trash"></i> Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">Tidak ada post hewan yang tersedia.</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End available posts -->

                                        <!-- Adopted posts -->
                                        <div class="container tab-pane fade animate__animated animate__fadeIn" id="adoptedposts">
                                            <div class="container">
                                                <div class="card-body">
                                                    <div class="row justify-content-center mt-1">
                                                        @if(count($postadopted) > 0)
                                                        @foreach($postadopted as $posting)
                                                        <div class="col-md-4">
                                                            <div class="mb-4">
                                                                <img src="{{ url('assets/uploads') }}/{{ $posting->img }}" class="img-fluid" style="border-top-left-radius:15px; border-top-right-radius:15px">
                                                                <div class=" card-body" style="background:#f1f1f6; border-bottom-left-radius:15px; border-bottom-right-radius:15px;">
                                                                    <h5 class="card-subtitle" style="text-align:center;">{{ $posting->name }}</h5>
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Tanggal post : {{ $posting->date }}</h6>
                                                                    <p class="card-text" style="text-align: center;">
                                                                        <strong>Status : {{ $posting->status }}</strong><br>
                                                                        <strong>Umur : {{ $posting->age }} year(s)</strong><br>
                                                                        <strong>Latar Belakang : {{ $posting->background }} </strong><br>
                                                                    </p>
                                                                    @if($posting->status != 'Tersedia' && $posting->status != 'Tiada' && $posting->status != 'Teradopsi')
                                                                    <h6 class="card-subtitle mb-2" style="text-align:center;"><strong>Tanggal teradopsi : {{ $adopt->adoptdate }}</strong></h6>
                                                                    @endif
                                                                    @if($posting->status == 'Teradopsi')
                                                                    <a href="{{ route('posting.edit',$posting->id) }}" class="btn btn-info btn-block"><i class="fa fa-pencil-alt"></i> Ubah</a>
                                                                    <button type="button" class="btn btn-danger btn-block mt-2 btn-trash" data-toggle="modal" data-target="#deleteModalAdopted{{$posting->id}}" data-id={{ $posting->id }}><i class="fa fa-trash"></i> Hapus</button>
                                                                    </form>
                                                                    @else
                                                                    <button type="button" class="btn btn-info btn-block mt-3" data-toggle="modal" data-target="#modalDetailPostAccepted{{ $posting->id }}"><i class="fa fa-paw"></i> Detail</button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">Tidak ada post hewan yang teradopsi.</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End adopted posts -->

                                        <!-- Rip posts -->
                                        <div class="container tab-pane fade animate__animated animate__fadeIn" id="ripposts">
                                            <div class="container">
                                                <div class="card-body">
                                                    <div class="row justify-content-center mt-1">
                                                        @if(count($postrip) > 0)
                                                        @foreach($postrip as $posting)
                                                        <div class="col-md-4">
                                                            <div class="mb-4">
                                                                <img src="{{ url('assets/uploads') }}/{{ $posting->img }}" class="img-fluid" style="border-top-left-radius:15px; border-top-right-radius:15px">
                                                                <div class=" card-body" style="background:#f1f1f6; border-bottom-left-radius:15px; border-bottom-right-radius:15px;">
                                                                    <h5 class="card-subtitle" style="text-align:center;">{{ $posting->name }}</h5>
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Tanggal post : {{ $posting->date }}</h6>
                                                                    <p class="card-text" style="text-align: center;">
                                                                        <strong>Status : {{ $posting->status }}</strong><br>
                                                                        <strong>Umur : {{ $posting->age }} year(s)</strong><br>
                                                                        <strong>Latar Belakang : {{ $posting->background }} </strong><br>
                                                                    </p>
                                                                    <a href="{{ route('posting.edit',$posting->id) }}" class="btn btn-info btn-block"><i class="fa fa-pencil-alt"></i> Ubah</a>
                                                                    <button type="button" class="btn btn-danger btn-block mt-2 btn-trash" data-toggle="modal" data-target="#deleteModalRIP{{$posting->id}}" data-id={{ $posting->id }}><i class="fa fa-trash"></i> Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">Tidak ada post hewan yang tiada.</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End rip posts -->
                                        <!-- End content -->
                                    </div>
                                    <!-- End all posts -->
                                </div>
                            </div>
                            <!-- End tab 1 (My Posts) -->

                            <!-- Tab 2 (Application Received) -->
                            <div id="appreceived" class="container tab-pane fade">
                                <!-- Nav tabs -->
                                <div class="navtabsbawah">
                                    <ul class="nav nav-tabs justify-content-center mt-2">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#receiveall"><i class="fa fa-list"></i> Semua</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#receivepending"><i class="fa fa-clock"></i> Pending
                                                @if(!empty($notifreceivedpending)) <span class="badge badge-danger pb-1">{{ $notifreceivedpending }}</span> @endif</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#receiveaccepted"><i class="fa fa-check"></i> Diterima</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#receiverejected"><i class="fa fa-ban"></i> Ditolak</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End nav tabs -->

                                <!-- Tab content -->
                                <div class="justify-content-center">
                                    <div class="tab-content">
                                        <div class="container tab-pane active animate__animated animate__fadeIn" id="receiveall">
                                            <div class="container">
                                                <div class="card-body">
                                                    <div class="row justify-content-center mt-1">
                                                        @if(count($applicationreceived) > 0)
                                                        @foreach($applicationreceived as $received)
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <div class="allreceive">
                                                                    <div class="card" style="border-radius:15px;">
                                                                        <div class="card-body">
                                                                            <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#modalDetailAll{{ $received->id }}">Permohonan {{ $received->animalsname }}</h5>
                                                                            <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#modalDetailAll{{ $received->id }}">
                                                                            <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pengirim : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                                                                            @if($received->status == "0")
                                                                            <form action="{{ route('accept.application') }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="id" value="{{ $received->id }}">
                                                                                <button onclick="return confirm('Apakah anda yakin ingin menerima permohonan ini ?')" type="submit" class="btn btn-info btn-block mb-2 btn-sm">Terima</button>
                                                                            </form>
                                                                            <form action="{{ route('reject.application') }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="id" value="{{ $received->id }}">
                                                                                <button onclick="return confirm('Apakah anda yakin ingin menolak permohonan ini ?')" type="submit" class="btn btn-danger btn-block btn-sm">Tolak</button>
                                                                            </form>
                                                                            @elseif($received->status == "1")
                                                                            <button class="btn btn-info btn-block mb-2 btn-sm" disabled><i class="fas fa-check"></i> Diterima</button>
                                                                            <form action="{{ route('set.adopter') }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="idapply" value="{{ $received->id }}">
                                                                                <input type="hidden" name="idpost" value="{{ $received->id_post }}">
                                                                                <button onclick="return confirm('Apakah anda yakin ingin menjadikan {{ $received->submittername }} sebagai pengadopsi {{ $received->animalsname }} ?')" type="submit" class="btn btn-info btn-block btn-sm">Jadikan Pengadopsi</button>
                                                                            </form>
                                                                            @elseif($received->status == "2")
                                                                            <button class="btn btn-danger btn-block btn-sm" disabled><i class="fas fa-times"></i> Ditolak</button>
                                                                            @elseif($received->status == "3")
                                                                            <button class="btn btn-success btn-block mb-2 btn-sm" disabled><i class="fas fa-check"></i> Pengadopsi {{$received->animalsname}}</button>
                                                                            @elseif($received->status == "4")
                                                                            <button class="btn stylish-color-dark btn-block mb-2 btn-sm" disabled><i class="fas fa-exclamation"></i> Teradopsi oleh orang lain <i class="fas fa-exclamation"></i></button>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">Tidak ada post hewan yang menerima permohonan.</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container tab-pane fade animate__animated animate__fadeIn" id="receivepending">
                                            <div class="container">
                                                <div class="card-body">
                                                    <div class="row justify-content-center mt-1">
                                                        @if(count($applicationreceivedpending) > 0)
                                                        @foreach($applicationreceivedpending as $received)
                                                        <div class="col-md-4">
                                                            <div class="card mb-3" style="border-radius:15px;">
                                                                <div class="card-body">
                                                                    <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#modalDetailPending{{ $received->id }}">Permohonan {{ $received->animalsname }}</h5>
                                                                    <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#modalDetailPending{{ $received->id }}">
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pengirim : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                                                                    <form action="{{ route('accept.application') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{ $received->id }}">
                                                                        <button onclick="return confirm('Apakah anda yakin ingin menerima permohonan ini ?')" type="submit" class="btn btn-info btn-block btn-sm mb-2">Terima</button>
                                                                    </form>
                                                                    <form action="{{ route('reject.application') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{ $received->id }}">
                                                                        <button onclick="return confirm('Apakah anda yakin ingin menolak permohonan ini ?')" type="submit" class="btn btn-danger btn-sm btn-block">Tolak</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">Tidak ada permohonan yang masuk.</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container tab-pane fade animate__animated animate__fadeIn" id="receiveaccepted">
                                            <div class="container">
                                                <div class="card-body">
                                                    <div class="row justify-content-center mt-1">
                                                        @if(count($applicationreceivedaccept) > 0)
                                                        @foreach($applicationreceivedaccept as $received)
                                                        <div class="col-md-4">
                                                            <div class="allreceive">
                                                                <div class="card mb-3" style="border-radius:15px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#modalDetailAccepted{{ $received->id }}">Permohonan {{ $received->animalsname }}</h5>
                                                                        <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#modalDetailAccepted{{ $received->id }}">
                                                                        <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pengirim : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                                                                        @if($received->status == '1')
                                                                        <button class="btn btn-info btn-block btn-sm mb-2" disabled><i class="fas fa-check"></i> Diterima</button>
                                                                        <form action="{{ route('set.adopter') }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="idapply" value="{{ $received->id }}">
                                                                            <input type="hidden" name="idpost" value="{{ $received->id_post }}">
                                                                            <button onclick="return confirm('Apakah anda yakin ingin menerima permohonan ini ?')" type="submit" class="btn btn-info btn-block btn-sm">Jadikan Pengadopsi</button>
                                                                        </form>
                                                                        @elseif($received->status == '3')
                                                                        <button class="btn btn-success btn-block btn-sm" disabled><i class="fas fa-check"></i> Pengadopsi {{ $received->animalsname }}</button>
                                                                        @elseif($received->status == "4")
                                                                        <button class="btn stylish-color-dark btn-block mb-2 btn-sm" disabled><i class="fas fa-exclamation"></i> Teradopsi oleh orang lain <i class="fas fa-exclamation"></i></button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">Tidak ada permohonan masuk yang diterima.</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container tab-pane fade animate__animated animate__fadeIn" id="receiverejected">
                                            <div class="container">
                                                <div class="card-body">
                                                    <div class="row justify-content-center mt-1">
                                                        @if(count($applicationreceivedreject) > 0)
                                                        @foreach($applicationreceivedreject as $received)
                                                        <div class="col-md-4">
                                                            <div class="card mb-3" style="border-radius:15px;">
                                                                <div class="card-body">
                                                                    <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#modalDetailRejected{{ $received->id }}">Permohonan {{ $received->animalsname }}</h5>
                                                                    <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#modalDetailRejected{{ $received->id }}">
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pengirim : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                                                                    <button class="btn btn-danger btn-block btn-sm" disabled><i class="fas fa-times"></i> Ditolak</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">Tidak ada permohonan masuk yang ditolak.</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End tab content -->
                            </div>
                            <!-- End Tab 2 (Application Received) -->

                            <!-- Tab application sent -->
                            <div id="appsent" class="container tab-pane fade">
                                <!-- Nav tabs -->
                                <div class="navtabsbawah">
                                    <ul class="nav nav-tabs justify-content-center mt-2">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#sentall"><i class="fa fa-list"></i> Semua</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#sentpending"><i class="fa fa-clock"></i> Pending</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#sentaccepted"><i class="fa fa-check"></i> Diterima</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#sentrejected"><i class="fa fa-ban"></i> Ditolak</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End nav tabs -->

                                <!-- Tab content -->
                                <div class="justify-content-center">
                                    <div class="tab-content">
                                        <div class="container tab-pane active animate__animated animate__fadeIn" id="sentall">
                                            <div class="container">
                                                <div class="card-body">
                                                    <div class="row justify-content-center mt-1">
                                                        @if(count($applicationsent) > 0)
                                                        @foreach($applicationsent as $sent)
                                                        <div class="col-md-4">
                                                            <div class="card mb-3" style="border-radius:15px;">
                                                                <div class="card-body">
                                                                    <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#detailSentAll{{ $sent->id }}">Permohonan {{ $sent->animalsname }}</h5>
                                                                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#detailSentAll{{ $sent->id }}">
                                                                    @if($sent->status == '0')
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pemilik : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a> <br>{{ $sent->location }}</h6>
                                                                    <button class="btn stylish-color-dark btn-block btn-sm" disabled><i class="fas fa-clock"></i> Pending</button>
                                                                    @elseif($sent->status == '1')
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pemilik : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    <button class="btn btn-info btn-block btn-sm" disabled><i class="fas fa-check"></i> Diterima</button>
                                                                    @elseif($sent->status == '2')
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pemilik : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    <button class="btn btn-danger btn-block btn-sm" disabled><i class="fas fa-times"></i> Ditolak</button>
                                                                    @elseif($sent->status == '3')
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pemilik : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    <button class="btn btn-success btn-block btn-sm" disabled><i class="fas fa-paw"></i> Pemilik {{ $sent->animalsname }}</button>
                                                                    @elseif($sent->status == "4")
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pemilik : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    <button class="btn stylish-color-dark btn-block mb-2 btn-sm" disabled><i class="fas fa-exclamation"></i> Teradopsi oleh orang lain <i class="fas fa-exclamation"></i></button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">Tidak ada permohonan yang dikirim.</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container tab-pane fade animate__animated animate__fadeIn" id="sentpending">
                                            <div class="container">
                                                <div class="card-body">
                                                    <div class="row justify-content-center mt-1">
                                                        @if(count($applicationsentpending) > 0)
                                                        @foreach($applicationsentpending as $sent)
                                                        <div class="col-md-4">
                                                            <div class="card mb-3" style="border-radius:15px">
                                                                <div class="card-body">
                                                                    <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#detailSentPending{{ $sent->id }}">Permohonan {{ $sent->animalsname }}</h5>
                                                                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#detailSentPending{{ $sent->id }}">
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pemilik : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    <button class="btn stylish-color-dark btn-block btn-sm" disabled><i class="fas fa-clock"></i> Pending</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">Tidak ada permohonan keluar yang pending.</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container tab-pane fade animate__animated animate__fadeIn" id="sentaccepted">
                                            <div class="container">
                                                <div class="card-body">
                                                    <div class="row justify-content-center mt-1">
                                                        @if(count($applicationsentaccepted) > 0)
                                                        @foreach($applicationsentaccepted as $sent)
                                                        <div class="col-md-4">
                                                            <div class="card mb-3" style="border-radius:15px">
                                                                <div class="card-body">
                                                                    <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#detailSendAccepted{{ $sent->id }}">Permohonan {{ $sent->animalsname }}</h5>
                                                                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#detailSendAccepted{{ $sent->id }}">
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pemilik : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    @if($sent->status == '1')
                                                                    <button class="btn btn-info btn-block btn-sm" disabled><i class="fas fa-check"></i> Diterima</button>
                                                                    @elseif($sent->status == '3')
                                                                    <button class="btn btn-success btn-block btn-sm" disabled><i class="fas fa-paw"></i> Pemilik {{ $sent->animalsname }}</button>
                                                                    @elseif($sent->status == "4")
                                                                    <button class="btn stylish-color-dark btn-block mb-2 btn-sm" disabled><i class="fas fa-exclamation"></i> Teradopsi oleh orang lain <i class="fas fa-exclamation"></i></button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">Tidak ada permohonan keluar yang diterima.</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container tab-pane fade animate__animated animate__fadeIn" id="sentrejected">
                                            <div class="container">
                                                <div class="card-body">
                                                    <div class="row justify-content-center mt-1">
                                                        @if(count($applicationsentrejected) > 0)
                                                        @foreach($applicationsentrejected as $sent)
                                                        <div class="col-md-4">
                                                            <div class="card mb-3" style="border-radius:15px">
                                                                <div class="card-body">
                                                                    <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#detailSendReject{{ $sent->id }}">Permohonan {{ $sent->animalsname }}</h5>
                                                                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#detailSendReject{{ $sent->id }}">
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pemilik : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    <button class="btn btn-danger btn-block" disabled><i class="fas fa-times"></i> Ditolak</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">Tidak ada permohonan keluar yang ditolak.</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tab content -->
                            </div>
                            <!-- End Tab application sent -->
                        </div>
                        <!-- End tab panes -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="text-center">
    @foreach($postings as $posting)
    <!-- Detail All Posts -->
    <div class="modal fade" id="modalDetailPost{{ $posting->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle" style="text-align:center;"><i class="fas fa-paw"></i> Detail {{ $posting->name }} <i class="fas fa-paw"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ url('assets/uploads') }}/{{ $posting->img }}" class="img-fluid mb-3" style="border-radius:15px">
                    <h6 class="card-subtitle mb-2 text-muted">Pemilik : {{ $posting->owner }}<br></h6>
                    <p class="card-text">Umur : {{ $posting->age }} year(s)</p>
                    <p class="card-text">Kategori : {{ $posting->category }}</p>
                    <p class="card-text">Ukuran : {{ $posting->size }}</p>
                    <p class="card-text">Jenis Kelamin : {{ $posting->sex }}</p>
                    <p class="card-text">Latar Belakang : {{ $posting->background }}</p>
                    <p class="card-text">Deskripsi : {{ $posting->description }}</p>
                    <p class="card-text">Catatan Medis : {{ $posting->medical }}</p>
                    <p class="card-text">Tanggal Post : {{ $posting->date }}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block mb-2" disabled><strong><i class="fas fa-check"></i>Status : {{$posting->status}}</strong></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal All Posts -->
    <div class="modal fade" id="deleteModalAll{{$posting->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalAllCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalAllCenterTitle"><i class="fa fa-exclamation-triangle"></i> Perhatian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" method="POST" action="{{ route('posting.delete',$posting->id) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <strong>Apakah anda yakin ingin menghapus post ini ?</strong>
                        <input type="hidden" name="id" value="{{ $posting->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn stylish-color-dark" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($postavail as $posting)
    <!-- Delete Modal Available Posts -->
    <div class="modal fade" id="deleteModalAvailable{{$posting->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalAvailableCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalAvailableCenterTitle"><i class="fa fa-exclamation-triangle"></i> Perhatian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" method="POST" action="{{ route('posting.delete',$posting->id) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <strong>Apakah anda yakin ingin menghapus post ini ?</strong>
                        <input type="hidden" name="id" value="{{ $posting->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn stylish-color-dark" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($postadopted as $posting)
    <!-- Modal Detail Adopted Posts -->
    <div class="modal fade" id="modalDetailPostAccepted{{ $posting->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-paw" style="text-align:center;"></i> {{ $posting->name }} <i class="fas fa-paw"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ url('assets/uploads') }}/{{ $posting->img }}" class="img-fluid mb-3" style="border-radius:15px">
                    <h6 class="card-subtitle mb-2 text-muted">Pemilik : {{ $posting->owner }}<br></h6>
                    <p class="card-text">Umur : {{ $posting->age }} year(s)</p>
                    <p class="card-text">Kategori : {{ $posting->category }}</p>
                    <p class="card-text">Ukuran : {{ $posting->size }}</p>
                    <p class="card-text">Jenis Kelamin : {{ $posting->sex }}</p>
                    <p class="card-text">Latar Belakang : {{ $posting->background }}</p>
                    <p class="card-text">Deskripsi : {{ $posting->description }}</p>
                    <p class="card-text">Catatan Medis : {{ $posting->medical }}</p>
                    <p class="card-text">Tanggal Post : {{ $posting->date }}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block mb-2" disabled><strong><i class="fas fa-check"></i>Status : {{$posting->status}}</strong></button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($postrip as $posting)
    <!-- Delete Modal RIP Posts -->
    <div class="modal fade" id="deleteModalRIP{{$posting->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalRIPCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalRIPCenterTitle"><i class="fa fa-exclamation-triangle"></i> Perhatian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" method="POST" action="{{ route('posting.delete',$posting->id) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <strong>Apakah anda yakin ingin menghapus post ini ?</strong>
                        <input type="hidden" name="id" value="{{ $posting->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn stylish-color-dark" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($applicationreceived as $received)
    <!-- Modal All Received  -->
    <div class="modal fade" id="modalDetailAll{{ $received->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Permohonan : {{ $received->animalsname }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pengirim : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                    <p class="card-text">Alasan : {{ $received->reason }}</p>
                    <p class="card-text">Hewan lain : {{ $received->otheranimals }}</p>
                    <p class="card-text">Izin : {{ $received->permissions }}</p>
                </div>
                <div class="modal-footer">
                    <a href="whatsapp://send?text=Hello&phone=+62{{ $received->phone }}" class="btn btn-success btn-block"><i class="fa fa-phone"></i> Whatsapp Pemohon</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($applicationreceivedpending as $received)
    <!-- Modal Pending Received -->
    <div class="modal fade" id="modalDetailPending{{ $received->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Permohonan : {{ $received->animalsname }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pengirim : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                    <p class="card-text">Alasan : {{ $received->reason }}</p>
                    <p class="card-text">Hewan lain : {{ $received->otheranimals }}</p>
                    <p class="card-text">Izin : {{ $received->permissions }}</p>
                </div>
                <div class="modal-footer">
                    <a href="whatsapp://send?text=Hello&phone=+62{{ $received->phone }}" class="btn btn-success btn-block"><i class="fa fa-phone"></i> Whatsapp Pemohon</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($applicationreceivedaccept as $received)
    <!-- Modal Accepted Received -->
    <div class="modal fade" id="modalDetailAccepted{{ $received->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Permohonan : {{ $received->animalsname }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pengirim : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                    <p class="card-text">Alasan : {{ $received->reason }}</p>
                    <p class="card-text">Hewan lain : {{ $received->otheranimals }}</p>
                    <p class="card-text">Izin : {{ $received->permissions }}</p>
                </div>
                <div class="modal-footer">
                    <a href="whatsapp://send?text=Hello&phone=+62{{ $received->phone }}" class="btn btn-success btn-block"><i class="fa fa-phone"></i> Whatsapp Pemohon</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($applicationreceivedreject as $received)
    <!-- Modal Rejected Received -->
    <div class="modal fade" id="modalDetailRejected{{ $received->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Permohonan : {{ $received->animalsname }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pengirim : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                    <p class="card-text">Alasan : {{ $received->reason }}</p>
                    <p class="card-text">Hewan lain : {{ $received->otheranimals }}</p>
                    <p class="card-text">Izin : {{ $received->permissions }}</p>
                </div>
                <div class="modal-footer">
                    <a href="whatsapp://send?text=Hello&phone=+62{{ $received->phone }}" class="btn btn-success btn-block"><i class="fa fa-phone"></i> Whatsapp Pemohon</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($applicationsent as $sent)
    <!-- Modal Sent All -->
    <div class="modal fade" id="detailSentAll{{ $sent->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Permohonan : {{ $sent->animalsname }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pemilik : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                    <p class="card-text">Alasan : {{ $sent->reason }}</p>
                    <p class="card-text">Hewan lain : {{ $sent->otheranimals }}</p>
                    <p class="card-text">Izin : {{ $sent->permissions }}</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('details') }}/{{ $sent->id_post }}" class="btn btn-info btn-block"><i class="fas fa-paw"></i> Detail</a>
                    <a href="whatsapp://send?text=Hello&phone=+62{{ $sent->handphone }}" class="btn btn-success btn-block"><i class="fa fa-phone"></i> Whatsapp Pemilik</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($applicationsentpending as $sent)
    <!-- Modal Sent Pending -->
    <div class="modal fade" id="detailSentPending{{ $sent->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Permohonan : {{ $sent->animalsname }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pemilik : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                    <p class="card-text">Alasan : {{ $sent->reason }}</p>
                    <p class="card-text">Hewan lain : {{ $sent->otheranimals }}</p>
                    <p class="card-text">Izin : {{ $sent->permissions }}</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('details') }}/{{ $sent->id_post }}" class="btn btn-info btn-block"><i class="fas fa-paw"></i> Detail</a>
                    <a href="whatsapp://send?text=Hello&phone=+62{{ $sent->handphone }}" class="btn btn-success btn-block"><i class="fa fa-phone"></i> Whatsapp Pemilik</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($applicationsentaccepted as $sent)
    <!-- Modal Sent Accepted -->
    <div class="modal fade" id="detailSendAccepted{{ $sent->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Permohonan : {{ $sent->animalsname }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pemilik : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                    <p class="card-text">Alasan : {{ $sent->reason }}</p>
                    <p class="card-text">Hewan lain : {{ $sent->otheranimals }}</p>
                    <p class="card-text">Izin : {{ $sent->permissions }}</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('details') }}/{{ $sent->id_post }}" class="btn btn-info btn-block"><i class="fas fa-paw"></i> Detail</a>
                    <a href="whatsapp://send?text=Hello&phone=+62{{ $sent->handphone }}" class="btn btn-success btn-block"><i class="fa fa-phone"></i> Whatsapp Pemilik</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($applicationsentrejected as $sent)
    <!-- Modal Sent Rejected -->
    <div class="modal fade" id="detailSendReject{{ $sent->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Permohonan : {{ $sent->animalsname }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Pemilik : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                    <p class="card-text">Alasan : {{ $sent->reason }}</p>
                    <p class="card-text">Hewan lain : {{ $sent->otheranimals }}</p>
                    <p class="card-text">Izin : {{ $sent->permissions }}</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('details') }}/{{ $sent->id_post }}" class="btn btn-info btn-block"><i class="fas fa-paw"></i> Detail</a>
                    <a href="whatsapp://send?text=Hello&phone=+62{{ $sent->handphone }}" class="btn btn-success btn-block"><i class="fa fa-phone"></i> Whatsapp Pemilik</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection