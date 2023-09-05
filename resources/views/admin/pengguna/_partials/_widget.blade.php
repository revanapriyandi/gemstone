<div class="row">
    <div class="col-lg-6 col-12">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card overflow-hidden shadow-lg animated-fade-in"
                    style="background-image: url('https://i.pinimg.com/564x/91/d7/fb/91d7fb01a2c4ad831a07c147d8138237.jpg');background-size: cover;">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-8 text-start">
                                <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                    <i class="fa fa-bars text-dark text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                                <h5 class="text-white font-weight-bolder mb-0 mt-3 animated-number"
                                    data-target="{{ $totalProduk }}">
                                    0
                                </h5>
                                <span class="text-white text-sm">Semua Produk</span>
                            </div>
                            <div class="col-4">
                                {{-- Tidak ada data persentase di sini --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                <div class="card overflow-hidden shadow-lg animated-fade-in"
                    style="background-image: url('https://i.pinimg.com/564x/91/d7/fb/91d7fb01a2c4ad831a07c147d8138237.jpg');background-size: cover;">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-8 text-start">
                                <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                    <i class="fa fa-toggle-on text-dark text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                                <h5 class="text-white font-weight-bolder mb-0 mt-3 animated-number"
                                    data-target="{{ $activeProdukCount }}">
                                    0
                                </h5>
                                <span class="text-white text-sm">Produk Active</span>
                            </div>
                            <div class="col-4">
                                <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">
                                    +{{ number_format($percentageActive, 2) }}%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card overflow-hidden shadow-lg animated-fade-in"
                    style="background-image: url('https://i.pinimg.com/564x/91/d7/fb/91d7fb01a2c4ad831a07c147d8138237.jpg');background-size: cover;">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-8 text-start">
                                <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                    <i class="fa fa-toggle-off text-dark text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                                <h5 class="text-white font-weight-bolder mb-0 mt-3 animated-number"
                                    data-target="{{ $inactiveProdukCount }}">
                                    0
                                </h5>
                                <span class="text-white text-sm">Produk InActive</span>
                            </div>
                            <div class="col-4">
                                <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">
                                    +{{ number_format($percentageInactive, 2) }}%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                <div class="card overflow-hidden shadow-lg animated-fade-in"
                    style="background-image: url('https://i.pinimg.com/564x/91/d7/fb/91d7fb01a2c4ad831a07c147d8138237.jpg');background-size: cover;">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-8 text-start">
                                <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                    <i class="ni ni-like-2 text-dark text-gradient text-lg opacity-10"
                                        aria-hidden="true"></i>
                                </div>
                                <h5 class="text-white font-weight-bolder mb-0 mt-3 animated-number"
                                    data-target="{{ $soldProdukCount }}">
                                    0
                                </h5>
                                <span class="text-white text-sm">Produk Terjual</span>
                            </div>
                            <div class="col-4">
                                <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">
                                    +{{ number_format($percentageSold, 2) }}%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-6 col-12 mt-4 mt-lg-0">
        <div class="card h-100">
            <div class="card-body pb-0 p-3">
                <canvas id="myChart" class="text-center"></canvas>
            </div>
            <div class="card-footer pt-0 p-3 d-flex align-items-center">
                <div class="w-60">
                    <p class="text-sm">
                        Jumlah Produk yang aktif dan tidak aktif pada setiap bulan pada tahun {{ date('Y') }} di
                        {{ config('app.name') }} adalah sebagai berikut.
                    </p>
                </div>
                <div class="w-40 text-end">
                    <a class="btn bg-gradient-dark mb-0 text-end" href="javascript:;">{{ $totalProduk }} Produk</a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Animasi tampilan angka dengan efek fade-in
        function animateNumber(element, targetNumber) {
            $(element).prop('number', 0).animate({
                number: targetNumber
            }, {
                easing: 'swing',
                duration: 1500,
                step: function(now) {
                    $(element).text(Math.ceil(now)); // Menggunakan Math.ceil untuk menghindari pecahan desimal
                }
            });
        }

        // Fungsi untuk memicu animasi saat elemen tampil di layar
        function lazyLoadAnimations() {
            $('.animated-number').each(function() {
                const targetNumber = parseInt($(this).attr('data-target'));
                animateNumber(this, targetNumber);
            });
        }

        // Menjalankan animasi saat laman selesai dimuat
        $(document).ready(function() {
            lazyLoadAnimations();

            const ctx = document.getElementById('myChart');
            const chartData = {!! json_encode($chartData) !!};

            new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
    </script>
@endpush

<style>
    .animated-fade-in {
        opacity: 0;
        animation: fade-in 1.5s ease-in-out forwards;
    }

    @keyframes fade-in {
        to {
            opacity: 1;
        }
    }
</style>
