@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ $data->name }}</h4>
            <p>
                <span
                    class="badge bg-gradient-{{ $data->status ? 'success' : 'danger' }}">{{ $data->status ? 'Active' : 'Non Active' }}</span>
            </p>
        </div>
        <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
            <div class="d-flex">
                <button type="submit" class="btn bg-gradient-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 simpan"
                    id="navSimpan">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    Simpan</button>
            </div>
        </div>
    </div>
    <div class="nav-wrapper position-relative end-0">
        <ul class="nav nav-pills nav-fill p-1" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#brand-info" role="tab"
                    aria-controls="preview" aria-selected="true" id="brand-info-btn">
                    <i class="ni ni-badge text-sm me-2"></i> Brand Info
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#form-order" role="tab"
                    aria-controls="code" aria-selected="false" id="form-order-btn">
                    <i class="ni ni-laptop text-sm me-2"></i> Form Order
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="brand-info" role="tabpanel" aria-labelledby="home-tab">
            <form action="{{ route('brand.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                id="formEdit">
                @csrf

                <div class="row mt-4">
                    @include('admin.produk.brand.edit.brand-info')
                    @include('admin.produk.brand.edit.brand-image')

                </div>
                <div class="row mt-4">
                    @include('admin.produk.brand.edit.brand-meta')
                    {{-- @include('admin.produk.brand.edit.brand-status') --}}
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="form-order" role="tabpanel" aria-labelledby="form-order-tab">
            <div class="row mt-4">
                @include('admin.produk.brand.edit.brand-form-order')
                @if ($data->game_server == 1)
                    @include('admin.produk.brand.edit.brand-game-server')
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.simpan').on('click', function() {
                $(this).find('.spinner-border').removeClass('d-none')
                $(this).attr('disabled', true)
                $('#formEdit').submit()
            })

            $('.nav-link').on('click', function() {
                var tab = $(this).attr('href')
                location.hash = tab
            })
            $('#form-order-btn').click(function() {
                $('#navSimpan').addClass('d-none')
            })

            $('#brand-info-btn').click(function() {
                $('#navSimpan').removeClass('d-none')
            })

            if (location.hash) {
                $('a[href="' + location.hash + '"]').tab('show');
            }

        });
    </script>
@endpush
