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
                    <li class="breadcrumb-item"><a href="{{ route('profile') }}">Profil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah Profil</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="background:#f9f9f9">
                    <h4><i class="fa fa-pencil-alt mb-2"></i> Ubah Profil</h4>
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="animate__animated animate__zoomIn">
                        @csrf

                        <div class="form-group row">
                            <label for="avatar" class="col-md-2 col-form-label text-md-right">{{ __('Avatar') }}</label>

                            <div class="col-md-6 mt-1">
                                <input type="file" id="avatar" name="avatar" value="{{ old('avatar') }}" accept="image/*" class="form-control-file @error('avatar') is-invalid @enderror"> <img src="/assets/uploads/avatars/{{ $user->avatar }}" style="width:75px; height:75px; border-radius:50%;" class="mt-2">
                                @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_hp" class="col-md-2 col-form-label text-md-right">{{ __('No. HP') }}</label>

                            <div class="col-md-6">
                                <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Dimulai dengan (08), co : 08961234" name="no_hp" value="{{ $user->no_hp }}" required autocomplete="no_hp" autofocus>

                                @error('no_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-md-2 col-form-label text-md-right">{{ __('Alamat') }}</label>
                            <div class="col-md-3 mb-2">
                                <select name="province" class="form-control" id="province">
                                    <option selected="false">Pilih Province...</option>
                                    @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="city" class="form-control" id="city">
                                    <option selected="false">Pilih Kota...</option>
                                    @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2"></div>
                            <div class="col-md-6 text-muted" style="font-size:12px;">(Isi kolom password di bawah ini jika anda ingin mengubah password)</div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('Konfirmasi Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-info btn-block">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {
        $("select#province").change(function() {
            var selectedProvince = $("#province option:selected").val();
            var sel = document.getElementById('city')
            for (i = sel.length - 1; i >= 0; i--) {
                sel.remove(i);
            }
            sel.length = 0;

            if (selectedProvince == "Pilih Provinsi...") {
                $.post("{{url('/getAllCities')}}", {
                    "_token": "{{ csrf_token() }}",

                }, function(resp) {
                    var opt = document.createElement('option');
                    opt.selected = 'false';
                    opt.text = 'Pilih Kota...';
                    sel.appendChild(opt);
                    $(resp).each(function() {
                        var opt = document.createElement('option');
                        opt.value = this.id;
                        opt.text = this.name;
                        sel.appendChild(opt);
                    });
                });
            } else {
                $.post("{{url('/getCities')}}", {
                    "_token": "{{ csrf_token() }}",
                    'province': selectedProvince,

                }, function(resp) {
                    $(resp).each(function() {
                        var opt = document.createElement('option');
                        opt.value = this.id;
                        opt.text = this.name;
                        sel.appendChild(opt);
                    });
                });
            }
        });

    });
</script>

@endsection