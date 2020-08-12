@extends('layouts.master')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="card mt-2">
        <div class="card-header">
            <h3>Data Posts</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tableposts" class="table table-striped table-bordered text-center" style="width:100%;">
                    <thead class="thead-dark" style="font-size:10px;">
                        <tr>
                            <th>Id</th>
                            <th>Gambar</th>
                            <th class="text-nowrap">Id Pengguna</th>
                            <th>Pemilik</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Kategori</th>
                            <th>Ukuran</th>
                            <th>Kelamin</th>
                            <th>Latar Belakang</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Medis</th>
                            <th>Vaksinasi</th>
                            <th>Sterilisasi</th>
                            <th>Bersahabat</th>
                            <th class="text-nowrap">Tanggal Post</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size:11px;">
                        @foreach($postings as $posting)
                        <tr>
                            <td><strong>{{ $posting->id }}</strong></td>
                            <td><img src="{{ url('assets/uploads') }}/{{ $posting->img }}" class="img-fluid" style="width:100px; height:50px;"></td>
                            <td><strong>{{ $posting->id_user }}</strong></td>
                            <td>{{ $posting->owner }}</td>
                            <td>{{ $posting->name }}</td>
                            <td>{{ $posting->age }}</td>
                            <td>{{ $posting->category }}</td>
                            <td>{{ $posting->size }}</td>
                            <td>{{ $posting->sex }}</td>
                            <td>{{ $posting->background }}</td>
                            <td>{{ $posting->description }}</td>
                            <td class="text-nowrap"><strong>{{ $posting->status }}</strong></td>
                            <td>{{ $posting->medical }}</td>
                            @if($posting->vaccinated == 1)
                            <td><strong>Iya</strong></td>
                            @else
                            <td><strong>Tidak</strong></td>
                            @endif
                            @if($posting->neutered == 1)
                            <td><strong>Iya</strong></td>
                            @else
                            <td><strong>Tidak</strong></td>
                            @endif
                            @if($posting->friendly == 1)
                            <td><strong>Iya</strong></td>
                            @else
                            <td><strong>Tidak</strong></td>
                            @endif
                            <td class="text-nowrap">{{ $posting->date }}</td>
                            <td class="text-nowrap">{{ $posting->location }}</td>
                            <td class="text-nowrap">
                                <form action="{{ route('admin.posting.delete',$posting->id) }}" method="POST">
                                    @csrf

                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('admin.posting.edit',$posting->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus post ini ?');"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableposts').DataTable({
            dom: "<'row'<'col-sm-4 pull-left'B><'col-sm-3'l><'col-sm-5 pull-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    "className": 'btn btn-info',
                    title: 'E-dopt-see Data Postings',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    "className": 'btn btn-info',
                    title: 'E-dopt-see Data Postings',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
                    }
                },
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        $('input').addClass('form-control');
    });
</script>
@endsection