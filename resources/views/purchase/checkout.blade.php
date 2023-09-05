@extends('layouts.app')

@section('content')
    <div class="product-banner-offset-lte">
        <img class="img-fluid product-game-banner"
            src="https://www.pajak.com/storage/2023/03/Is-Blockchain-the-Future-of-Finance.jpg" alt="{{ $brand->name }}"
            style="object-fit: cover" />
    </div>

    <div class="container-fluid">
        <div class="container-shadow-litepage-lg mw-576">
            <div class="row">
                <div class="col-12">
                    <div class="topbar topbar-checkout">
                        <div class="topbar-left-action" onclick="historyBack();">
                            <span class="icon-cheveron-Left"></span>
                        </div>
                        <div class="topbar-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="loading" style="display:none;">Memuat…&#8230;</div>
            <div class="litepage-fullheight px-sm-checkout">
                <div class="checkout-overview text-center">
                    <div class="mt-2 mb-3 img-payment-logo">
                        <img class="payment-logo bg-dark" src="{{ $payment->logo_url }}"
                            alt="{{ ucwords($payment->name) }}">
                    </div>
                    <div class="checkout-payment-name text-dark-50 mt-2">
                        {{ ucwords($payment->name) }}
                    </div>
                    <small>Total Tagihan</small>
                    @php
                        $total = $produk->harga_jual + env('ADMIN_FEE');
                    @endphp
                    <div class="checkout-amount text-primary">
                        IDR {{ number_format($total, 2, ',', '.') }}
                    </div>
                </div>
                <div class="checkout-details-container">
                    <div class="details-row">
                        <div class="details-label text-dark-50">
                            Item
                        </div>
                        <div class="details-value">
                            {{ ucwords(strtolower($brand->name)) }} - {{ ucwords($produk->name) }}
                        </div>
                    </div>
                    <div class="details-row">
                        <div class="details-label text-dark-50">
                            Email
                        </div>
                        <div class="details-value">
                            {{ $mail }}
                        </div>
                    </div>
                    <div class="details-row">
                        <div class="details-label text-dark-50">
                            Biaya Admin
                        </div>
                        <div class="details-value">
                            IDR {{ number_format(env('ADMIN_FEE'), 2, ',', '.') }}
                        </div>
                    </div>
                    <div class="details-row">
                        <div class="details-label text-dark-50">
                            Harga
                        </div>
                        <div class="details-value">
                            IDR {{ number_format($produk->harga_jual, 2, ',', '.') }}
                        </div>
                    </div>
                    <div class="mt-3">
                    </div>
                </div>

                <form action="{{ route('purchase.order') }}" method="POST" id="formOrder">
                    @csrf
                    <input type="hidden" name="email" id="email" value="{{ $mail }}">
                    <input type="hidden" name="admin_fee" id="admin_fee" value="{{ env('ADMIN_FEE') }}">
                    <input type="hidden" name="total_harga" id="total" value="{{ $total }}">
                    <input type="hidden" name="brand_id" id="brand_id" value="{{ $brand->id }}">
                    <input type="hidden" name="produk_id" id="produk_id" value="{{ $produk->id }}">
                    <input type="hidden" name="payment_id" id="payment_id" value="{{ $payment->id }}">
                    <input type="hidden" name="id_pengguna" value="{{ $id_pengguna }}">
                    <input type="hidden" name="id_zona" value="{{ $id_zona }}">
                    <input type="hidden" name="data_pengguna" value="{{ $data_pengguna }}">
                    <input type="hidden" name="type_transaksi" value="order">
                    {{-- <div class="checkout-billing-section mb-3">
                        <div class="border-separator mb-4"></div>
                        <div class="form-group input-underline-marginonly mb-3">
                            <label class="form-label">
                                Masukkan PIN Keamanan Anda
                            </label>
                            <div class="slideup-enter-pin-wrap">
                                <div id="pin-input-group" class="enter-pin-form-group">
                                    <div class="input-pin enter-pin-1"></div>
                                    <div class="input-pin enter-pin-2"></div>
                                    <div class="input-pin enter-pin-3"></div>
                                    <div class="input-pin enter-pin-4"></div>
                                    <div class="input-pin enter-pin-5"></div>
                                    <div class="input-pin enter-pin-6"></div>
                                    <input class="input-pin-hidden input-pin-master" required pattern="[0-9]*"
                                        inputmode="numeric" maxlength="6" autocomplete="off" id="security_key"
                                        name="security_key" type="password" value="">
                                </div>
                            </div>
                            @error('security_key')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> --}}
                </form>

                <div class="row mt-auto mb-5 mb-sm-0">
                    <div class="col-12">
                        <button type="button" id="konfirmasi-button"
                            class="text-uppercase btn btn-primary btn-thumb rounded-pill btn-block">
                            {{ __('Konfirmasi') }}</button>
                        <div class="checkout-foot-details mt-3 text-center">
                            Dengan melanjutkan, artinya Anda setuju dengan <a href="#" target="_blank">Syarat dan
                                Ketentuan </a> &amp; <a href="#" target="_blank">Kebijakan Privasi</a> kami.
                        </div>
                        <div class="payment-secured-badge text-center mt-3">
                            <div class="payment-secured-icon">
                                <span class="icon-Verified-User"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.loading').show();
        $(document).ready(function() {
            $('.loading').hide();
            $('#konfirmasi-button').loadingButton('onClick', function() {
                $('.loading').show();
                if (!validateFormOrder()) return;
                $('#formOrder').submit();
            })

            $('#formOrder').on('submit', function() {
                $('.loading').show();
            })

            var error = "{{ session()->get('error') }}";
            if (error != '') {
                $('.loading').hide();

                $('html,body').animate({
                    scrollTop: $('#pin-input-group').offset().top - 200
                }, 400);
            }

            $("#pin-input-group").inputPinGroup({
                maxChar: 6
            });

            $('#security_key').on('keyup', function() {
                if ($(this).val().length == 6) {
                    $('.loading').show();
                    if (!validateFormOrder()) return;
                    $('#formOrder').submit();
                }
            })
        })

        function validateFormOrder() {
            if ($('#email').val() == '' || $('#admin_fee').val() == '' || $('#total').val() == '' ||
                $('#brand_id').val() == '' || $('#produk_id').val() == '' || $('#payment_id').val() == '') {
                $('.loading').hide();
                alert('Terjadi kesalahan, silahkan coba lagi.');
                $('#checkoutModal').modal('hide');
                window.location.reload();
                return false;
            }
            return true;
        }
    </script>
@endpush
