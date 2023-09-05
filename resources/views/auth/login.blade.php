@extends('layouts.app')

@section('content')
    <div class="navbar-offset"></div>
    <div class="container container-outter-litepage">
        <div class="container-shadow-litepage-lg mw-576 signin-container pt-5">
            <h2 class="text-center title-case-0">Sign in to {{ config('app.name') }}</h2>
            <form method="POST" action="{{ route('login') }}" id="formLogin">
                @csrf
                <div class="form-group input-underline">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label>Email</label>
                </div>
                <div class="form-group input-underline input-icon-group mb-0">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        required autocomplete="current-password" id="signInPassword">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label>Password</label>
                    <div class="input-icon-right" data-peek-password="signInPassword">
                        <span class="peek-password-icon icon-Visibility"></span>
                    </div>
                </div>

                @if (Route::has('password.request'))
                    <div class="d-flex justify-content-between">
                        <a class="u-body-3 text-primary" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}</a>
                    </div>
                @endif
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="remember" name="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label mt-3" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <button type="submit" id="signin-email-submit-button" class="btn btn-primary rounded-pill btn-block mt-4">
                    {{ __('Login') }}</button>

                @if ($settings->app_register)
                    <div class="text-center u-body-3 mt-3">
                        Don&#039;t have an account?
                        <a href="{{ route('register') }}">
                            Sign up now
                        </a>
                    </div>
                @endif
                @if ($settings->google_login)
                    <div class="border-separator-wtext freg my-4">
                        or sign in with social account
                    </div>
                    <a href="{{ route('auth.google') }}" id="google_button"
                        class="btn btn-light btn-google rounded-pill btn-block mt-3 text-dark">
                        <img class="social-media-icon" style="width: 4%" src="{{ asset('assets/app/images/google.png') }}"
                            alt="">
                        Google
                    </a>
                @endif
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $("#signin-email-submit-button").loadingButton('onClick',
            function() { //Define callback function when loading button clicked
                $('#formLogin').submit();
            });

        $("#google_button").loadingButton('onClick', function() {});
    </script>
@endpush
