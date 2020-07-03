@extends('layouts.master')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-3 mb-2">
                <div class="card">
                    <div class="card-body" style="background:#f9f9f9">
                        <h4><i class="fa fa-pencil-alt mb-2"></i> Edit Profile</h4>
                        <form method="POST" action="{{ route('admin.user.update',$user->id) }}" enctype="multipart/form-data">
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
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Roles') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ $user->role }}" required autocomplete="role" autofocus>

                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"></div>
                                <div class="col-md-6 text-muted" style="font-size:12px;">(Fill in the password fields below if you want to change your password)</div>
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
                                <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-2">
                                    <button type="submit" class="btn btn-info btn-block">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection