<div class="modal modal-fullscreen-desktop-normal" id="account-modal" tabindex="-1" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="folay-container full100-flex-col">
                <ul class="nav nav-tabs d-none" id="accountTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="signin-tab" data-toggle="tab" href="#signin" role="tab"
                            aria-controls="signin">Sign In</a>
                    </li>
                </ul>
                <div class="pageset-account tab-content full100-flex-col" id="accountTabContent">
                    <div class="tab-pane folay-horizontal-desktop fade show active" id="signin" role="tabpanel"
                        aria-labelledby="signin-tab">
                        <div class="folay-top">
                            <div class="col-12">
                                <div class="topbar">
                                    <div class="topbar-left-action" data-dismiss="modal">
                                        <span class="icon-cheveron-Left"></span>
                                    </div>
                                    <div class="topbar-control">
                                    </div>
                                </div>
                            </div>
                            <div class="folay-title">
                                Masuk
                                <div class="folay-subtitle">
                                    Masuk ke UniPin
                                </div>
                            </div>
                        </div>
                        <div class="folay-white-container">
                            <div class="folay-unipin-logo">
                                <a href="index.html"><img src="https://cdn.unipin.com/images/unipin-logo.svg" /></a>
                            </div>
                            <div class="tab-content" id="pills-tab-signinchoiceContent">

                                <div class="tab-pane fade show active" id="pills-signin-email-content" role="tabpanel"
                                    aria-labelledby="pills-signin-email-tab">

                                    <div class="tab-pane fade show active" id="pills-signin-phone" role="tabpanel"
                                        aria-labelledby="pills-signin-phone-tab">
                                        <form method="POST" action="https://www.unipin.com/login"
                                            accept-charset="UTF-8" class="" id="signin-form-viaemail"><input
                                                name="_token" type="hidden"
                                                value="ba1GuIp57L8i1Ik0OAuxE9wYjOXDTfw2frxNHvD6">
                                            <input type="hidden" name="popup" value="1">
                                            <input type="hidden"
                                                name="NlJiEEskCNisKXMrmyFHCtfZwzlMxqxOepsbXSmgaNrGUnhegmSBYGtqIRheUSGzywEkzsrZeXICfvMBSpFhQPhEbHRtBsxtJOZF"
                                                value="OOxFSBFcEoQHZJqLFnypnqezmONOHEhiLluLPDCisOZcQBUpyGtsadceaAjIpSurOnzJNCbDUcxUCBckLokmYgWehknKtlKwhZPg">
                                            <div class="form-group input-underline">
                                                <input class="form-control" required id="loginEmailSide"
                                                    autocomplete="username"
                                                    name="fQUUHovjFpdzzNCGcnvGiwfNrDISCWYMnAwAeBKwZeoECBPTVvhSLPnxCbAKiZWLqbQCTVtuUTXxMcYjptWdOqiuvHbSwmhGSwnb"
                                                    type="email" value="">
                                                <label>Email</label>
                                            </div>
                                            <div class="form-group input-underline input-icon-group mb-0">
                                                <input class="form-control" required id="loginPassword"
                                                    autocomplete="off"
                                                    name="QguzyoRhMkkqeWOKzukXezYQJSkiDBetovbkSMuvVMyhYHqJypGDAJTheHVwqSjvOLaRvdwuZOFIOCKsFJoyTBJoWfYzmpXTIhVV"
                                                    type="password" value="">
                                                <label>Kata sandi</label>
                                                <div class="input-icon-right peek-password-button"
                                                    data-peek-password="loginPassword">
                                                    <span class="peek-password-icon icon-Visibility"></span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <a class="u-body-3 text-primary" href="password.html">Tidak
                                                    ingat kata sandi?</a>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" id="signin-email-submit-button"
                                                    class="btn btn-primary auth-submit-button rounded-pill btn-block mt-4">Masuk</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                                <div class="text-center u-body-3 mt-3">
                                    Belum punya akun? <a href="javascript:void(0)" id="signup-action-trigger">Daftar
                                        sekarang</a>
                                </div>
                            </div>
                            <div class="border-separator-wtext freg my-4">
                                or sign in with social account
                            </div>
                            <div class="col-12">
                                <div class="signin-social-media">
                                    <a href="https://www.facebook.com/v3.0/dialog/oauth?client_id=1247593455251878&amp;redirect_uri=https%3A%2F%2Fwww.unipin.com%2Ffacebook%2Fcallback&amp;scope=email&amp;response_type=code&amp;state=1KUwpnuZSuvkfDKYv91SdEzFXyEDHNOfk8XXjh3E"
                                        id="fb_button" class="btn btn-light btn-facebook rounded-pill btn-block mt-3">
                                        <img class="social-media-icon"
                                            src="https://cdn.unipin.com/images/navigation/facebook-icon.svg"
                                            alt="">
                                        Masuk Facebook
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="pageset-account folay-horizontal-desktop fade" id="page-create-account"
                    style="display:none;">
                    <div class="create-account-outter">
                        <div class="topbar text-body">
                            <div id="cancel-create-account" class="topbar-left-action">
                                <span class="icon-cheveron-Left"></span>
                            </div>
                            <div class="topbar-control">
                                <h1>
                                    Daftar
                                </h1>
                            </div>
                        </div>
                        <div class="create-account-form-wrap">
                            <form method="POST" action="https://www.unipin.com/register" accept-charset="UTF-8"
                                class="auth-form" id="create-account-form" style="width:100%;"><input name="_token"
                                    type="hidden" value="ba1GuIp57L8i1Ik0OAuxE9wYjOXDTfw2frxNHvD6">
                                <div class="row px-lg-4">
                                    <div class="col-md-6 px-lg-5">
                                        <div class="form-group input-underline">
                                            <input class="form-control" id="signupInputName" autofocus required
                                                name="name" type="text" value="">
                                            <label>Nama
                                                <span class="astr"></span>
                                            </label>

                                        </div>
                                        <div class="form-group input-underline">
                                            <input class="form-control" id="signup-email-input" required
                                                name="email" type="text" value="">
                                            <label>Email
                                                <span class="astr"></span>
                                            </label>
                                        </div>
                                        <div class="form-group input-underline input-icon-group">
                                            <input class="form-control datetimepicker mb-0" id="createaccount-dob"
                                                autocomplete="off" data-toggle="datetimepicker"
                                                data-target="#createaccount-dob" aria-describedby="dobHelp"
                                                name="dob" type="text" value="">
                                            <label for="dob" for="edit-profile-dob">Tanggal
                                                lahir</label>
                                            <div class="input-icon-right">
                                                <label for="createaccount-dob">
                                                    <span class="icon-Arrow-Drop-Down"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group input-underline input-icon-group mb-0">
                                            <input class="form-control mb-1"
                                                placeholder="Isi jika Anda memiliki kode referral"
                                                name="referral_code" type="text" value="">
                                            <label for="referral_code"> Kode Referral</label>
                                        </div>
                                        <div class="form-group input-underline input-icon-group mb-0">
                                            <input class="form-control mb-1" id="signup-password-input" required
                                                autocomplete="off" name="password" type="password" value="">
                                            <label>Kata sandi
                                                <span class="astr"></span>
                                            </label>
                                            <div class="input-icon-right peek-password-button"
                                                data-peek-password="signup-password-input">
                                                <span class="peek-password-icon icon-Visibility"></span>
                                            </div>
                                        </div>
                                        <div class="password-strength-group" data-strength=""
                                            data-strength-inputid="signup-password-input">
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
                                            <input class="form-control mb-1" id="signup-password_confirmation-input"
                                                required autocomplete="off" autofill="off"
                                                name="password_confirmation" type="password" value="">
                                            <label for="password_confirmation"
                                                for="signup-password_confirmation-input">Harap Masukkan
                                                Ulang Kata Sandi</label>
                                            <div class="input-icon-right peek-password-button"
                                                data-peek-password="signup-password_confirmation-input">
                                                <span class="peek-password-icon icon-Visibility"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-lg-5">
                                        <div class="form-group input-underline-marginonly mb-0">
                                            <label for="security_key" for="signup-password_confirmation-input"
                                                class="form-label">PIN Keamanan</label>
                                            <span class="astr"> </span>

                                            <div class="slideup-enter-pin-wrap">
                                                <div id="create-pin-input-group" class="enter-pin-form-group">
                                                    <div class="input-pin enter-pin-1"></div>
                                                    <div class="input-pin enter-pin-2"></div>
                                                    <div class="input-pin enter-pin-3"></div>
                                                    <div class="input-pin enter-pin-4"></div>
                                                    <div class="input-pin enter-pin-5"></div>
                                                    <div class="input-pin enter-pin-6"></div>
                                                    <input class="input-pin-hidden input-pin-master" required
                                                        autocomplete="off" id="create-account-pin" pattern="[0-9]*"
                                                        inputmode="numeric" maxlength="6" name="security_key"
                                                        type="password" value="">
                                                    <div class="input-pin-loadingbar"></div>
                                                </div>
                                                <small class="form-text text-muted">PIN Keamanan adalah
                                                    kata
                                                    sandi kedua untuk mengamankan akun Anda dengan lebih
                                                    baik. Anda akan diminta untuk memasukkannya setiap kali
                                                    Anda melakukan transaksi.</small>

                                            </div>

                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="signup-agree"
                                                name="signup_agree" required checked />
                                            <label class="custom-control-label mt-3" for="signup-agree">
                                                Dengan klik "Daftar", berarti Anda setuju dengan <a
                                                    href="user-terms-and-conditions.html" target="_blank">Syarat dan
                                                    Ketentuan Pengguna</a> & <a href="privacy-policy.html"
                                                    target="_blank">Kebijakan
                                                    Privasi</a>. <span class="astr"></span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="subscribe-agree"
                                                name="subscribe_agree" checked />
                                            <label class="custom-control-label mt-3" for="subscribe-agree">
                                                Subscribe to news and promo
                                            </label>
                                        </div>
                                        <button id="createaccount-submit-button"
                                            class="btn btn-primary btn-thumb rounded-pill btn-block mt-5">
                                            Daftar
                                        </button>
                                        <div class="border-separator-wtext freg my-3">
                                            or sign in with social account
                                        </div>
                                        <a href="https://www.facebook.com/v3.0/dialog/oauth?client_id=1247593455251878&amp;redirect_uri=https%3A%2F%2Fwww.unipin.com%2Ffacebook%2Fcallback&amp;scope=email&amp;response_type=code&amp;state=tJyJVBfk2KlNUf1hZNnq2pCU9M1PWKTrStXojrSu"
                                            id="fb_button"
                                            class="btn btn-light btn-facebook rounded-pill btn-block mt-3">
                                            <img class="social-media-icon"
                                                src="https://cdn.unipin.com/images/navigation/facebook-icon.svg"
                                                alt="">
                                            Daftar Facebook
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
