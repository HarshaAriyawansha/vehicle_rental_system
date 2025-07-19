@extends('layouts.app')

@section('content')
@include('navbar.user_account_nav')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create Role
                        <a href="{{ url('roles') }}" class="btn btn-danger float-end raised"><i class="fas fa-long-arrow-alt-left"></i>&nbsp;Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('create_roles') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                        <ul class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                        @endif
                        <div class="mb-3">
                            <label for="">Role Name</label>
                            <input type="text" name="name" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary raised"><i class="fas fa-save"></i>&nbsp;Save</button>
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