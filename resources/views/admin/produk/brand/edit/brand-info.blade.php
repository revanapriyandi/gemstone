<div class="col-lg-8">
    <div class="card  h-100">
        <div class="card-body">
            <h5 class="font-weight-bolder">Brand Information</h5>
            <div class="row">
                <div class="col-12 col-sm-6">
                    <label>Brand</label>
                    <input type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" required
                        autocomplete="current-brand" id="brand" value="{{ $data->name }}" placeholder="Brand Name">
                    @error('brand')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                    <label>Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                        required autocomplete="current-slug" id="slug" value="{{ $data->slug }}" readonly
                        placeholder="Brand Slug">
                    @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label class="mt-4">Company/Publisher</label>
                    <input type="text" class="form-control @error('company') is-invalid @enderror" name="company"
                        required autocomplete="current-company" id="company" value="{{ $data->company }}"
                        placeholder="Brand Company/Publisher">
                    @error('company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-6">
                    <label class="mt-4">Type Brand</label>
                    <select name="brand_type" id="brand_type"
                        class="form-control @error('brand_type') is-invalid @enderror " required
                        autocomplete="current-brand_type">
                        @foreach ($type as $item)
                            <option value="{{ $item->id }}" {{ $data->type_id == $item->id ? 'selected' : '' }}>
                                {{ ucwords($item->name) }}</option>
                        @endforeach
                    </select>
                    @error('brand_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <label class="mt-4">Category</label>
                        <select name="kategori" id="kategori"
                            class="form-control @error('kategori') is-invalid @enderror " required
                            autocomplete="current-kategori">
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}"
                                    {{ $data->kategori_id == $item->id ? 'selected' : '' }}>
                                    {{ ucwords($item->name) }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="mt-4">Description</label>
                <p class="form-text text-muted text-xs ms-1 d-inline">
                    (optional)
                </p>
                <textarea name="description" id="description" cols="10" rows="5">
                    {{ $data->description }}
                </textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-sm-12">
                <label class="mt-4">Description Field</label>
                <p class="form-text text-muted text-xs ms-1 d-inline">
                    (optional)
                </p>
                <textarea name="deskripsi_field" id="deskripsi_field" cols="10" rows="5">
                    {{ $data->deskripsi_field }}
                </textarea>
                @error('deskripsi_field')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-sm-12">
                <label class="mt-4">Cara Topup</label>
                <p class="form-text text-muted text-xs ms-1 d-inline">
                    (optional)
                </p>
                <textarea name="cara_topup" id="cara_topup" cols="10" rows="5">
                    {{ $data->cara_topup }}
                </textarea>
                @error('cara_topup')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#brand').on('keyup', function() {
                var slug = $(this).val().toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                $('#slug').val(slug);
            });

            if (document.getElementById('description')) {
                $('#description').summernote({
                    placeholder: 'Description ...',
                    tabsize: 2,
                    height: 100,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                    ]
                });
            };

            if (document.getElementById('deskripsi_field')) {
                $('#deskripsi_field').summernote({
                    placeholder: 'Deskripsi Field ...',
                    tabsize: 2,
                    height: 100,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                    ]
                })
            };
            if (document.getElementById('cara_topup')) {
                $('#cara_topup').summernote({
                    placeholder: 'Cara Topup ...',
                    tabsize: 2,
                    height: 100,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                    ]
                })

            };

            new Choices('#brand_type', {
                searchEnabled: false,
            });

            new Choices('#kategori', {
                position: 'auto',
            });
        });
    </script>
@endpush
