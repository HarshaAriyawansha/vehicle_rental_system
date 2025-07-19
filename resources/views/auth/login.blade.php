@extends('layouts.defult')

@section('content')
<div class="login-container">
    <img class="login_logo" src="{{ asset('/images/logo.png') }}" alt="Company Logo" />
    
    <form action="{{ route('login') }}" method="post">
        @csrf        
        <div class="inputGroup inputGroup1">
            <label for="loginEmail" id="loginEmailLabel">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        </div>
        
        <div class="inputGroup inputGroup2">
            <label for="loginPassword" id="loginPasswordLabel">Password</label>
            <input id="password" name="password" type="password" 
                   class="form-control @error('password') is-invalid @enderror"  
                   required autocomplete="current-password">
                   
            <label id="showPasswordToggle" for="showPasswordCheck">
                Show Password
                <input id="showPasswordCheck" type="checkbox"/>
                <div class="indicator"></div>
            </label>

        </div>
        
        <div class="inputGroup inputGroup3">
            <button type="submit" id="login">Log in</button>
        </div>
        
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <div class="col-md-12 small text-center">
             Dream Car Rent Copyright {{ date('Y') }}
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const showPasswordCheck = document.getElementById('showPasswordCheck');
        
        showPasswordCheck.addEventListener('change', function() {
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    });
</script>
@endsection