<div class="col-lg-4 mt-lg-0 mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder">Brand Image</h5>
            <div class="row">
                <div class="col-12">
                    <label class="mt-2">Logo Brand</label>
                    <img class="w-100 border-radius-lg shadow-lg mt-3" src="{{ $data->logo_url }}"
                        alt="{{ $data->name }}" id="logoPreview">
                    <input type="file" name="logo" id="logo"
                        class="form-control @error('logo') is-invalid @enderror mt-3" onchange="previewLogo()">
                    <small>
                        <code>
                            Size 200x200px
                        </code>
                    </small>
                    @error('logo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 mt-2">
                    <label class="">Banner Brand</label>
                    <img class="w-100 h-50 border-radius-lg shadow-lg mt-3" src="{{ $data->banner_url }}"
                        alt="{{ $data->name }}" id="bannerPreview">
                    <input type="file" name="banner" id="banner"
                        class="form-control @error('banner') is-invalid @enderror mt-3" onchange="previewBanner()">
                    <small>
                        <code>
                            Size 1280x482px
                        </code>
                    </small>
                    @error('banner')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12 mt-2">
                    <label>Is Featured</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input @error('is_featured') is-invalid @enderror" name="is_featured"
                            type="checkbox" id="is_featured" {{ $data->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Featured</label>
                    </div>
                    @error('is_featured')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label>Status</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input @error('status') is-invalid @enderror" name="status"
                            type="checkbox" id="status" {{ $data->status ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="d-flex">
                <button type="submit" class="btn bg-gradient-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 simpan">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    Simpan</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        function previewBanner() {
            var bannerInput = document.getElementById('banner');
            var bannerPreview = document.getElementById('bannerPreview');

            if (bannerInput.files && bannerInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    bannerPreview.src = e.target.result;
                }

                reader.readAsDataURL(bannerInput.files[0]);
            }
        }

        function previewLogo() {
            var logoInput = document.getElementById('logo');
            var logoPreview = document.getElementById('logoPreview');

            if (logoInput.files && logoInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    logoPreview.src = e.target.result;
                }

                reader.readAsDataURL(logoInput.files[0]);
            }
        }
    </script>
@endpush
