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
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                                <i class="fa fa-pencil-alt"></i> Edit Profile
                            </a>
                        </div>
                        <table class="table table-responsive-sm">
                            <tbody class="tbody">
                                <tr>
                                    <td class="tdprofile">Name</td>
                                    <td class="tdprofile" width="3">:</td>
                                    <td class="tdprofile">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="tdprofile">E-mail</td>
                                    <td class="tdprofile" width="3">:</td>
                                    <td class="tdprofile">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="tdprofile">Phone</td>
                                    <td class="tdprofile" width="3">:</td>
                                    <td class="tdprofile">{{ $user->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td class="tdprofile">Address</td>
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
                                <a class="nav-link active" data-toggle="tab" href="#myposts">My Posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#appreceived">Application Received</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#appsent">Application Sent</a>
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
                                            <a class="nav-link active" data-toggle="tab" href="#allposts"><i class="fa fa-list"></i> All</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#availableposts"><i class="fa fa-check"></i> Available</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#adoptedposts"><i class="fa fa-paw"></i> Adopted</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#ripposts"><i class="fa fa-skull-crossbones"></i> R.I.P</a>
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
                                                                        <h6 class="card-subtitle mb-2 text-muted">Posted on : {{ $posting->date }}</h6>
                                                                        <p class="card-text" style="text-align: center;">
                                                                            <strong>Status : {{ $posting->status }}</strong><br>
                                                                            <strong>Age : {{ $posting->age }} year(s)</strong><br>
                                                                            <strong>Background : {{ $posting->background }} </strong><br>
                                                                        </p>
                                                                        @if($posting->status != 'Available' && $posting->status != 'R.I.P' && $posting->status != 'Adopted')
                                                                        <h6 class="card-subtitle mb-2" style="text-align:center;"><strong>Adopted on : {{ $adopt->adoptdate }}</strong></h6>
                                                                        @endif
                                                                        @if($posting->status == 'Available' || $posting->status == 'Adopted' || $posting->status == 'R.I.P')
                                                                        <a href="{{ route('posting.edit',$posting->id) }}" class="btn btn-info btn-block btn-sm"><i class="fa fa-pencil-alt"></i> Edit</a>
                                                                        <div class="modal fade" id="deleteModalAll{{$posting->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalAllCenterTitle" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="deleteModalAllCenterTitle"><i class="fa fa-exclamation-triangle"></i> Alert</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form id="deleteForm" method="POST" action="{{ route('posting.delete',$posting->id) }}">
                                                                                            @csrf
                                                                                            {{ method_field('DELETE') }}
                                                                                            <strong>Are you sure you want to delete this post?</strong>
                                                                                            <input type="hidden" name="id" value="{{ $posting->id }}">
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn stylish-color-dark" data-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <button type="button" class="btn btn-danger btn-block btn-sm mt-2 btn-trash" data-toggle="modal" data-target="#deleteModalAll{{$posting->id}}" data-id={{ $posting->id }}><i class="fa fa-trash"></i> Delete</button>
                                                                        </form>
                                                                        @else
                                                                        <button type="button" class="btn btn-info btn-block btn-sm mt-3" data-toggle="modal" data-target="#modalDetailPost{{ $posting->id }}"><i class="fa fa-paw"></i> Details</button>
                                                                        <div class="modal fade" id="modalDetailPost{{ $posting->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalCenterTitle" style="text-align:center;"><i class="fas fa-paw"></i> {{ $posting->name }}'s details <i class="fas fa-paw"></i></h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <img src="{{ url('assets/uploads') }}/{{ $posting->img }}" class="img-fluid mb-3" style="border-radius:15px">
                                                                                        <h6 class="card-subtitle mb-2 text-muted">Owner : {{ $posting->owner }}<br></h6>
                                                                                        <p class="card-text">Age : {{ $posting->age }} year(s)</p>
                                                                                        <p class="card-text">Category : {{ $posting->category }}</p>
                                                                                        <p class="card-text">Size : {{ $posting->size }}</p>
                                                                                        <p class="card-text">Sex : {{ $posting->sex }}</p>
                                                                                        <p class="card-text">Background : {{ $posting->background }}</p>
                                                                                        <p class="card-text">Description : {{ $posting->description }}</p>
                                                                                        <p class="card-text">Medical notes : {{ $posting->medical }}</p>
                                                                                        <p class="card-text">Post Date : {{ $posting->date }}</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button class="btn btn-success btn-block mb-2 btn-sm" disabled><strong><i class="fas fa-check"></i>Status : {{$posting->status}}</strong></button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">You have never made any posts yet</strong>
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
                                                                <div class=" card-body" style="background:#f1f1f6; border-bottom-left-radius:15px; border-bottom-right-radius:15px;">
                                                                    <h5 class="card-subtitle" style="text-align:center;">{{ $posting->name }}</h5>
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Posted on : {{ $posting->date }}</h6>
                                                                    <p class="card-text" style="text-align: center;">
                                                                        <strong>Status : {{ $posting->status }}</strong><br>
                                                                        <strong>Age : {{ $posting->age }} year(s)</strong><br>
                                                                        <strong>Background : {{ $posting->background }} </strong><br>
                                                                    </p>
                                                                    <a href="{{ route('posting.edit',$posting->id) }}" class="btn btn-info btn-block btn-sm"><i class="fa fa-pencil-alt"></i> Edit</a>
                                                                    <div class="modal fade" id="deleteModalAvailable{{$posting->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalAvailableCenterTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="deleteModalAvailableCenterTitle"><i class="fa fa-exclamation-triangle"></i> Alert</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form id="deleteForm" method="POST" action="{{ route('posting.delete',$posting->id) }}">
                                                                                        @csrf
                                                                                        {{ method_field('DELETE') }}
                                                                                        <strong>Are you sure you want to delete this post?</strong>
                                                                                        <input type="hidden" name="id" value="{{ $posting->id }}">
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn stylish-color-dark btn-sm" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-danger btn-delete btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="btn btn-danger btn-block btn-sm mt-2 btn-trash" data-toggle="modal" data-target="#deleteModalAvailable{{$posting->id}}" data-id={{ $posting->id }}><i class="fa fa-trash"></i> Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">No animal posted available.</strong>
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
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Posted on : {{ $posting->date }}</h6>
                                                                    <p class="card-text" style="text-align: center;">
                                                                        <strong>Status : {{ $posting->status }}</strong><br>
                                                                        <strong>Age : {{ $posting->age }} year(s)</strong><br>
                                                                        <strong>Background : {{ $posting->background }} </strong><br>
                                                                    </p>
                                                                    @if($posting->status != 'Available' && $posting->status != 'R.I.P' && $posting->status != 'Adopted')
                                                                    <h6 class="card-subtitle mb-2" style="text-align:center;"><strong>Adopted on : {{ $adopt->adoptdate }}</strong></h6>
                                                                    @endif
                                                                    @if($posting->status == 'Adopted')
                                                                    <a href="{{ route('posting.edit',$posting->id) }}" class="btn btn-info btn-block btn-sm"><i class="fa fa-pencil-alt"></i> Edit</a>
                                                                    <div class="modal fade" id="deleteModalAdopted{{$posting->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalAdoptedCenterTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="deleteModalAdoptedCenterTitle"><i class="fa fa-exclamation-triangle"></i> Alert</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form id="deleteForm" method="POST" action="{{ route('posting.delete',$posting->id) }}">
                                                                                        @csrf
                                                                                        {{ method_field('DELETE') }}
                                                                                        <strong>Are you sure you want to delete this post?</strong>
                                                                                        <input type="hidden" name="id" value="{{ $posting->id }}">
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn stylish-color-dark btn-sm" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-danger btn-delete btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="btn btn-danger btn-block btn-sm mt-2 btn-trash" data-toggle="modal" data-target="#deleteModalAdopted{{$posting->id}}" data-id={{ $posting->id }}><i class="fa fa-trash"></i> Delete</button>
                                                                    </form>
                                                                    @else
                                                                    <button type="button" class="btn btn-info btn-sm btn-block mt-3" data-toggle="modal" data-target="#modalDetailPostAccepted{{ $posting->id }}"><i class="fa fa-paw"></i> Details</button>
                                                                    <div class="modal fade" id="modalDetailPostAccepted{{ $posting->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-paw" style="text-align:center;"></i> {{ $posting->name }}'s details <i class="fas fa-paw"></i></h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <img src="{{ url('assets/uploads') }}/{{ $posting->img }}" class="img-fluid mb-3" style="border-radius:15px">
                                                                                    <h6 class="card-subtitle mb-2 text-muted">Owner : {{ $posting->owner }}<br></h6>
                                                                                    <p class="card-text">Age : {{ $posting->age }} year(s)</p>
                                                                                    <p class="card-text">Category : {{ $posting->category }}</p>
                                                                                    <p class="card-text">Size : {{ $posting->size }}</p>
                                                                                    <p class="card-text">Sex : {{ $posting->sex }}</p>
                                                                                    <p class="card-text">Background : {{ $posting->background }}</p>
                                                                                    <p class="card-text">Description : {{ $posting->description }}</p>
                                                                                    <p class="card-text">Medical notes : {{ $posting->medical }}</p>
                                                                                    <p class="card-text">Post Date : {{ $posting->date }}</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button class="btn btn-success btn-block mb-2 btn-sm" disabled><strong><i class="fas fa-check"></i>Status : {{$posting->status}}</strong></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">No animal posted has been adopted yet.</strong>
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
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Posted on : {{ $posting->date }}</h6>
                                                                    <p class="card-text" style="text-align: center;">
                                                                        <strong>Status : {{ $posting->status }}</strong><br>
                                                                        <strong>Age : {{ $posting->age }} year(s)</strong><br>
                                                                        <strong>Background : {{ $posting->background }} </strong><br>
                                                                    </p>
                                                                    <a href="{{ route('posting.edit',$posting->id) }}" class="btn btn-info btn-block btn-sm"><i class="fa fa-pencil-alt"></i> Edit</a>
                                                                    <div class="modal fade" id="deleteModalRIP{{$posting->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalRIPCenterTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="deleteModalRIPCenterTitle"><i class="fa fa-exclamation-triangle"></i> Alert</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form id="deleteForm" method="POST" action="{{ route('posting.delete',$posting->id) }}">
                                                                                        @csrf
                                                                                        {{ method_field('DELETE') }}
                                                                                        <strong>Are you sure you want to delete this post?</strong>
                                                                                        <input type="hidden" name="id" value="{{ $posting->id }}">
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn stylish-color-dark btn-sm" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-danger btn-delete btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="btn btn-danger btn-block mt-2 btn-trash btn-sm" data-toggle="modal" data-target="#deleteModalRIP{{$posting->id}}" data-id={{ $posting->id }}><i class="fa fa-trash"></i> Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">No animal posted has been dead yet.</strong>
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
                                            <a class="nav-link active" data-toggle="tab" href="#receiveall"><i class="fa fa-list"></i> All</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#receivepending"><i class="fa fa-clock"></i> Pending
                                                @if(!empty($notifreceivedpending)) <span class="badge badge-danger pb-1">{{ $notifreceivedpending }}</span> @endif</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#receiveaccepted"><i class="fa fa-check"></i> Accepted</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#receiverejected"><i class="fa fa-ban"></i> Rejected</a>
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
                                                                            <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#modalDetailAll{{ $received->id }}">Application for {{ $received->animalsname }}</h5>
                                                                            <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#modalDetailAll{{ $received->id }}">
                                                                            <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Sumbitter : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                                                                            @if($received->status == "0")
                                                                            <form action="{{ route('accept.application') }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="id" value="{{ $received->id }}">
                                                                                <button onclick="return confirm('Are you sure you want to accept this appliance ?')" type="submit" class="btn btn-info btn-block mb-2 btn-sm">Accept</button>
                                                                            </form>
                                                                            <form action="{{ route('reject.application') }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="id" value="{{ $received->id }}">
                                                                                <button onclick="return confirm('Are you sure you want to reject this appliance ?')" type="submit" class="btn btn-danger btn-block btn-sm">Reject</button>
                                                                            </form>
                                                                            @elseif($received->status == "1")
                                                                            <button class="btn btn-info btn-block mb-2 btn-sm" disabled><i class="fas fa-check"></i> Accepted</button>
                                                                            <form action="{{ route('set.adopter') }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="idapply" value="{{ $received->id }}">
                                                                                <input type="hidden" name="idpost" value="{{ $received->id_post }}">
                                                                                <button onclick="return confirm('Are you sure you want to set {{ $received->submittername }} as a {{ $received->animalsname }} adopter ?')" type="submit" class="btn btn-info btn-block btn-sm">Set Adopt</button>
                                                                            </form>
                                                                            @elseif($received->status == "2")
                                                                            <button class="btn btn-danger btn-block btn-sm" disabled><i class="fas fa-times"></i> Rejected</button>
                                                                            @elseif($received->status == "3")
                                                                            <button class="btn btn-success btn-block mb-2 btn-sm" disabled><i class="fas fa-check"></i> {{$received->animalsname}}'s Adopter</button>
                                                                            @elseif($received->status == "4")
                                                                            <button class="btn stylish-color-dark btn-block mb-2 btn-sm" disabled><i class="fas fa-exclamation"></i> Adopted by others <i class="fas fa-exclamation"></i></button>
                                                                            @endif
                                                                            <div class="modal fade" id="modalDetailAll{{ $received->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Application for : {{ $received->animalsname }}</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                                                                                            <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Sumbitter : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                                                                                            <p class="card-text">Reason : {{ $received->reason }}</p>
                                                                                            <p class="card-text">Other Animals : {{ $received->otheranimals }}</p>
                                                                                            <p class="card-text">Permissions : {{ $received->permissions }}</p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <a href="whatsapp://send?text=Hello&phone=+62{{ $received->phone }}" class="btn btn-success btn-block btn-sm"><i class="fa fa-phone"></i> Whatsapp Submitter</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">No posts have received submitation yet.</strong>
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
                                                                    <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#modalDetailPending{{ $received->id }}">Application for {{ $received->animalsname }}</h5>
                                                                    <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#modalDetailPending{{ $received->id }}">
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Sumbitter : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                                                                    <form action="{{ route('accept.application') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{ $received->id }}">
                                                                        <button onclick="return confirm('Are you sure you want to accept this appliance ?')" type="submit" class="btn btn-info btn-block btn-sm mb-2">Accept</button>
                                                                    </form>
                                                                    <form action="{{ route('reject.application') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{ $received->id }}">
                                                                        <button onclick="return confirm('Are you sure you want to reject this appliance ?')" type="submit" class="btn btn-danger btn-sm btn-block">Reject</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="modalDetailPending{{ $received->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Application for : {{ $received->animalsname }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                                                                        <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Sumbitter : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                                                                        <p class="card-text">Reason : {{ $received->reason }}</p>
                                                                        <p class="card-text">Other Animals : {{ $received->otheranimals }}</p>
                                                                        <p class="card-text">Permissions : {{ $received->permissions }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="whatsapp://send?text=Hello&phone=+62{{ $received->phone }}" class="btn btn-success btn-block btn-sm"><i class="fa fa-phone"></i> Whatsapp Submitter</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">No submitation has been received yet.</strong>
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
                                                                        <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#modalDetailAccepted{{ $received->id }}">Application for {{ $received->animalsname }}</h5>
                                                                        <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#modalDetailAccepted{{ $received->id }}">
                                                                        <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Sumbitter : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                                                                        @if($received->status == '1')
                                                                        <button class="btn btn-info btn-block btn-sm mb-2" disabled><i class="fas fa-check"></i> Accepted</button>
                                                                        <form action="{{ route('set.adopter') }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="idapply" value="{{ $received->id }}">
                                                                            <input type="hidden" name="idpost" value="{{ $received->id_post }}">
                                                                            <button onclick="return confirm('Are you sure you want to accept this appliance ?')" type="submit" class="btn btn-info btn-block btn-sm">Set Adopt</button>
                                                                        </form>
                                                                        @elseif($received->status == '3')
                                                                        <button class="btn btn-success btn-block btn-sm" disabled><i class="fas fa-check"></i> {{ $received->animalsname }}'s Adopter</button>
                                                                        @elseif($received->status == "4")
                                                                        <button class="btn stylish-color-dark btn-block mb-2 btn-sm" disabled><i class="fas fa-exclamation"></i> Adopted by others <i class="fas fa-exclamation"></i></button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="modalDetailAccepted{{ $received->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Application for : {{ $received->animalsname }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                                                                        <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Sumbitter : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                                                                        <p class="card-text">Reason : {{ $received->reason }}</p>
                                                                        <p class="card-text">Other Animals : {{ $received->otheranimals }}</p>
                                                                        <p class="card-text">Permissions : {{ $received->permissions }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="whatsapp://send?text=Hello&phone=+62{{ $received->phone }}" class="btn btn-success btn-block btn-sm"><i class="fa fa-phone"></i> Whatsapp Submitter</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">No submitation has been accepted yet.</strong>
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
                                                                    <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#modalDetailRejected{{ $received->id }}">Application for {{ $received->animalsname }}</h5>
                                                                    <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#modalDetailRejected{{ $received->id }}">
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Sumbitter : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                                                                    <button class="btn btn-danger btn-block btn-sm" disabled><i class="fas fa-times"></i> Rejected</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="modalDetailRejected{{ $received->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Application for : {{ $received->animalsname }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img src="{{ url('assets/uploads') }}/{{ $received->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                                                                        <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Sumbitter : <a href="{{ route('otherprofile',$received->id_user) }}" style="text-decoration: none;">{{ $received->submittername }}</a><br>{{ $received->location }}</h6>
                                                                        <p class="card-text">Reason : {{ $received->reason }}</p>
                                                                        <p class="card-text">Other Animals : {{ $received->otheranimals }}</p>
                                                                        <p class="card-text">Permissions : {{ $received->permissions }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="whatsapp://send?text=Hello&phone=+62{{ $received->phone }}" class="btn btn-success btn-block btn-sm"><i class="fa fa-phone"></i> Whatsapp Submitter</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">No submitation has been rejected yet.</strong>
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
                                            <a class="nav-link active" data-toggle="tab" href="#sentall"><i class="fa fa-list"></i> All</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#sentpending"><i class="fa fa-clock"></i> Pending</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#sentaccepted"><i class="fa fa-check"></i> Accepted</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#sentrejected"><i class="fa fa-ban"></i> Rejected</a>
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
                                                                    <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#detailSentAll{{ $sent->id }}">Application for {{ $sent->animalsname }}</h5>
                                                                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#detailSentAll{{ $sent->id }}">
                                                                    @if($sent->status == '0')
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Owner : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a> <br>{{ $sent->location }}</h6>
                                                                    <button class="btn stylish-color-dark btn-block btn-sm" disabled><i class="fas fa-clock"></i> Pending</button>
                                                                    @elseif($sent->status == '1')
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Owner : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    <button class="btn btn-info btn-block btn-sm" disabled><i class="fas fa-check"></i> Accepted</button>
                                                                    @elseif($sent->status == '2')
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Owner : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    <button class="btn btn-danger btn-block btn-sm" disabled><i class="fas fa-times"></i> Rejected</button>
                                                                    @elseif($sent->status == '3')
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Owner : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    <button class="btn btn-success btn-block btn-sm" disabled><i class="fas fa-paw"></i> Owner of {{ $sent->animalsname }}</button>
                                                                    @elseif($sent->status == "4")
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Owner : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    <button class="btn stylish-color-dark btn-block mb-2 btn-sm" disabled><i class="fas fa-exclamation"></i> Adopted by others <i class="fas fa-exclamation"></i></button>
                                                                    @endif
                                                                    <div class="modal fade" id="detailSentAll{{ $sent->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Application for : {{ $sent->animalsname }}</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Owner : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                                    <p class="card-text">Reason : {{ $sent->reason }}</p>
                                                                                    <p class="card-text">Other Animals : {{ $sent->otheranimals }}</p>
                                                                                    <p class="card-text">Permissions : {{ $sent->permissions }}</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a href="{{ url('details') }}/{{ $sent->id_post }}" class="btn btn-info btn-block"><i class="fas fa-paw"></i> Details</a>
                                                                                    <a href="whatsapp://send?text=Hello&phone=+62{{ $sent->handphone }}" class="btn btn-success btn-block btn-sm"><i class="fa fa-phone"></i> Whatsapp Owner</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">No submitation has been sent yet.</strong>
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
                                                                    <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#detailSentPending{{ $sent->id }}">Application for {{ $sent->animalsname }}</h5>
                                                                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#detailSentPending{{ $sent->id }}">
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Owner : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    <button class="btn stylish-color-dark btn-block btn-sm" disabled><i class="fas fa-clock"></i> Pending</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="detailSentPending{{ $sent->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Application for : {{ $sent->animalsname }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                                                                        <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Owner : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                        <p class="card-text">Reason : {{ $sent->reason }}</p>
                                                                        <p class="card-text">Other Animals : {{ $sent->otheranimals }}</p>
                                                                        <p class="card-text">Permissions : {{ $sent->permissions }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="{{ url('details') }}/{{ $sent->id_post }}" class="btn btn-info btn-block btn-sm"><i class="fas fa-paw"></i> Details</a>
                                                                        <a href="whatsapp://send?text=Hello&phone=+62{{ $sent->handphone }}" class="btn btn-success btn-block btn-sm"><i class="fa fa-phone"></i> Whatsapp Owner</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">No submitation has been sent yet.</strong>
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
                                                                    <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#detailSendAccepted{{ $sent->id }}">Application for {{ $sent->animalsname }}</h5>
                                                                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#detailSendAccepted{{ $sent->id }}">
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Owner : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    @if($sent->status == '1')
                                                                    <button class="btn btn-info btn-block btn-sm" disabled><i class="fas fa-check"></i> Accepted</button>
                                                                    @elseif($sent->status == '3')
                                                                    <button class="btn btn-success btn-block btn-sm" disabled><i class="fas fa-paw"></i> Owner of {{ $sent->animalsname }}</button>
                                                                    @elseif($sent->status == "4")
                                                                    <button class="btn stylish-color-dark btn-block mb-2 btn-sm" disabled><i class="fas fa-exclamation"></i> Adopted by others <i class="fas fa-exclamation"></i></button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="detailSendAccepted{{ $sent->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Application for : {{ $sent->animalsname }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                                                                        <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Owner : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                        <p class="card-text">Reason : {{ $sent->reason }}</p>
                                                                        <p class="card-text">Other Animals : {{ $sent->otheranimals }}</p>
                                                                        <p class="card-text">Permissions : {{ $sent->permissions }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="{{ url('details') }}/{{ $sent->id_post }}" class="btn btn-info btn-block btn-sm"><i class="fas fa-paw"></i> Details</a>
                                                                        <a href="whatsapp://send?text=Hello&phone=+62{{ $sent->handphone }}" class="btn btn-success btn-block btn-sm"><i class="fa fa-phone"></i> Whatsapp Owner</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">No submitation has been accepted yet.</strong>
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
                                                                    <h5 class="card-subtitle" style="text-align:center;" data-toggle="modal" data-target="#detailSendReject{{ $sent->id }}">Application for {{ $sent->animalsname }}</h5>
                                                                    <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px" data-toggle="modal" data-target="#detailSendReject{{ $sent->id }}">
                                                                    <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Owner : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                    <button class="btn btn-danger btn-block" disabled><i class="fas fa-times"></i> Rejected</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="detailSendReject{{ $sent->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Application for : {{ $sent->animalsname }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img src="{{ url('assets/uploads') }}/{{ $sent->gambar }}" class="img-fluid mb-3" style="border-radius:15px">
                                                                        <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Owner : <a href="{{ route('otherprofile',$sent->id_user) }}" style="text-decoration: none;">{{ $sent->owner }}</a><br>{{ $sent->location }}</h6>
                                                                        <p class="card-text">Reason : {{ $sent->reason }}</p>
                                                                        <p class="card-text">Other Animals : {{ $sent->otheranimals }}</p>
                                                                        <p class="card-text">Permissions : {{ $sent->permissions }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="{{ url('details') }}/{{ $sent->id_post }}" class="btn btn-info btn-block"><i class="fas fa-paw"></i> Details</a>
                                                                        <a href="whatsapp://send?text=Hello&phone=+62{{ $sent->handphone }}" class="btn btn-success btn-block btn-sm"><i class="fa fa-phone"></i> Whatsapp Owner</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <strong style="text-align:center;">No submitation has been rejected yet.</strong>
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

@endsection