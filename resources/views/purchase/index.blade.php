@extends('layouts.app')

@section('content')
    <div class="product-banner-offset">
        <img class="img-fluid product-game-banner" src="{{ $brand->banner_url }}" alt="{{ $brand->name }}" />
    </div>
    <div class="product-outter-container">
        <div class="container container-1440 product-shift-top">
            <div class="px-lg-3">
                <div class="row">
                    @include('purchase._partials.detailBrand')

                    <div class="col-lg-7 px-sm-3">
                        @include('purchase._partials.step1')
                        <div class="loading" style="display:none;">Memuat…&#8230;</div>
                        @include('purchase._partials.produk')

                        @include('purchase._partials.payment')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('modal')
    <div id="checkoutModal" class="modal fade mt-30" tabindex="-1" role="dialog" labelledby="checkoutModalLabel">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center w-100">Konfirmasi Pesanan Anda </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="iframe-container">
                        <iframe id="checkoutIframe" height="450" frameborder="0" width="100%"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.produk').on('click', function() {
                $('.loading').show();
                if (validateForm()) {
                    var harga = $('input[name="produkId"]:checked').data('harga');
                    getMetodePembayaran(harga);
                }
            })

            $('#payment-channel').on('click', function() {
                $('.loading').show();
                if (validateForm2()) {
                    $('.loading').hide();
                }
            })
        })


        function getMetodePembayaran(charge) {
            if (charge != undefined) {
                $.ajax({
                    url: "{{ route('purchase', ['slug' => $brand->slug]) }}",
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        $('.loading').show();
                    },
                    success: function(data) {
                        for (var category in data) {
                            var methods = data[category];
                            methods.forEach(function(method) {
                                var paymentChannel = $('#payment-' + method.id);
                                if (method.min_value > charge) {
                                    paymentChannel.attr('disabled', true);
                                    $('#' + method.id).addClass('text-danger');
                                    $('#infoChannel-' + method.id).removeClass('d-none').text(
                                        'Tidak tersedia untuk nominal ini.');

                                } else {
                                    paymentChannel.attr('disabled', false);
                                    $('#' + method.id).removeClass('text-danger');
                                    $('#infoChannel-' + method.id).addClass('d-none').text('');
                                }
                            });
                        }
                        var formattedHarga = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                        }).format(charge);
                        $('.text-currency').html(formattedHarga)
                        $('.loading').hide();
                        $('html,body').animate({
                            scrollTop: $('#payment-channel').offset().top - 200
                        }, 400);
                    },
                    error: function(data) {
                        console.log(data);
                        $('.loading').hide();
                    },
                })
            }
        }

        function validateForm() {
            var payment = $('input[name="paymenteMethod"]').val();

            var type = '{{ $brand->prepost }}';

            if (type == 'prepaid') {
                if (!$('#email').val()) {
                    showAlertAndFocus('#email', 'Email tidak boleh kosong');
                    return false;
                }
            } else if (type == 'social-media') {
                if (!$('#data_pengguna').val()) {
                    showAlertAndFocus('#data_pengguna', 'Data pengguna tidak boleh kosong');
                    return false;
                }
            } else if (type == 'game-feature') {
                if (!$('#id_pengguna').val()) {
                    showAlertAndFocus('#id_pengguna', 'ID pengguna tidak boleh kosong');
                    return false;
                }

                if (!$('#id_zona').val()) {
                    showAlertAndFocus('#id_zona', 'ID zona tidak boleh kosong');
                    return false;
                }

            }
            return true;
        }

        function validateForm2() {
            var produk = $('input[name="produkId"]:checked').val();

            if (produk == undefined) {
                showAlertAndFocus('#produks', 'Pilih produk terlebih dahulu.');
                $('.method-group-label').removeClass('active');
                $('.method-container').removeClass('active');
                $('.method-group').hide();
                $('.method-angle-down').show();
                $('.method-container').hide();
                $('.form-check-input').prop('checked', false);

                return false;
            }

            return true;
        }

        function showAlertAndFocus(element, message) {
            $('.loading').hide();
            Swal.fire({
                title: 'Error!',
                text: message,
                icon: 'error',
                confirmButtonText: 'OK'
            })
            $('html,body').animate({
                scrollTop: $(element).offset().top - 200
            }, 400);
            $('.form-check-input').prop('checked', false);
            $('.method-group-label').removeClass('active');
            $('.method-container').removeClass('active');
            $('.method-group').hide();
            $('.method-angle-down').show();
            $('.method-container').hide();
            $('.form-check-input').prop('checked', false);
            $(element).focus();
        }
    </script>
@endpush
