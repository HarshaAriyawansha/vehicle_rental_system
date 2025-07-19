@extends('layouts.app')

@section('content')
@include('navbar.user_account_nav')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Permissions
                        @can('create_permission')
                        <a href="{{ url('permissions/create') }}" class="btn btn-primary float-end raised"><i class="fas fa-plus"></i>&nbsp;Add Permission</a>
                        @endcan
                    </h4>
                </div>
                <div class="card-body">
                    <div class="scrollbar pb-3" id="style-2">
                        <table class="table table-bordered table-striped table-sm nowrap w-100"  id="dataTable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Module</th>
                                    <th>Name</th>
                                    <th width="40%" class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->module_name }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td class="text-end">
                                        @can('update_permission')
                                        <a href="{{ url('permissions/'.$permission->id.'/edit') }}"
                                            class="btn btn-success btn-sm raised"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                        @endcan

                                        @can('delete_permission')
                                        <a href="javascript:void(0);" onclick="confirmation_alert('{{ url('permissions/'.$permission->id.'/delete') }}')" class="btn btn-danger btn-sm raised"><i class="fas fa-trash"></i>&nbsp;Delete</a>
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
        $('#permission_link').addClass('navbtnactive');

        $('#dataTable').DataTable();
    });

    function confirmation_alert(deleteUrl) {
	Lobibox.confirm({
		msg: "Are you sure you want to delete this permission?",
        callback: function ($this, type) {
            if (type === 'yes') {
                window.location.href = deleteUrl; 
            }
        }
	});   
}
</script>
@endsection

