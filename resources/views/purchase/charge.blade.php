@extends('layouts.app')

@section('content')
    <div class="product-banner-offset-lte">
        <img class="img-fluid product-game-banner"
            src="https://www.tasgroup.eu/app/uploads/sites/2/2023/01/omnichannel-acceptance-EN.jpg"
            alt="{{ $data->produk->name }}" style="object-fit: cover" />
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
                    <img class="payment-success-badge"
                        src="https://cdni.iconscout.com/illustration/premium/thumb/secured-payment-2245534-1889494.png"
                        alt="payment waiting">
                    <div class="checkout-payment-name text-dark-50 mt-2">
                        <span class="text-primary">
                            @if ($data->payment->status == 'pending')
                                Menunggu Pembayaran
                            @elseif($data->payment->status == 'success')
                                Pembayaran Berhasil
                            @else
                                Pembayaran Gagal
                            @endif
                        </span><br>
                        <span class="text-white badge badge-primary text-uppercase mt-3">
                            {{ $data->payment->status }}
                        </span>
                    </div>
                    <div class="checkout-amount">Rp. {{ number_format($data->payment->payment_amount, 0, ',', '.') }}</div>
                </div>
                <div class="checkout-details-container">
                    <div class="details-row">
                        <div class="details-label text-dark-50">No. Transaksi</div>
                        <div class="details-value" id="trans_id">
                            {{ $data->payment->payment_transaction_id }}
                            <button id="btn_txt_copy_id" class="btn p-0 text-primary"><i class="fa fa-copy"></i></button>
                        </div>
                    </div>
                    <div class="details-row">
                        <div class="details-label text-dark-50">
                            Bank Tujuan
                        </div>
                        <div class="details-value text-uppercase" id="trans_ref">
                            {{ $data->payment->payment_bank }}
                            <button id="btn_txt_copy_ref" class="btn p-0 text-primary">
                                <i class="fa fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <div class="details-row">
                        <div class="details-label text-dark-50">
                            Virtual Account
                        </div>
                        <div class="details-value" id="trans_va">
                            {{ $data->payment->payment_va_number }}
                            <button id="btn_txt_copy_va" class="btn p-0 text-primary">
                                <i class="fa fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <div class="details-row">
                        <div class="details-label text-dark-50">
                            Item
                        </div>
                        <div class="details-value">
                            {{ ucwords($data->produk->name) }}
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-left">
                </div>
                <br>
                <div class="row mt-auto mb-5 mb-sm-0">
                    <div class="col-12">
                        <div class="d-flex same-row-button">
                            <a class="btn btn-primary rounded-pill btn-thumb"
                                onclick="window.location.href='https://www.unipin.com';">
                                Keluar
                            </a>
                        </div>
                        <div class="checkout-foot-details my-3 text-center">
                        </div>
                        <div class="checkout-foot-details my-3 text-center">
                            Jendela pop-up aman untuk ditutup sekarang.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

    <script>
        $('.loading').show();
        $(document).ready(function() {
            $('.loading').hide();
            var clipboardTransID = new ClipboardJS('#btn_txt_copy_id', {
                text: function(trigger) {
                    return document.querySelector('#trans_id').textContent;
                }
            });

            var clipboardTransRef = new ClipboardJS('#btn_txt_copy_ref', {
                text: function(trigger) {
                    return document.querySelector('#trans_ref').textContent;
                }
            });

            var clipboardVANumber = new ClipboardJS('#btn_txt_copy_va', {
                text: function(trigger) {
                    return document.querySelector('#trans_va').textContent;
                }
            });

            clipboardTransID.on('success', function(e) {
                $('#txt_copied_id').fadeIn().delay(1500).fadeOut();
                e.clearSelection();
            });

            clipboardTransRef.on('success', function(e) {
                $('#txt_copied_ref').fadeIn().delay(1500).fadeOut();
                e.clearSelection();
            });

            clipboardVANumber.on('success', function(e) {
                $('#txt_copied_va').fadeIn().delay(1500).fadeOut();
                e.clearSelection();
            });
        })
    </script>
@endpush
