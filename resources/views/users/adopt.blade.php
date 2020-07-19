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
          <li class="breadcrumb-item active" aria-current="page">Adopsi Hewan</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="panel animate__animated animate__fadeIn">
    <div class="card" id="bg-apis">
      <div class="card-body" style="background:#f9f9f9">
        <!-- Form Filter -->
        <form method="POST" action="{{ route('filterpost') }}" id="filter">
          @csrf
          <div class="row justify-content-center">
            <div class="col-md-12 mb-3">
              <div class="input-group">
                <div class="input-group-text">
                  <span class="fas fa-search"></span>
                </div>
                <input class="form-control" type="text" placeholder="Cari nama hewan ..." aria-label="Search" id="name" name="name">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 mb-2">
              <select name="province" class="form-control" id="province">
                <option selected="false">Pilih Provinsi...</option>
                @foreach($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4 mb-2">
              <select name="city" class="form-control" id="city">
                <option selected="false">Pilih Kota...</option>
                @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4 mb-2">
              <select name="category" class="form-control">
                <option selected="false">Pilih Kategori...</option>
                @foreach(App\PostCategory::all() as $category)
                <option value="{{ $category->option }}"> {{ $category->option }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-md-12 text-center">
              <input type="checkbox" class="hidden" name="availablecheckbox" id="availablecheckbox" value="1">
              <label for="availablecheckbox">Hanya tampilkan hewan yang dapat diadopsi</label>
            </div>
          </div>

          <div class="text-center mt-2">
            <button class="btn btn-info shadow-lg" type="submit" name="search">Cari <i class="fa fa-search"></i></button>
          </div>
        </form>
        <!-- Form Filter End -->
      </div>
    </div>
  </div>
  @if(count($postings) > 0)
  <div class="col-md-12 mb-3 animate__animated animate__fadeIn">
    <div class="carousel">
      <div id="carouselExampleCaptions" class="carousel slide mt-2" data-ride="carousel">
        <ol class="carousel-indicators">
          @foreach($postings as $posting)
          <li data-target="#carouselExampleCaptions" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
          @endforeach
        </ol>

        <div class="carousel-inner">
          @foreach($postings as $posting)
          <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <a href="{{ route('details',$posting->id) }}">
              <img src="{{ url('assets/uploads') }}/{{ $posting->img }}" class="img-fluid" style="border-radius: 15px;">
            </a>
            <div class="carousel-caption d-none d-md-block">
              <h5>{{ $posting->name }}</h5>
              <p>{{ $posting->location }}</p>
            </div>
          </div>
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  @endif

  <div class="card pr-5 pl-5 pt-3 pb-2 mb-3" style="background:#f9f9f9">
    <div class="row justify-content-center animate__animated animate__backInUp">
      {{ $postings->links() }}
    </div>
    <div class="row justify-content-center mt-2">
      @if(count($postings) > 0)
      @foreach($postings as $posting)
      <div class="col-md-4">
        <div class="mb-4">
          <img src="{{ url('assets/uploads') }}/{{ $posting->img }}" class="img-fluid animate__animated animate__backInUp" style="border-top-left-radius:15px; border-top-right-radius:15px">
          <div class="card-body animate__animated animate__backInUp" style="background:#f1f1f6; border-bottom-left-radius:15px; border-bottom-right-radius:15px;">
            <h5 class="card-subtitle" style="text-align:center;">{{ $posting->name }}</h5>
            <div class="location">{{ $posting->location }}</div>
            <h6 class="card-subtitle mb-2 text-muted" style="text-align:center;">Tanggal post : {{ $posting->date }}</h6>
            <p class="card-text" style="text-align:center;">
              <strong>Status : {{ $posting->status }}</strong><br>
              <strong>Umur : {{ $posting->age }} year(s)</strong><br>
              <strong>Latar belakang : {{ $posting->background }} </strong><br>
              <a href="{{ route('otherprofile',$posting->id_user) }}" class="text-secondary mt-2"><i class="fas fa-user"></i><strong> : {{ $posting->owner}}</strong></a>
            </p>
            <a href="{{ route('details',$posting->id) }}" class="btn btn-info btn-block"><i class="fa fa-paw"></i> Detail</a>
          </div>
        </div>
      </div>
      @endforeach
      @else
      <strong style="text-align: center;">Tidak ada hasil yang sesuai.</strong>
      @endif
    </div>
    <div class="row justify-content-center animate__animated animate__backInUp">
      {{ $postings->links() }}
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