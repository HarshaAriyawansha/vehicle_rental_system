@extends('layouts.app')

@section('content')
@include('navbar.user_account_nav')
<div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Users
                            @can('create_user')
                            <a href="{{ url('users/create') }}" class="btn btn-primary float-end raised"><i class="fas fa-plus"></i>&nbsp;Add User</a>
                            @endcan
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="scrollbar pb-3" id="style-2">
                            <table class="table table-bordered table-striped table-sm nowrap w-100"  id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $rolename)
                                                    <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            @can('update_user')
                                            <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-success btn-sm raised"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                            @endcan

                                            @can('delete_user')
                                            <a href="javascript:void(0);" onclick="confirmation_alert('{{ url('users/'.$user->id.'/delete') }}')" class="btn btn-danger btn-sm raised"><i class="fas fa-trash"></i>&nbsp;Delete</a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#UserAccount').addClass('mm-active');
        $('#useraccount_link').addClass('navbtnactive');

        $('#dataTable').DataTable();
    });

    function confirmation_alert(deleteUrl) {
	Lobibox.confirm({
		msg: "Are you sure you want to delete this user?",
        callback: function ($this, type) {
            if (type === 'yes') {
                window.location.href = deleteUrl; 
            }
        }
	});   
}
</script>
@endsection

