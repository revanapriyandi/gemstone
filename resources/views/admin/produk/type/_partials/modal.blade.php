<div class="modal fade" id="uploadLogoModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data" id="formLogoType">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Upload Logo Type</h5>
                    <i class="fas fa-upload ms-3" aria-hidden="true"></i>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="d-none" name="id" id="id" value="">
                    <div class="form-group">
                        <label for="logo" data-bs-toggle="tooltip" title="Logo Type">Logo <span
                                class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('logo') is-invalid @enderror"
                            class="form-control mb-3" id="logo" name="logo">
                        <img id="logoPreview" src="#" alt="Preview"
                            style="max-width: 100%; max-height: 200px; margin-top: 10px; display: none;">

                        <span class="invalid-feedback d-none" role="alert" id="logoError">
                        </span>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary btn-sm"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary btn-sm" id="uploadButton">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#logo').change(function() {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#logoPreview').attr('src', e.target.result).show();
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#logoPreview').hide();
                }
            });

            $('#formLogoType').submit(function(e) {
                e.preventDefault();
                $('#uploadButton').attr('disabled', true);
                $('.spinner-border').removeClass('d-none');

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('type.update.logo', ['id' => 'idd']) }}".replace('idd', $('#id')
                        .val()),
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('.spinner-border').addClass('d-none');
                        $('#uploadButton').attr('disabled', false);
                        $('#uploadLogoModal').modal('hide');
                        flasher.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        $('.spinner-border').addClass('d-none');
                        $('#uploadButton').attr('disabled', false);
                        var err = JSON.parse(xhr.responseText);
                        flasher.error(err.message)
                        $('#logoError').text(err.message).removeClass('d-none');
                        $('#logo').addClass('is-invalid');
                    },
                    complete: function() {
                        $('.spinner-border').addClass('d-none');
                        $('#uploadButton').attr('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
