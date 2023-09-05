<div class="col-sm-4">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder">Status</h5>
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
                <input class="form-check-input @error('status') is-invalid @enderror" name="status" type="checkbox"
                    id="status" {{ $data->status ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Active</label>
            </div>
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
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
