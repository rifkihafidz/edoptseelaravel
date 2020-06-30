@extends('layouts.master')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="card mt-2">
        <div class="card-header">
            <h3>Data Users</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tableusers" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><img src="{{ url('assets/uploads/avatars') }}/{{ $user->avatar }}" class="img-fluid" style="width:75px; height:75px;"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->password }}</td>
                            <td>{{ $user->alamat }}</td>
                            <td>{{ $user->no_hp }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="text-nowrap" style="text-align: center;">
                                <form action="{{ route('admin.user.delete',$user->id) }}" method="POST">
                                    @csrf

                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user ?');"><i class="fas fa-trash-alt"></i></button>
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
        $('#tableusers').DataTable();
    });
</script>
@endsection