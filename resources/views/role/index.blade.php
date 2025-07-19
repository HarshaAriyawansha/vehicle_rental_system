@extends('layouts.app')

@section('content')
@include('navbar.user_account_nav')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Roles
                        @can('create_role')
                        <a href="{{ url('roles/create') }}" class="btn btn-primary float-end raised"><i class="fas fa-plus"></i>&nbsp;Add Role</a>
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
                                    <th width="40%" class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td class="text-end">
                                        <a href="{{ url('roles/'.$role->id.'/give-permissions') }}"
                                            class="btn btn-sm btn-warning raised">
                                            <i class="fas fa-pen"></i>&nbsp;Add / Edit Role Permission
                                        </a>

                                        @can('update_role')
                                        <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-sm btn-success raised">
                                        <i class="fas fa-edit"></i>&nbsp;Edit
                                        </a>
                                        @endcan

                                        @can('delete_role')
                                        <a href="javascript:void(0);"
                                            onclick="confirmation_alert('{{ url('roles/'.$role->id.'/delete') }}')"
                                            class="btn btn-danger btn-sm raised"><i class="fas fa-trash"></i>&nbsp;Delete</a>
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
        $('#rolelink').addClass('navbtnactive');

        $('#dataTable').DataTable();
    });

    function confirmation_alert(deleteUrl) {
	Lobibox.confirm({
		msg: "Are you sure you want to delete this role?",
        callback: function ($this, type) {
            if (type === 'yes') {
                window.location.href = deleteUrl; 
            }
        }
	});   
}
</script>
@endsection

