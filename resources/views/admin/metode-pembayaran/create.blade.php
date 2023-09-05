@extends('layouts.admin')

@section('content')
    <form action="{{ route('metode-pembayaran.store') }}" method="POST" enctype="multipart/form-data" id="createMetodeBayar">
        <div class="row mt-4">
            @csrf
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="font-weight-bolder"> Image</h5>
                        <div class="row">
                            <div class="col-12">
                                <img class="w-100 border-radius-lg shadow-lg mt-3 d-none" src="" alt=""
                                    alt="preview_image" id="preview_image">
                            </div>
                            <div class="col-12 mt-4">
                                <div class="d-flex">
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        name="logo" required autocomplete="current-logo" id="logo"
                                        onchange="previewImage()">

                                    @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Metode Pembayaran Information</h5>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" required autocomplete="current-name" id="name" autofocus
                                    value="{{ old('name') }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                <label>Kode</label>
                                <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                    name="kode" required autocomplete="current-kode" id="kode"
                                    value="{{ old('kode') }}">

                                @error('kode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mt-4">Type Pembayaran</label>
                                <select name="type" id="type"
                                    class="form-control @error('type') is-invalid @enderror" required>
                                    @foreach ($paymentMethods as $value => $label)
                                        <option value="{{ $value }}" {{ old('type') === $value ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="mt-4">Keterangan</label>
                                <select name="keterangan" id="keterangan"
                                    class="form-control @error('keterangan') is-invalid @enderror" required>
                                    <option value="manual" {{ old('keterangan') === 'manual' ? 'selected' : '' }}>
                                        Manual</option>
                                    <option value="otomatis" {{ old('keterangan') === 'otomatis' ? 'selected' : '' }}>
                                        Otomatis</option>
                                </select>

                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mt-4">Kategori Pembayaran</label>
                                <select name="category" id="category"
                                    class="form-control @error('category') is-invalid @enderror" required>
                                    <option value="bank_transfer" {{ old('category') === 'bank_transfer' ? 'selected' : '' }}>
                                        Bank Transfer</option>
                                    <option value="e_wallet" {{ old('category') === 'e_wallet' ? 'selected' : '' }}>
                                        E-Wallet</option>
                                    <option value="over_the_counter"
                                        {{ old('category') === 'over_the_counter' ? 'selected' : '' }}>
                                        Over The Counter</option>
                                    <option value="credit_card" {{ old('category') === 'credit_card' ? 'selected' : '' }}>
                                        Credit Card</option>
                                    <option value="direct_debit" {{ old('category') === 'direct_debit' ? 'selected' : '' }}>
                                        Direct Card</option>
                                </select>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="mt-4">Minimal Charge</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="min_charge">IDR</span>
                                    </div>
                                    <input type="text" class="form-control  @error('min_charge') is-invalid @enderror" placeholder="Min Charge" aria-label="Min Charge" aria-describedby="min_charge"   name="min_charge" value="{{ old('min_value') }}" required>
                                  </div>

                                @error('min_charge')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="mt-4">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox"
                                        id="status" checked="" name="status" {{ old('status') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">
                                        <span class="text-sm">Aktif</span>
                                    </label>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn bg-gradient-dark btn-sm" id="simpan">
                                <span class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                                Create Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function previewImage() {
            var imageInput = document.getElementById('logo');
            var imagePreview = document.getElementById('preview_image');

            if (imageInput.files && imageInput.files[0]) {
                $('#preview_image').removeClass('d-none')
                var reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                }

                reader.readAsDataURL(imageInput.files[0]);
            }
        }
        $(document).ready(function() {
            $('#simpan').on('click', function() {
                $(this).find('.spinner-border').removeClass('d-none');
                $(this).prop('disabled', true);
                $('#createMetodeBayar').submit();
            });
            new Choices('#type', {
                searchEnabled: true,
            });

            new Choices('#keterangan', {
                searchEnabled: false,
            });
        });
    </script>
@endpush
