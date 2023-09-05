<div class="modal fade" id="modal-server" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Tambah Game Server</h5>
                <i class="fas fa-server ms-3" aria-hidden="true"></i>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formModal">
                    @csrf
                    <input type="text" class="d-none" name="id" id="id" value="">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6 col-sm-6">
                                <label>Kode Server</label>
                                <input type="text" class="form-control" name="kode" required
                                    autocomplete="current-kode" id="kode" placeholder="Kode Server">
                                <span class="invalid-feedback d-none kode-error" role="alert">
                                </span>
                            </div>
                            <div class="col-6 col-sm-6">
                                <label>Server</label>
                                <input type="text" class="form-control " name="name" required
                                    autocomplete="current-server" id="name" placeholder="Server">
                                <span class="invalid-feedback d-none server-error" role="alert">
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-gradient-dark btn-sm" id="modalButton">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#modalButton').on('click', function() {
                $('#modalButton').find('.spinner-border').removeClass('d-none');

                $.ajax({
                    url: "{{ route('brand.server.store', $data->id) }}",
                    type: "POST",
                    data: $('#formModal').serialize(),
                    beforeSend: function() {
                        $('#modalButton').find('.spinner-border').removeClass('d-none');
                        $('.kode-error').addClass('d-none').text('');
                        $('.server-error').addClass('d-none').text('');
                    },
                    success: function(data) {
                        $('#modal-server').modal('hide');
                        flasher.success(data.message);
                        window.location.reload();
                    },
                    error: (xhr, status, error) => {
                        let err = JSON.parse(xhr.responseText);
                        $('#modalButton').find('.spinner-border').addClass('d-none');
                        if (err.errors.kode) {
                            $('#kode').addClass('is-invalid');
                            $('.kode-error').removeClass('d-none');
                            $('.kode-error').text(err.errors.kode);
                        }
                        if (err.errors.server) {
                            $('#server').addClass('is-invalid');
                            $('.server-error').removeClass('d-none');
                            $('.server-error').text(err.errors.server);
                        }
                        flasher.error(err.message);
                    }
                });
            });
        });
    </script>
@endpush
