@extends('layouts.app')

@section('content')
    <div class="navbar-offset"></div>
    <section>
        <div class="container container-outter-litepage">
            <div class="container">
                <div class="container-shadow-litepage-lg mw-768 signup-container">
                    <div class="topbar text-body px-lg-4 my-2">
                        <div class="topbar-left-action" onclick="historyBack();">
                            <span class="icon-cheveron-Left"></span>
                        </div>
                        <div class="topbar-control">
                            <h1>
                                Daftar
                            </h1>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('register') }}" id="formRegister">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 px-lg-5">
                                <div class="form-group input-underline input-icon-group mb-0">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="astr">Name
                                    </label>
                                </div>
                                <div class="form-group input-underline input-icon-group mb-0">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="astr">Email</label>
                                </div>
                                <div class="form-group input-underline input-icon-group mb-0">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" required autocomplete="phone">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="astr">Phone Number / Wa</label>
                                </div>
                                <div class="form-group input-underline input-icon-group mb-0">
                                    <input id="registerPassword" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="registerPassword" class="astr">Kata sandi </label>
                                    <div class="input-icon-right peek-password-button"
                                        data-peek-password="registerPassword">
                                        <span class="peek-password-icon icon-Visibility"></span>
                                    </div>
                                </div>
                                <div class="password-strength-group" data-strength=""
                                    data-strength-inputid="registerPassword">
                                    <div id="password-strength-meter" class="password-strength-meter">
                                        <div class="meter-block"></div>
                                        <div class="meter-block"></div>
                                        <div class="meter-block"></div>
                                        <div class="meter-block"></div>
                                    </div>
                                    <div class="password-strength-message">
                                        <div class="message-item">
                                            Weak Password
                                        </div>
                                        <div class="message-item">
                                            Okay
                                        </div>
                                        <div class="message-item">
                                            Strong
                                        </div>
                                        <div class="message-item">
                                            Very Strong!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group input-underline input-icon-group mb-0">
                                    <input id="registerPasswordConfirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                    <label for="registerPasswordConfirm" class="astr"> Konfirmasi Kata
                                        sandi</label>
                                    <div class="input-icon-right peek-password-button"
                                        data-peek-password="registerPasswordConfirm">
                                        <span class="peek-password-icon icon-Visibility"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 px-lg-5">
                                <div class="form-group input-underline-marginonly mb-0">
                                    <label class="form-label astr">PIN Keamanan</label>

                                    <div class="slideup-enter-pin-wrap">
                                        <div id="create-pin-input-group" class="enter-pin-form-group">
                                            <div class="input-pin enter-pin-1"></div>
                                            <div class="input-pin enter-pin-2"></div>
                                            <div class="input-pin enter-pin-3"></div>
                                            <div class="input-pin enter-pin-4"></div>
                                            <div class="input-pin enter-pin-5"></div>
                                            <div class="input-pin enter-pin-6"></div>
                                            <input class="input-pin-hidden input-pin-master" required pattern="[0-9]*"
                                                inputmode="numeric" maxlength="6" autocomplete="off" id="registerSec"
                                                name="security_key" type="password" value="">
                                            <div class="input-pin-loadingbar"></div>
                                        </div>
                                        <small class="form-text text-muted">PIN Keamanan adalah kata sandi
                                            kedua untuk mengamankan akun Anda dengan lebih baik. Anda akan
                                            diminta untuk memasukkannya setiap kali Anda melakukan
                                            transaksi.</small>
                                    </div>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="signup-agree"
                                        name="signup_agree" required checked />
                                    <label class="custom-control-label mt-3" for="signup-agree">
                                        Dengan klik "Daftar", berarti Anda setuju dengan <a
                                            href="user-terms-and-conditions.html" target="_blank">Syarat dan
                                            Ketentuan Pengguna</a> & <a href="privacy-policy.html"
                                            target="_blank">Kebijakan Privasi</a>. <span class="astr"></span>
                                    </label>
                                </div>
                                <button type="submit" id="signup-email-submit-button"
                                    class="btn btn-primary auth-submit-button rounded-pill btn-block mt-4">
                                    {{ __('Register') }}</button>
                                <div class="text-center u-body-3 mt-3">
                                </div>
                                @if ($settings->google_login)
                                    <div class="border-separator-wtext freg my-3">
                                        or sign in with social account
                                    </div>
                                    <a href="{{ route('auth.google') }}" id="google_button"
                                        class="btn btn-light btn-google rounded-pill btn-block mt-3 text-dark">
                                        <img class="social-media-icon" style="width: 4%"
                                            src="{{ asset('assets/app/images/google.png') }}" alt="">
                                        Google
                                    </a>
                                @endif
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function passwordCheck(password) {
            if (password.length >= 8)
                strength += 1;
            if (password.match(/(?=.*[0-9])/))
                strength += 1;
            if (password.match(/(?=.*[!,%,&,@,#,$,^,*,?,_,~,<,>,])/))
                strength += 1;
            if (password.match(/(?=.*[a-z])/))
                strength += 1;

            return strength;
        }

        $('.password-strength-group').each(function(index, element) {
            let inputId = $(this);

            $('#' + inputId.data('strength-inputid')).keyup(function(event) {
                strength = 0;
                var password = event.target.value;
                inputId.attr('data-strength', passwordCheck(password));
            });
        });

        $("#create-pin-input-group").inputPinGroup({
            maxChar: 6
        });

        $("#signup-email-submit-button").loadingButton('onClick',
            function() {
                $('#formRegister').submit();
            });

        $("#google_button").loadingButton('onClick', function() {});
    </script>
@endpush
