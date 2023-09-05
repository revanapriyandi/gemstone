<div class="modal fade" id="editKategori" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"></h5>
                    <i class="fas fa-edit ms-3" aria-hidden="true"></i>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="d-none" name="id" id="id" value="">
                    <div class="form-group">
                        <label for="name" data-bs-toggle="tooltip" title="Kategori Name">Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Kategori Name" class="form-control mb-3" id="name" autocomplete="name"
                            autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" data-bs-toggle="tooltip" title="Kategori Deskripsi">Deskripsi </label>
                        <textarea name="deskripsi" id="deskripsi" cols="15" rows="5"
                            class="form-control @error('deskripsi') is-invalid @enderror"></textarea>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                    url: "{{ route('kategori.update', 'idd') }}".replace('idd', $('#id').val()),
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": $('#name').val(),
                        "deskripsi": $('#deskripsi').val(),
                    },
                    beforeSend: function() {
                        $('#simpan').attr('disabled', true);
                        $('input').attr('readonly', true);
                        $('.spinner-border').removeClass('d-none');
                        flasher.info('Sedang Memperbaharui data...', {
                            "timeOut": 200000
                        })
                    },
                    success: function(data) {
                        $('#simpan').attr('disabled', false);
                        $('.spinner-border').addClass('d-none');
                        $('input').attr('readonly', false);
                        $('input').val();
                        $('#editKategori').modal('hide');
                        flasher.success(data.message)
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        var err = JSON.parse(xhr.responseText);
                        $('#simpan').attr('disabled', false);
                        $('#editKategori').modal('show');
                        $('input').attr('readonly', false);
                        $('.spinner-border').addClass('d-none');
                        flasher.error(err.message)
                    }
                });
            });
        });
    </script>
@endpush
