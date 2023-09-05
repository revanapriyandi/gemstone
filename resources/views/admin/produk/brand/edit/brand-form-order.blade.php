<div class="col-sm-12 mt-sm-0 mt-4">
    <form action="{{ route('brand.form-order', $data->id) }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bolder">Form Order</h5>
                <div class="col-md-12">
                    <label class="mt-4">Form Order</label>
                    <select name="form_order" id="form_order"
                        class="form-control @error('form_order') is-invalid @enderror " required
                        autocomplete="current-company">
                        <option value="" disabled selected>Select Form Order</option>
                        <option value="0" {{ $data->form_order == '0' ? 'selected' : '' }}> 1 Target (Data Tujuan)
                        </option>
                        <option value="1" {{ $data->form_order == '1' ? 'selected' : '' }}> 1 Target (Phone Number)
                        </option>
                        <option value="2" {{ $data->form_order == '2' ? 'selected' : '' }}> 2 Target (ID Player +
                            Zone ID)
                        </option>
                    </select>
                    @error('form_order')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{-- <div class="row">
                    <div class="col-md-6" id="form_order_1">
                        <label class="mt-4">Custom Field</label>
                        <input type="text" class="form-control @error('custom_field') is-invalid @enderror"
                            name="custom_field" autocomplete="current-custom_field" id="custom_field"
                            value="{{ $data->custom_field ?? old('custom_field') }}" placeholder="Custom Field">
                        @error('custom_field')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6" id="form_order_2">
                        <label class="mt-4">Custom Field 2</label>
                        <input type="text" class="form-control @error('custom_field2') is-invalid @enderror"
                            name="custom_field2" autocomplete="current-custom_field2" id="custom_field2"
                            value="{{ $data->custom_field2 ?? old('custom_field2') }}" placeholder="Custom Field 2">
                        @error('custom_field2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div> --}}

                <div class="row mt-3">
                    <div class="col-6">
                        <label for="game_server">Game Server <span class="fa fa-info-circle" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Apakah memiliki game server..?"></span></label>
                        <div class="form-check form-switch ">
                            <input class="form-check-input @error('game_server') is-invalid @enderror"
                                name="game_server" type="checkbox" id="game_server"
                                {{ $data->game_server ? 'checked' : '' }}>
                            <label class="form-check-label" for="game_server">Active</label>
                        </div>
                        @error('game_server')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-6">
                        <label for="cek_id">Validasi ID <span class="fa fa-info-circle" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Cek data sebelum transaksi..., #note cek ketersediaan api di documentasi."></span></label>
                        <div class="form-check form-switch ">
                            <input class="form-check-input @error('cek_id') is-invalid @enderror" name="cek_id"
                                type="checkbox" id="cek_id" {{ $data->cek_id ? 'checked' : '' }}>
                            <label class="form-check-label" for="cek_id">Active</label>
                        </div>
                        @error('cek_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer text-muted">
                <div class="d-flex">
                    <button type="submit"
                        class="btn bg-gradient-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 save-form-order">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // $('#form_order').on('change', function() {
            //     var form_order = $(this).val();
            //     if (form_order == '1') {
            //         $('#form_order_1').removeClass('d-none');
            //         $('#form_order_2').addClass('d-none');
            //         $('#custom_field2').val('');
            //     } else if (form_order == '2') {
            //         $('#form_order_1').removeClass('d-none');
            //         $('#form_order_2').removeClass('d-none');
            //     }
            // });

            $('.save-form-order').on('click', function() {
                $(this).find('.spinner-border').removeClass('d-none')
            });

            // $('#form_order').trigger('change');

            $('#game_server').on('change', function() {
                var game_server = $(this).val();
                $.ajax({
                    url: "{{ route('brand.game-server', $data->id) }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        flasher.success(data.message);
                        window.location.reload();
                    },
                    error: (xhr, status, error) => {
                        flasher.error(error);
                    }
                });
            });

            $('#cek_id').on('change', function() {
                var cek_id = $(this).val();
                $.ajax({
                    url: "{{ route('brand.cekId', $data->id) }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        flasher.success(data.message);
                        window.location.reload();
                    },
                    error: (xhr, status, error) => {
                        flasher.error(error);
                    }
                });
            });
        });
    </script>
@endpush
