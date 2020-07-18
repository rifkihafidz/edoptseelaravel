@extends('layouts.app')

@section('content')

<!-- My CSS -->
<link href=" {{ URL::asset('css/style.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3 pt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('adopt') }}">Adopsi Hewan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->name }}</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-12 mt-1">
            <div class="card" style="background:#f9f9f9">
                <div class="card-body" style="text-align: justify;">
                    <div class="detailpost">
                        <div class="row  animate__animated animate__fadeIn">
                            <div class="col-md-6 mt-2">
                                <h2>{{ $post->name }}</h2>
                                <div class="table-responsive-sm">
                                    <table class="table justify-content-center">
                                        <tbody>
                                            <tr>
                                                <td>Pemilik</td>
                                                <td><a href="{{ route('otherprofile',$post->id_user) }}" class="text-muted">{{ $post->owner }}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>{{ $post->status }}</td>
                                            </tr>
                                            <tr>
                                                <td>Deskripsi</td>
                                                <td>{{ $post->description }}</td>
                                            </tr>
                                            <tr>
                                                <td>Umur</td>
                                                <td>{{ $post->age }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ukuran</td>
                                                <td>{{ $post->size }}</td>
                                            </tr>
                                            <tr>
                                                <td>J. Kelamin</td>
                                                @if($post->sex == 'Laki-laki')
                                                <td><i class="fas fa-mars fa-lg" style="color:#a6dcef;"></i></td>
                                                @else
                                                <td><i class="fas fa-venus fa-lg" style="color:#e36387;"></i></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Cat. Medis</td>
                                                <td>{{ $post->medical }}</td>
                                            </tr>
                                            <tr>
                                                <td>Latar Belakang</td>
                                                <td>{{ $post->background }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tgl Post</td>
                                                <td>{{ $post->date }}</td>
                                            </tr>
                                            <tr>
                                                <td>Vaksinasi</td>
                                                @if($post->vaccinated == 1)
                                                <td><i class="fas fa-check" style="color:green;"></i></td>
                                                @else
                                                <td><i class="fas fa-times" style="color:red;"></i></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Sterilisasi</td>
                                                @if($post->neutered == 1)
                                                <td><i class="fas fa-check" style="color:green;"></i></td>
                                                @else
                                                <td><i class="fas fa-times" style="color:red;"></i></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Bersahabat</td>
                                                @if($post->friendly == 1)
                                                <td><i class="fas fa-check" style="color:green;"></i></td>
                                                @else
                                                <td><i class="fas fa-times" style="color:red;"></i></td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ url('assets/uploads') }}/{{ $post->img }}" class="img-fluid" style="border-radius: 15px;">
                                @if($post->id_user === $user->id OR $post->status != 'Tersedia')
                                <div class="text-center">
                                    <button class="btn btn-info btn-block mt-3" disabled><i class="fa fa-paw"></i> Kirim Permohonan Adopsi!</button>
                                </div>
                                @else
                                <div class="text-center">
                                    <button type="button" class="btn btn-info btn-block btn-show mt-2" data-toggle="modal" data-target="#applyModal" data-id={{ $post->id }}><i class="fa fa-paw"></i> Kirim Permohonan Adopsi!</button>
                                    <a href="whatsapp://send?text=Hello&phone=+62{{ $owner->phone }}" class="btn btn-success btn-block mt-2"><i class="fa fa-phone"></i> Whatsapp Pemilik</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="text-center col-12">
                            <strong><i class="fa fa-paw"></i>Form Adopsi {{ $post->name }}<i class="fa fa-paw"></i></strong>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('applyform',$post->id) }}" id="applyForm">
                            @csrf
                            <input type="hidden" name="id" id="input-id">
                            <div class="form-group row">
                                <div class="col-md">
                                    <input id="reason" type="text" class="form-control @error('reason') is-invalid @enderror" name="reason" value="{{ old('reason') }}" autocomplete="reason" pattern=".{10,}" title="10 characters minimum" placeholder="Alasan ingin mengadopsi hewan ini?" autofocus required>
                                    @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md">
                                    <input id="otheranimals" type="text" class="form-control @error('otheranimals') is-invalid @enderror" name="otheranimals" placeholder="Ada berapa hewan lain yang anda miliki ? Jelaskan !" pattern=".{10,}" title="10 characters minimum" required>
                                    @error('otheranimals')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md">
                                    <input id="permissions" type="text" class="form-control @error('permissions') is-invalid @enderror" name="permissions" placeholder="Anda sudah mendapat izin dari penghuni rumah ?" pattern=".{10,}" title="10 characters minimum" required>
                                    @error('permissions')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-info btn-block btn-apply" id="btn-show">
                                    {{ __('Kirim Permohonan Adopsi') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    @if(count($errors) > 0)
    $('#applyModal').modal('show');
    @endif
</script>
@endsection