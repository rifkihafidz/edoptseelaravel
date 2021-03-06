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
          <li class="breadcrumb-item active" aria-current="page">Tambah Hewan</li>
        </ol>
      </nav>
    </div>

    <div class="col-md-12">
      <div class="card" style="background:#f9f9f9">
        <div class="card-body posting animate__animated animate__fadeIn">
          <form method="POST" action="{{ route('posting.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
              <label for="img" class="col-md-2 col-form-label text-md-right">{{ __('Gambar Hewan') }}</label>
              <div class="col-md-6 mt-1">
                <input type="file" id="img" name="img" value="{{ old('img') }}" accept="image/*" required class="form-control-file @error('img') is-invalid @enderror">
                <div class="text-muted" style="font-size:12px;">Min. 128Kb (Direkomendasikan Landscape)</div>
                @error('img')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Nama Hewan') }}</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" required autocomplete="name" autofocus placeholder="Nama Hewan">
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="age" class="col-md-2 col-form-label text-md-right">{{ __('Umur Hewan') }}</label>
              <div class="col-md-6">
                <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" name="age" required placeholder="(Tahun, Perkiraan)" autocomplete="age">
                @error('age')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="category" class="col-md-2 col-form-label text-md-right">{{ __('Kategori') }}</label>
              <div class="col-md-6">
                <select name="category" class="form-control">
                  @foreach(App\PostCategory::all() as $category)
                  <option value="{{ $category->option }}"> {{ $category->option }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="size" class="col-md-2 col-form-label text-md-right">{{ __('Ukuran') }}</label>
              <div class="col-md-6">
                <select name="size" class="form-control">
                  @foreach(App\Postsize::all() as $size)
                  <option value="{{ $size->option }}"> {{ $size->option }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="sex" class="col-md-2 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>
              <div class="col-md-6">
                <select name="sex" class="form-control">
                  @foreach(App\Postsex::all() as $sex)
                  <option value="{{ $sex->option }}"> {{ $sex->option }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="background" class="col-md-2 col-form-label text-md-right">{{ __('Latar Belakang') }}</label>
              <div class="col-md-6">
                <select name="background" class="form-control">
                  @foreach(App\Postbackground::all() as $background)
                  <option value="{{ $background->option }}"> {{ $background->option }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Deskripsi') }}</label>
              <div class="col-md-6">
                <textarea class="form-control" name="description" rows="3" required placeholder="Deskripsi">{{ old('description') }}</textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="medical" class="col-md-2 col-form-label text-md-right">{{ __('Catatan Medis') }}</label>
              <div class="col-md-6">
                <textarea class="form-control" name="medical" rows="3" placeholder="Catatan medis (opsional)"></textarea>

                @error('medical')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="details" class="col-md-2 col-form-label text-md-right">{{ __('Detail Lainnya') }}</label>
              <div class="col-md-6 mt-2">
                <input type="checkbox" name="vaccinated" value="1">
                <label for="vaccinated">Vaksinasi</label><br>
                <input type="checkbox" name="neutered" value="1">
                <label for="neutered">Sterilisasi</label><br>
                <input type="checkbox" name="friendly" value="1">
                <label for="friendly">Bersahabat</label>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2"></div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-info btn-block">
                  {{ __('Iklankan') }}
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