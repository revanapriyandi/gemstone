<div class="modal fade" id="harga" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('update-markup-harga') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Naik/Turun Harga</h5>
                    <i class="fas fa-upload ms-3" aria-hidden="true"></i>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="font-bold">Naikkan dan Turunkan harga jual dengan menambah atau mengurangi markup harga.
                    </p>
                    <p class="text-warning text-sm">Ini akan mengubah harga jual untuk semua produk yang aktif!</p>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="markup_harga_sekarang" data-bs-toggle="tooltip"
                                    title="Markup harga saat ini">Saat Ini <i
                                        class="fas fa-info-circle ml-1"></i></label>
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Markup Harga Saat Ini"
                                        class="form-control mb-3" id="markup_harga_sekarang" readonly>
                                    <span class="input-group-text"><i class="fa fa-percent"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="markup_harga">Markup Harga<span class="text-danger">*</span></label>
                                <div class="input-group mb-4">
                                    <input type="number" class="form-control" placeholder="Markup Harga "
                                        class="form-control mb-3" id="markup_harga" name="markup_harga">
                                    <span class="input-group-text"><i class="fa fa-percent"></i></span>
                                </div>
                            </div>
                        </div>
                        <small class="text-dark">Perhitungan harga jual menggunakan rumus <code>Harga Produk + (Harga
                                Produk * Markup Harga / 100)</code></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary btn-sm"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary btn-sm" id="simpan">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#simpan').on('click', function() {
                $.ajax({
                    url: "{{ route('update-markup-harga') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "markup_harga": $('#markup_harga').val()
                    },
                    beforeSend: function() {
                        $('#simpan').attr('disabled', true);
                        $('#markup_harga').attr('readonly', true);
                        $('.spinner-border').removeClass('d-none');
                        flasher.info('Sedang Memperbaharui Harga Jual...', {
                            "timeOut": 200000
                        })
                    },
                    success: function(data) {
                        $('#simpan').attr('disabled', false);
                        $('.spinner-border').addClass('d-none');
                        $('#markup_harga').attr('readonly', false);
                        $('#markup_harga').val();
                        $('#harga').modal('hide');
                        flasher.success(data.message, 'Success!')
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        var err = JSON.parse(xhr.responseText);
                        $('#simpan').attr('disabled', false);
                        $('#harga').modal('show');
                        $('#markup_harga').attr('readonly', false);
                        $('.spinner-border').addClass('d-none');
                        flasher.error(err.message, 'Error!')
                    }
                });
            });
        });
    </script>
@endpush
