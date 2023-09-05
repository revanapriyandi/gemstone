<div class="tab-pane fade {{ request()->x == 'general' || !request()->x ? 'show active' : 'd-none' }}" id="general-tab"
    role="tabpanel" aria-labelledby="general-tab">
    <form action="{{ route('setting.update', $data->id) }}" method="POST" enctype="multipart/form-data" id="form_basics">
        @csrf
        <div class="card" id="general-info">
            <div class="card-header">
                <h5>Basic Info</h5>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">App Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="app_name" name="app_name"
                                class="form-control @error('app_name') is-invalid @enderror" type="text"
                                placeholder="App Name" value="{{ old('app_name') ?? $data->app_name }}"
                                required="required" autocomplete="app_name">
                            @error('app_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label">App Slogan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="app_slogan" name="app_slogan"
                                class="form-control @error('app_slogan') is-invalid @enderror" type="text"
                                placeholder="App Slogan" required="required"
                                value="{{ old('app_slogan') ?? $data->app_slogan }}" autocomplete="app_slogan">
                            @error('app_slogan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label class="form-label">App Url <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="app_url" name="app_url"
                                class="form-control @error('app_url') is-invalid @enderror" type="text"
                                placeholder="https://" required="required"
                                value="{{ old('app_url') ?? $data->app_url }}" autocomplete="app_url">
                            @error('app_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Footer Text <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="footer_text" name="footer_text"
                                class="form-control @error('footer_text') is-invalid @enderror" type="text"
                                placeholder="@2020 -- ---" required="required"
                                value="{{ old('footer_text') ?? $data->footer_text }}" autocomplete="footer_text">
                            @error('footer_text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">App Detail </label>
                    <div class="input-group">
                        <textarea id="app_detail" name="app_detail" class="form-control @error('app_detail') is-invalid @enderror"
                            autocomplete="app_detail" cols="15" rows="5" placeholder="Detail app">{{ old('app_detail') ?? $data->app_detail }}</textarea>
                        @error('app_detail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Logo </label>
                        <div class="input-group">
                            <input id="logo" name="logo"
                                class="form-control @error('logo') is-invalid @enderror" type="file"
                                autocomplete="logo" accept="image/*" onchange="previewImage('logo', 'logo-preview')">
                            @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <img id="logo-preview" src="" alt="Logo Preview"
                                style="max-width: 100px; max-height: 100px; display: none;">
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Favicon </label>
                        <div class="input-group">
                            <input id="favicon" name="favicon"
                                class="form-control @error('favicon') is-invalid @enderror" type="file"
                                autocomplete="favicon" accept=".ico"
                                onchange="previewImage('favicon', 'favicon-preview')">
                            @error('favicon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <img id="favicon-preview" src="" alt="Favicon Preview"
                                style="max-width: 150px; max-height: 100px; display: none;">
                        </div>
                    </div>
                    <p class="text-danger text-xs">* Max file size 2MB</p>
                    <p class="text-info text-xs">* Kosongkan jika tidak ingin mengubah logo atau favicon</p>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="phone" name="phone"
                                class="form-control @error('phone') is-invalid @enderror" type="text"
                                placeholder="628****" required="required" value="{{ old('phone') ?? $data->phone }}"
                                autocomplete="phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Email Address <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" type="email"
                                placeholder="support@domain.com" required="required"
                                value="{{ old('email') ?? $data->email }}" autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">Office Address </label>
                    <div class="input-group">
                        <textarea id="office_address" name="office_address"
                            class="form-control @error('office_address') is-invalid @enderror" required="required"
                            autocomplete="office_address" cols="15" rows="5" placeholder="Jl. *** no **">{{ old('office_address') ?? $data->office_address }}</textarea>
                        @error('office_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0"" type="submit" id="btnSubmit">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {

            function previewImage(inputId, previewId) {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);

                const file = input.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '';
                    preview.style.display = 'none';
                }
            }

            $('#btnSubmit').on('click', function() {
                $(this).find('.spinner-border').removeClass('d-none');
                $(this).attr('disabled', true);
                $('#form_basics').submit();
            });

            $('#form_basics').on('invalid', function() {
                $('#btnSubmit').find('.spinner-border').addClass('d-none');
                $('#btnSubmit').attr('disabled', false);
            });
        });
    </script>
@endpush
