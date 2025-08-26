@extends('layouts.auth')

@section('content')
    <h3 class="text-center mb-4">Register</h3>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Full Name') }}</label>
            <input id="name" type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" 
                class="form-control @error('email') is-invalid @enderror" 
                name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" 
                class="form-control @error('password') is-invalid @enderror" 
                name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" 
                name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-success w-100 mb-3">
            {{ __('Register') }}
        </button>

        <p class="text-center">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}">{{ __('Login here') }}</a>
        </p>
    </form>
@endsection
