@extends('layouts.master')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="card mt-2">
        <div class="card-header">
            <h3>Data Permohonan</h3>
        </div>
        <div class="card-body justify-content-center">
            <div class="table-responsive">
                <table id="tableapplications" class="table table-striped table-bordered text-center" style="width:100%">
                    <thead class="thead-dark" style="font-size:12px;">
                        <tr>
                            <th>Id Permohonan</th>
                            <th>Id Pengguna</th>
                            <th>Nama Pemohon</th>
                            <th>Id Post</th>
                            <th>Nama Hewan</th>
                            <th>No. HP</th>
                            <th>Alasan</th>
                            <th>Hewan Lain</th>
                            <th>Izin</th>
                            <th>Tanggal Kirim</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                        <tr>
                            <td><strong>{{ $application->id }}</strong></td>
                            <td><strong>{{ $application->id_user }}</strong></td>
                            <td>{{ $application->name }}</td>
                            <td><strong>{{ $application->id_post }}</strong></td>
                            <td>{{ $application->animalsname }}</td>
                            <td>{{ $application->phone }}</td>
                            <td>{{ $application->reason }}</td>
                            <td>{{ $application->otheranimals }}</td>
                            <td>{{ $application->permissions }}</td>
                            <td class="text-nowrap">{{ $application->apply_date }}</td>
                            <td>{{ $application->location }}</td>
                            @if($application->status == 0)
                            <td><strong>Pending</strong></td>
                            @elseif($application->status == 1)
                            <td><strong>Diterima</strong></td>
                            @elseif($application->status == 2)
                            <td><strong>Ditolak</strong></td>
                            @elseif($application->status == 3)
                            <td><strong>Pengadopsi</strong></td>
                            @elseif($application->status == 4)
                            <td><strong>Teradopsi oleh orang lain</strong></td>
                            @endif
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
        $('#tableapplications').DataTable({
            dom: "<'row'<'col-sm-4 pull-left'B><'col-sm-3'l><'col-sm-5 pull-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    "className": 'btn btn-info',
                    title: 'E-dopt-see Data Applications'

                },
                {
                    extend: 'print',
                    text: 'Print',
                    "className": 'btn btn-info',
                    title: 'E-dopt-see Data Applications'
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