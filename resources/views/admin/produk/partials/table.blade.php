<div class="row mt-4">
    <div class="col-12 col-md-12 mb-4">
        <div class="card">
            <div class="card-body text-sm button-sm">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav  nav-fill p-3" role="tablist">
                        @foreach ($typeProduk as $item)
                            <li class="nav-item">
                                <button type="button" class="btn btn-primary mb-2 px-2 py-2 m-2 filter-btn"
                                    data-type="{{ Str::slug($item->name) }}">
                                    {{ ucWords($item->name) }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">

            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">All Products</h5>
                        <p class="text-sm mb-0">
                            This table shows a list of all products in your store
                        </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal"
                                data-bs-target="#harga">+&nbsp; Harga</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body text-sm">
                <div class="table-responsive">
                    <table class="table table-flush display" id="products-list">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="ID adalah identifikasi unik untuk setiap produk.">
                                    ID <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 5%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Kode adalah kode unik untuk mengidentifikasi produk.">
                                    Kode <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 10%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Nama Produk adalah nama unik untuk produk.">
                                    Nama Produk <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Brand adalah merek yang memproduksi produk.">
                                    Brand <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Kategori adalah kategori tempat produk termasuk.">
                                    Kategori <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Price menunjukkan harga dasar produk.">
                                    Price <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Markup Harga adalah selisih antara harga jual dan harga dasar produk.">
                                    Markup Harga <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Harga Jual adalah harga yang ditawarkan kepada pelanggan untuk membeli produk.  dengan rumus harga level + (harga level * markup harga)">
                                    Harga Jual <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Multi TRX menunjukkan apakah produk mendukung transaksi yang dilakukan secara berulang atau multi transaksi.">
                                    Multi TRX <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Updated At menunjukkan kapan produk terakhir kali diperbarui.">
                                    Updated At <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Status menunjukkan apakah produk aktif atau tidak aktif.">
                                    Status <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Maintenance menunjukkan jangka waktu maintenance produk.">
                                    Maintenance <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Prepost menunjukkan status pre atau post produk.">
                                    Prepost <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Note adalah catatan keterangan tambahan tentang produk.">
                                    Note <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="text-sm"></tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="ID adalah identifikasi unik untuk setiap produk.">
                                    ID <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 5%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Kode adalah kode unik untuk mengidentifikasi produk.">
                                    Kode <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 10%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Nama Produk adalah nama unik untuk produk.">
                                    Nama Produk <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Brand adalah merek yang memproduksi produk.">
                                    Brand <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Kategori adalah kategori tempat produk termasuk.">
                                    Kategori <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Price menunjukkan harga dasar produk.">
                                    Price <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Markup Harga adalah selisih antara harga jual dan harga dasar produk.">
                                    Markup Harga <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Harga Jual adalah harga yang ditawarkan kepada pelanggan untuk membeli produk.  dengan rumus harga level + (harga level * markup harga)">
                                    Harga Jual <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Multi TRX menunjukkan apakah produk mendukung transaksi yang dilakukan secara berulang atau multi transaksi.">
                                    Multi TRX <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Updated At menunjukkan kapan produk terakhir kali diperbarui.">
                                    Updated At <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Status menunjukkan apakah produk aktif atau tidak aktif.">
                                    Status <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Maintenance menunjukkan jangka waktu maintenance produk.">
                                    Maintenance <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Prepost menunjukkan status pre atau post produk.">
                                    Prepost <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip"
                                    title="Note adalah catatan keterangan tambahan tentang produk.">
                                    Note <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Actions
                                </th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            var route = "{{ route('fetch-produk') }}";
            var table = $('#products-list').DataTable({
                dom: "Bfrtip",
                responsive: true,
                processing: true,
                serverSide: true,
                scrollCollapse: true,
                lengthMenu: [
                    [15, 30, 50, -1],
                    [15, 30, 50, "All"],
                ],
                autoWidth: true,
                cache: true,
                deferRender: true,
                ajax: {
                    url: route,
                    data: function(data) {
                        var selectedType = $('.filter-btn.active').data('type');
                        data.type = selectedType;
                    },
                    beforeSend: function() {
                        // Show loading spinner while data is loading
                        $('#products-list').addClass('loading');

                    },
                    complete: function() {
                        // Hide loading spinner when data loading is complete
                        $('#products-list').removeClass('loading');
                        $('.filter-btn').prop('disabled', false);
                        $('.filter-btn').removeClass('loading');
                        // flasher.clear();
                        // flasher.success('Data Produk Berhasil Dimuat!', {
                        //     "timeOut": 1000
                        // })
                    }
                },
                columns: [{
                        data: "id"
                    },
                    {
                        data: "kode"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "brand"
                    },
                    {
                        data: "kategori"
                    },
                    {
                        data: "harga"
                    },
                    {
                        data: "markup_harga"
                    },
                    {
                        data: "harga_jual"
                    },
                    {
                        data: "multi_trx"
                    },
                    {
                        data: "updated_at"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "maintenance"
                    },
                    {
                        data: "prepost"
                    },
                    {
                        data: "note"
                    },
                    {
                        data: "actions",
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            // setInterval(() => {
            //     table.ajax.reload(null, false);
            //     flasher.info('Data Produk Berhasil Diperbaharui!')
            // }, 20000);

            $('.filter-btn').on('click', function() {
                $('.filter-btn').removeClass('active');
                $(this).addClass('active').addClass('loading');

                $('.filter-btn').prop('disabled', true);

                table.ajax.reload(null, false);
            });

            $('#harga').on('shown.bs.modal', function() {
                $('#markup_harga').focus();

                $.ajax({
                    url: "{{ route('setting') }}",
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#markup_harga_sekarang').val(data.markup_harga);
                    }
                });
            });

        });
    </script>
@endpush
@push('modal')
    @include('admin.produk.partials._modal')
@endpush
<style>
    .filter-btn.loading {
        position: relative;
    }

    .filter-btn.loading:before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 1em;
        height: 1em;
        border: 2px solid #333;
        border-top: 2px solid transparent;
        border-radius: 50%;
        animation: spin 0.5s linear infinite;
    }
</style>
