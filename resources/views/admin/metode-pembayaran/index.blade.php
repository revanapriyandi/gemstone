@extends('layouts.admin')

@section('content')
    <div class="row  text-white">
        <div class="col-lg-6">
            <h4 class="text-white">Metode Pembayaran</h4>
            <p>
                Metode Pembayaran yang tersedia di website ini.
            </p>
        </div>
        <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
            <a href="{{ route('metode-pembayaran.create') }}"
                class="btn bg-gradient-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">
                <span class="fa fa-plus"></span> Tambahkan</a>
        </div>
    </div>
    @include('admin.metode-pembayaran._partials.table')
@endsection
