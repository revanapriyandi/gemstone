<div class="tab-pane fade {{ request()->x == 'social-login' ? 'show active' : 'd-none' }}" id="social-login-tab"
    role="tabpanel" aria-labelledby="social-login-tab">
    <form action="{{ route('setting.update.social', $data->id) }}" method="POST" id="socialForm">
        @csrf
        <div class="card">
            <div class="card-body">
                <h6 class="mb-0"><span class="fa fa-google"></span> Google Setup</h6>
                <div class="alert alert-danger d-none" role="alert">
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-auto col-4">

                    </div>
                    <div class="col-sm-auto col-8 my-auto">

                    </div>
                    <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                        <label class="form-check-label mb-0">
                            <small id="profileVisibility">
                                Aktifkan Login Dengan Google
                            </small>
                        </label>
                        <div class="form-check form-switch ms-2">
                            <input class="form-check-input" type="checkbox" id="google_login_check"
                                {{ $data->google_login ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label mt-4">Google Client Id</label>
                        <div class="input-group">
                            <input id="GOOGLE_CLIENT_ID" name="GOOGLE_CLIENT_ID"
                                class="form-control @error('GOOGLE_CLIENT_ID') is-invalid @enderror" type="text"
                                placeholder="xxxxx.apps.googleusercontent.com"
                                value="{{ old('GOOGLE_CLIENT_ID') ?? $data->GOOGLE_CLIENT_ID }}" required
                                autocomplete="GOOGLE_CLIENT_ID">
                            @error('GOOGLE_CLIENT_ID')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <span class="text-xs">
                            Callback URL: <code>{{ route('google.callback') }}</code>
                        </span>
                    </div>
                    <div class="col-6">
                        <label class="form-label mt-4">Google Client Secret</label>
                        <div class="input-group">
                            <input id="GOOGLE_CLIENT_SECRET" name="GOOGLE_CLIENT_SECRET"
                                class="form-control @error('GOOGLE_CLIENT_SECRET') is-invalid @enderror" type="text"
                                placeholder="GOCxxxxxxx"
                                value="{{ old('GOOGLE_CLIENT_SECRET') ?? $data->GOOGLE_CLIENT_SECRET }}" required
                                autocomplete="GOOGLE_CLIENT_SECRET">
                            @error('GOOGLE_CLIENT_SECRET')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0 btn-submit" type="submit">
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
            $('.btn-submit').on('click', function() {
                $(this).find('.spinner-border').removeClass('d-none');
                $(this).attr('disabled', true);
                $('input').attr('readonly', true);
                $('#socialForm').submit();
            });

            $('#emailForm').on('invalid', function() {
                $('.btn-submit').find('.spinner-border').addClass('d-none');
                $('input').attr('readonly', false);
                $('#socialForm').attr('disabled', false);
            });

            if ($('#google_login_check').is(':checked')) {
                $('#GOOGLE_CLIENT_ID').attr('readonly', false);
                $('#GOOGLE_CLIENT_SECRET').attr('readonly', false);
            } else {
                $('#GOOGLE_CLIENT_ID').attr('readonly', true);
                $('#GOOGLE_CLIENT_SECRET').attr('readonly', true);
            }

            $('#google_login_check').on('change', function() {
                if ($(this).is(':checked')) {
                    $('input').attr('readonly', false);
                } else {
                    $('input').attr('readonly', true);
                }
                $.ajax({
                    url: "{{ route('setting.update.google', $data->id) }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    }

                });

            });

        });
    </script>
@endpush
