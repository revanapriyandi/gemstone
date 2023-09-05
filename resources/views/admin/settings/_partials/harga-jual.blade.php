<div class="tab-pane fade {{ request()->x == 'harga-jual' ? 'show active' : 'd-none' }}" id="harga-jual-tab"
    role="tabpanel" aria-labelledby="harga-jual-tab">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-0">Harga Jual</h6>
            <hr>

            <div class="row">
                <div class="col-lg-5 col-12">
                    <h6 class="mb-0">Markup Harga</h6>
                    <p class="text-sm">
                        Set markup harga untuk produk yang dijual
                    </p>
                    <div class="border-dashed border-1 border-secondary border-radius-md p-3">
                        <p class="text-xs mb-2">Markup harga di dapat dari rumus <code>Harga Produk + (Harga Produk
                                * Markup Harga / 100)</code>
                        </p>

                        <div class="d-flex align-items-center">
                            <div class="form-group w-70">
                                <div class="input-group bg-gray-200">
                                    <input class="form-control form-control-sm "
                                        value="{{ old('markup_harga') ?? $data->markup_harga }}" type="number"
                                        name="markup_harga" placeholder="5" autocomplete="markup_harga"
                                        id="markup_harga">
                                    <span class="input-group-text bg-transparent" data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Ini akan mengubah harga jual untuk semua produk/layanan yang ada di toko anda."><i
                                            class="fa fa-percentage"></i></span>
                                    <span class="invalid-feedback text-xs d-none" id="markup_harga_error"
                                        role="alert">
                                    </span>
                                </div>
                            </div>
                            <a href="javascript:;" id="save-markup-harga"
                                class="btn btn-sm btn-outline-secondary ms-2 px-3">Save</a>
                        </div>
                        <p class="text-xs mb-1">Harga jual yang diubah akan berlaku untuk semua produk/layanan yang ada
                            di toko anda.</p>
                    </div>
                </div>
                <div class="col-lg-7 col-12 mt-4 mt-lg-0">
                    <h6 class="mb-0">Calculator Harga Jual</h6>
                    <p class="text-sm">
                        Hitung harga jual produk yang dijual.
                    </p>
                    <div class="row border-dashed border-1 border-secondary border-radius-md ">
                        <div class="card card-plain text-center">
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga-produk">Harga Produk</label>
                                            <input type="number" id="harga-produk"
                                                class="form-control form-control-sm "
                                                placeholder="Masukkan harga produk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="markup-harga">Markup Harga (%)</label>
                                            <input type="number" id="markup-harga"
                                                class="form-control form-control-sm "
                                                placeholder="Masukkan markup harga">
                                        </div>
                                    </div>
                                </div>
                                <button id="hitung-button" class="btn btn-dark btn-sm">Hitung</button>
                                <div id="harga-jual-alert" class="alert mt-3" style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#save-markup-harga').on('click', function() {
                saveHarga();
            });

            $('#markup_harga').keypress(function(event) {
                if (event.key === "Enter") {
                    saveHarga();
                }
            });

            $('#hitung-button').on('click', function() {
                calculator();
            })

            function calculator() {

                const hitungButton = document.getElementById('hitung-button');
                const hargaProdukInput = document.getElementById('harga-produk');
                const markupHargaInput = document.getElementById('markup-harga');
                const hargaJualAlert = document.getElementById('harga-jual-alert');

                const hargaProduk = parseFloat(hargaProdukInput.value);
                const markupHarga = parseFloat(markupHargaInput.value);

                if (!isNaN(hargaProduk) && !isNaN(markupHarga)) {
                    const hargaJual = hargaProduk + (hargaProduk * markupHarga / 100);
                    const formattedHargaJual = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(hargaJual);

                    hargaJualAlert.innerHTML = `<div class="alert alert-info text-white" role="alert">
                    Harga Jual: ${formattedHargaJual}
                </div>`;
                    hargaJualAlert.style.display = 'block';
                }
            }

            function saveHarga() {
                $.ajax({
                    url: "{{ route('setting.update.harga-jual', 1) }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        markup_harga: $('#markup_harga').val()
                    },
                    beforeSend: function() {
                        $('#save-markup-harga').html('<i class="fa fa-spinner fa-spin"></i>');
                        $('#save-markup-harga').attr('disabled', true);
                        $('#markup_harga').attr('readonly', true);
                        // flasher.info('Sedang Memperbaharui data...', {
                        //     "timeOut": 200000
                        // })
                    },
                    success: function(data) {
                        $('#save-markup-harga').attr('disabled', false);
                        $('#save-markup-harga').html('Save');
                        $('#markup_harga').attr('readonly', false);
                        flasher.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        $('#save-markup-harga').attr('disabled', false);
                        $('#save-markup-harga').html('Save');
                        $('#markup_harga').attr('readonly', false);
                        var err = JSON.parse(xhr.responseText);
                        flasher.error(err.message)
                        $('#markup_harga_error').text(err.message).removeClass('d-none');
                        $('#markup_harga').addClass('is-invalid');
                    },
                });
            }


        });
    </script>
@endpush
