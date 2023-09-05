<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">
                            Metode Pembayaran
                        </h5>
                        <p class="text-sm mb-0">
                            Tabel ini berisi data metode pembayaran yang tersedia di website.
                        </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">

                    </div>
                </div>
            </div>
            <div class="card-body text-sm">
                <div class="table-responsive">
                    <table class="table table-flush display" id="metode_bayar_list">
                        <thead class="thead-light text-center">
                            <tr>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Column number"># <i
                                        class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Metode Pembayaran Logo">Logo
                                    <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Metode Pembayaran name">Name
                                    <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Metode Pembayaran Status">
                                    Status
                                    <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Metode Pembayaran Keterangan">
                                    Keterangan <i class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Type Metode Pembayaran">
                                    Type <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Min Charge Metode Pembayaran">
                                    Min Charge <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Category Metode Pembayaran">
                                    Category <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Actions">Actions <i
                                        class="fas fa-info-circle ml-1"></i></th>
                            </tr>

                        </thead>
                        <tbody class="text-sm text-center"></tbody>
                        <tfoot>
                            <tr>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Column number"># <i
                                        class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Metode Pembayaran Logo">Logo
                                    <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Metode Pembayaran name">Name
                                    <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Metode Pembayaran Status">
                                    Status
                                    <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Metode Pembayaran Keterangan">
                                    Keterangan <i class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Type Metode Pembayaran">
                                    Type <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Min Charge Metode Pembayaran">
                                    Min Charge <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Category Metode Pembayaran">
                                    Category <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Actions">Actions <i
                                        class="fas fa-info-circle ml-1"></i></th>
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
            var route = "{{ route('fetch-metode-pembayaran') }}";
            var table = $('#metode_bayar_list').DataTable({
                dom: "Bfrtip",
                responsive: false,
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
                        var seletedFilter = $('.filter.active').data('filter');
                        data.filter = seletedFilter;
                    },
                    beforeSend: function() {
                        // Show loading spinner while data is loading
                        $('#metode_bayar_list').addClass('loading');
                        // flasher.info('Sedang Memuat Data...', {
                        //     "timeOut": 30000
                        // })
                    },
                    complete: function() {
                        // Hide loading spinner when data loading is complete
                        $('#metode_bayar_list').removeClass('loading');
                        $('.filter').prop('disabled', false);
                        $('#filterLabel').removeClass('d-none');
                        $('#filterLabel').text($('.filter.active').text());

                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                    },
                    {
                        data: "logo"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "keterangan"
                    },
                    {
                        data: "type"
                    },
                    {
                        data: "min_charge"
                    },
                    {
                        data: "category"
                    },
                    {
                        data: "actions"
                    },
                ],
            });

            // setInterval(() => {
            //     table.ajax.reload(null, false);
            //     flasher.info('Data Berhasil Diperbaharui!')
            // }, 20000);


            table.on("click", ".delete", function() {
                const id = $(this).attr("data-id");
                if (confirm(
                        "Anda akan menghapus data ini?"
                    )) {
                    $.ajax({
                        url: "{{ route('metode-pembayaran.destroy', ['id' => 'idd']) }}".replace(
                            'idd',
                            id),
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        },
                        success: function(data) {
                            flasher.success(data.message);
                            table.ajax.reload(null, false);
                        }
                    });
                }
            });

            table.on("click", ".status", function() {
                const id = $(this).attr("data-id");
                if (confirm(
                        "Anda akan mengubah status data ini?"
                    )) {
                    $.ajax({
                        url: "{{ route('metode-pembayaran.update.status', ['id' => 'idd']) }}"
                            .replace('idd',
                                id),
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        },
                        success: function(data) {
                            flasher.success('Status Berhasil Diubah!');
                            table.ajax.reload(null, false);
                        }
                    });
                }
            });

            table.on("click", "#updateFeatured", function() {
                const id = $(this).attr("data-id");
                if (confirm(
                        "Anda akan mengubah status featured brand ini?"
                    )) {
                    $.ajax({
                        url: "{{ route('type.update.featured', ['id' => 'idd']) }}".replace('idd',
                            id),
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        },
                        success: function(data) {
                            flasher.success('Featured Berhasil Diubah!');
                            table.ajax.reload(null, false);
                        }
                    });
                }
            });

        });
    </script>
@endpush

@push('modal')
    @include('admin.produk.type._partials.modal')
@endpush
