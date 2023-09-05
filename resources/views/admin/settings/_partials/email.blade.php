<div class="tab-pane fade {{ request()->x == 'email' ? 'show active' : 'd-none' }}" id="email-tab" role="tabpanel"
    aria-labelledby="email-tab">
    <form action="{{ route('setting.update.email', $data->id) }}" method="POST" id="emailForm">
        @csrf
        <div class="card">
            <div class="card-body">
                <h6 class="mb-0">Email Settings</h6>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label mt-4">Mail Host</label>
                        <div class="input-group">
                            <input id="MAIL_HOST" name="MAIL_HOST"
                                class="form-control @error('MAIL_HOST') is-invalid @enderror" type="text"
                                placeholder="smtp.gmail.com" value="{{ old('MAIL_HOST') ?? $data->MAIL_HOST }}"
                                required="required" autocomplete="MAIL_HOST">
                            @error('MAIL_HOST')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label mt-4">Mail Port</label>
                        <div class="input-group">
                            <input id="MAIL_PORT" name="MAIL_PORT"
                                class="form-control @error('MAIL_PORT') is-invalid @enderror" type="number"
                                placeholder="587" value="{{ old('MAIL_PORT') ?? $data->MAIL_PORT }}" required="required"
                                autocomplete="MAIL_PORT">
                            @error('MAIL_PORT')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label mt-4">Mail Username</label>
                        <div class="input-group">
                            <input id="MAIL_USERNAME" name="MAIL_USERNAME"
                                class="form-control @error('MAIL_USERNAME') is-invalid @enderror" type="text"
                                placeholder="support@gemstone.com"
                                value="{{ old('MAIL_USERNAME') ?? $data->MAIL_USERNAME }}" required="required"
                                autocomplete="MAIL_USERNAME">
                            @error('MAIL_USERNAME')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label mt-4">Mail Password</label>
                        <div class="input-group">
                            <input id="MAIL_PASSWORD" name="MAIL_PASSWORD"
                                class="form-control @error('MAIL_PASSWORD') is-invalid @enderror" type="password"
                                placeholder="Enter your mail password"
                                value="{{ old('MAIL_PASSWORD') ?? $data->MAIL_PASSWORD }}" required="required"
                                autocomplete="MAIL_PASSWORD">
                            @error('MAIL_PASSWORD')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label class="form-label mt-4">Mail From Name</label>
                        <div class="input-group">
                            <input id="MAIL_FROM_NAME" name="MAIL_FROM_NAME"
                                class="form-control @error('MAIL_FROM_NAME') is-invalid @enderror" type="text"
                                placeholder="support@gemstone.com"
                                value="{{ old('MAIL_FROM_NAME') ?? $data->MAIL_FROM_NAME }}" required="required"
                                autocomplete="MAIL_FROM_NAME">
                            @error('MAIL_FROM_NAME')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label mt-4">Mail From Address</label>
                        <div class="input-group">
                            <input id="MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS"
                                class="form-control @error('MAIL_FROM_ADDRESS') is-invalid @enderror" type="text"
                                placeholder="support@gemstone.com"
                                value="{{ old('MAIL_FROM_ADDRESS') ?? $data->MAIL_FROM_ADDRESS }}" required="required"
                                autocomplete="MAIL_FROM_ADDRESS">
                            @error('MAIL_FROM_ADDRESS')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label mt-4">Mail Encryption</label>
                        <select name="MAIL_ENCRYPTION" id="choices-encryption"
                            class="form-control @error('MAIL_ENCRYPTION') is-invalid @enderror">
                            <option value="tls"
                                {{ (old('MAIL_ENCRYPTION') ?? $data->MAIL_ENCRYPTION) == 'tls' ? 'selected' : '' }}>
                                TLS
                            </option>
                            <option value="ssl"
                                {{ (old('MAIL_ENCRYPTION') ?? $data->MAIL_ENCRYPTION) == 'ssl' ? 'selected' : '' }}>
                                SSL
                            </option>
                        </select>

                        @error('MAIL_ENCRYPTION')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0  ml-3" type="submit"
                    id="submit-email">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <span class="btn-text">
                        <span class="fa fa-save"></span> Save Changes</span>
                </button>
                <button type="button" class="btn bg-gradient-info btn-sm float-start mt-6 mb-0 btn-test"
                    data-bs-toggle="modal" data-bs-target="#testmailModal">
                    <span class="fa fa-paper-plane"></span> Test Mail
                </button>
            </div>

        </div>
    </form>
</div>
@push('modal')
    <div class="modal fade" id="testmailModal" tabindex="-1" role="dialog" aria-labelledby="testmail"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testmail">Test Mail</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="emailtest" name="emailtest" class="form-control " type="text"
                                placeholder="email" required="required" autocomplete="emailtest">
                            <span class="invalid-feedback d-none" role="alert" id="emailtest-error">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn bg-gradient-info  mb-0 btn-test" id="test-email-button" type="button">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="btn-text">
                            <span class="fa fa-paper-plane"></span> Send Test Email</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#submit-email').on('click', function() {
                $(this).find('.spinner-border').removeClass('d-none');
                $(this).attr('disabled', true);
                $('input').attr('readonly', true);
                $('#emailForm').submit();
            });

            $('#emailForm').on('invalid', function() {
                $('#submit-email').find('.spinner-border').addClass('d-none');
                $('input').attr('readonly', false);
                $('#submit-email').attr('disabled', false);
            });

            $('#test-email-button').on('click', function() {
                $(this).find('.spinner-border').removeClass('d-none');
                $(this).attr('disabled', true);
                $('input').attr('readonly', true);
                $.ajax({
                    url: "{{ route('setting.email.test') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: $('#emailtest').val(),
                    },
                    success: function(data) {
                        $('#test-email-button').find('.spinner-border').addClass('d-none');
                        $('input').attr('readonly', false);
                        $('#test-email-button').attr('disabled', false);
                        flasher.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        $('#test-email-button').find('.spinner-border').addClass('d-none');
                        $('input').attr('readonly', false);
                        $('#test-email-button').attr('disabled', false);
                        var err = JSON.parse(xhr.responseText);
                        flasher.error(err.message)
                        $('#emailtest-error').text(err.message).removeClass('d-none');
                        $('#emailtest').addClass('is-invalid');
                    },
                    complete: function() {
                        $('#emailtest').val('');
                        $('#emailtest-error').addClass('d-none');
                        $('#emailtest').removeClass('is-invalid');
                        $('#testmailModal').modal('hide');
                    }
                });
            });

        });

        if (document.getElementById('choices-encryption')) {
            var encription = document.getElementById('choices-encryption');
            new Choices(encription, {
                searchEnabled: false,
                itemSelectText: '',

            });
        }
    </script>
@endpush
