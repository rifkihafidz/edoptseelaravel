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
                    <li class="breadcrumb-item active" aria-current="page">Ubah Post {{ $post->name }}</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-12 mt-1 mb-2">
            <div class="card" style="background:#f9f9f9">
                <div class="card-body postingedit animate__animated animate__zoomIn">
                    <div class="header"><i class="fa fa-pencil-alt"></i> Ubah Post</div>
                    <form method="POST" action="{{ route('posting.update',$post->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <div class="header">{{ $post->name }}</div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="name" class="col-form-label text-md-right">{{ __('Nama') }}</label>
                                            </td>
                                            <td>
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $post->name }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="image" class="col-form-label text-md-right">{{ __('Gambar Hewan') }}</label>
                                            </td>
                                            <td>
                                                <input type="file" id="img" name="img" value="{{ old('img') }}" accept="image/*" class="form-control-file @error('img') is-invalid @enderror">
                                                @error('img')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="age" class="col-form-label text-md-right">{{ __('Umur') }}</label>
                                            </td>
                                            <td>
                                                <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ $post->age }}" required autocomplete="age" autofocus>

                                                @error('age')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="background" class="col-form-label text-md-right">{{ __('Latar Belakang') }}</label>
                                            </td>
                                            <td>
                                                <select name="background" class="form-control">
                                                    @foreach(App\Postbackground::all() as $background)
                                                    <option value="{{ $background->option }}" @if ($background->option === $post->background)
                                                        selected
                                                        @endif
                                                        >
                                                        {{ $background->option }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="category" class="col-form-label text-md-right">{{ __('Kategori') }}</label>
                                            </td>
                                            <td>
                                                <select name="category" class="form-control">
                                                    @foreach(App\Postcategory::all() as $category)
                                                    <option value="{{ $category->option }}" @if ($category->option === $post->category)
                                                        selected
                                                        @endif
                                                        >
                                                        {{ $category->option }}
                                                        @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="description" class="col-form-label text-md-right">{{ __('Deskripsi') }}</label>
                                            </td>
                                            <td>
                                                <textarea style="text-align: justify;" class="form-control" name="description" rows="3" required placeholder="Description">{{ $post->description }}</textarea>

                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="medical" class="col-form-label text-md-left">{{ __('Catatan Medis') }}</label>
                                            </td>
                                            <td>
                                                <textarea style="text-align: justify;" class="form-control" name="medical" rows="3" required placeholder="Medical notes">{{ $post->medical }}</textarea>

                                                @error('medical')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="sex" class="col-form-label text-md-right">{{ __('J. Kelamin') }}</label>
                                            </td>
                                            <td>
                                                <select name="sex" class="form-control">
                                                    @foreach(App\Postsex::all() as $sex)
                                                    <option value="{{ $sex->option }}" @if ($sex->option === $post->sex)
                                                        selected
                                                        @endif
                                                        >
                                                        {{ $sex->option }}
                                                        @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="size" class="col-form-label text-md-right">{{ __('Ukuran') }}</label>
                                            </td>
                                            <td>
                                                <select name="size" class="form-control">
                                                    @foreach(App\Postsize::all() as $size)
                                                    <option value="{{ $size->option }}" @if ($size->option === $post->size)
                                                        selected
                                                        @endif
                                                        >
                                                        {{ $size->option }}
                                                        @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="status" class="col-form-label text-md-right">{{ __('Status') }}</label>
                                            </td>
                                            <td>
                                                <select name="status" class="form-control">
                                                    @foreach(App\Poststatus::all() as $status)
                                                    <option value="{{ $status->option }}" @if ($status->option === $post->status)
                                                        selected
                                                        @endif
                                                        >
                                                        {{ $status->option }}
                                                        @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="friendly" class="col-form-label text-md-right">{{ __('Bersahabat') }}</label>
                                            </td>
                                            <td>
                                                <select name="friendly" class="form-control">
                                                    @if($post->friendly === 0)
                                                    <option value="0" selected>Tidak</option>
                                                    <option value="1">Yes</option>
                                                    @elseif($post->friendly === 1)
                                                    <option value="0">Tidak</option>
                                                    <option value="1" selected>Yes</option>
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="neutered" class="col-form-label text-md-right">{{ __('Sterilisasi') }}</label>
                                            </td>
                                            <td>
                                                <select name="neutered" class="form-control">
                                                    @if($post->neutered === 0)
                                                    <option value="0" selected>Tidak</option>
                                                    <option value="1">Iya</option>
                                                    @elseif($post->neutered === 1)
                                                    <option value="0">Tidak</option>
                                                    <option value="1" selected>Iya</option>
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="vaccinated" class="col-form-label text-md-right">{{ __('Vaksinasi') }}</label>
                                            </td>
                                            <td>
                                                <select name="vaccinated" class="form-control">
                                                    @if($post->vaccinated === 0)
                                                    <option value="0" selected>Tidak</option>
                                                    <option value="1">Iya</option>
                                                    @elseif($post->vaccinated === 1)
                                                    <option value="0">Tidak</option>
                                                    <option value="1" selected>Iya</option>
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 offset">
                                <br>
                                <img src="{{ url('assets/uploads') }}/{{ $post->img }}" class="img-fluid" style="border-radius:15px;">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info btn-block mt-2">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection