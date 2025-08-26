@extends('layouts.auth')

@section('content')
    <h3 class="text-center mb-4">{{ __('Verify Your Email Address') }}</h3>

    @if (session('resent'))
        <div class="alert alert-success text-center" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    <p class="text-center mb-4">
        {{ __('Before proceeding, please check your email for a verification link.') }}
        <br>
        {{ __('If you did not receive the email, you can request another one below:') }}
    </p>

    <form class="d-flex justify-content-center" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary">
            {{ __('Resend Verification Email') }}
        </button>
    </form>
@endsection
