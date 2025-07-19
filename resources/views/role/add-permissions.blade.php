@extends('layouts.app')

@section('content')
@include('navbar.user_account_nav')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Role : {{ $role->name }}
                        <a href="{{ url('roles') }}" class="btn btn-danger float-end raised"><i class="fas fa-long-arrow-alt-left"></i>&nbsp;Back</a>
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            @error('permission')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <label for="" class="mb-3">Permissions</label>

                            <div class="row">
                                @foreach ($permissions->groupBy('module_name') as $moduleName => $modulePermissions)
                                <div class="col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>{{ $moduleName }}</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($modulePermissions as $permission)
                                                <div class="col-lg-12">
                                                    <label>
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary raised"><i class="fas fa-save"></i>&nbsp;Update</button>
                        </div>
                    </form>
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
    });
</script>
@endsection