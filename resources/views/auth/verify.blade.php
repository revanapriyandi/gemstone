@extends('layouts.app')

@section('content')
    <div class="navbar-offset"></div>
    <div class="container container-outter-litepage">
        <div class="container-shadow-litepage-lg mw-576 signin-container pt-5">
            <div class="h2">{{ __('Verify Your Email Address') }}</div>

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit"
                    class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>
@endsection
