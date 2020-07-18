@extends('layouts.master')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="card mt-2">
        <div class="card-header">
            <h3>Data Adopsi</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tableadopts" class="table table-striped table-bordered text-center" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id Adopsi</th>
                            <th>Id Pemilik</th>
                            <th>Nama Pemilik</th>
                            <th>Id Pengadopsi</th>
                            <th>Nama Pengadopsi</th>
                            <th>Id Post</th>
                            <th>Nama Hewan</th>
                            <th>Id Permohonan</th>
                            <th>Tanggal Adopsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adopts as $adopt)
                        <tr>
                            <td><strong>{{ $adopt->idadopts }}</strong></td>
                            <td><strong>{{ $adopt->idowners }}</strong></td>
                            <td>{{ $adopt->ownername }}</td>
                            <td><strong>{{ $adopt->idadopters }}</strong></td>
                            <td>{{ $adopt->adoptername }}</td>
                            <td><strong>{{ $adopt->idposts }}</strong></td>
                            <td>{{ $adopt->animalname }}</td>
                            <td><strong>{{ $adopt->idapplications }}</strong></td>
                            <td>{{ $adopt->adoptedat }}</td>
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
        $('#tableadopts').DataTable({
            dom: "<'row'<'col-sm-4 pull-left'B><'col-sm-3'l><'col-sm-5 pull-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [{
                    extend: 'excel',
                    "className": 'btn btn-info',
                    title: 'E-dopt-see Data Adopts'
                },
                {
                    extend: 'print',
                    "className": 'btn btn-info',
                    title: 'E-dopt-see Data Adopts'
                },
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari..."
            }
        });
        $('input').addClass('form-control');
    });
</script>
@endsection