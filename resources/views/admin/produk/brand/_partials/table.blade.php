<div class="row mt-4">
    <div class="col-12">
        <div class="card">

            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">All Brand Produk</h5>
                        <p class="text-sm mb-0">
                            Berikut adalah semua brand produk yang tersedia.
                        </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">

                    </div>
                </div>
            </div>
            <div class="card-body text-sm">
                <div class="table-responsive">
                    <table class="table table-flush display" id="brand-list">
                        <thead class="thead-light text-center">
                            <tr>
                                <th style="width: 5%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Item number">
                                    # <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 5%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Brand's Banner">
                                    Banner <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 5%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Brand's Logo">
                                    Logo <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 5%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Brand's name">
                                    Brand Name <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Status of the brand">
                                    Status <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Whether the brand is featured">
                                    Featured <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Last update time">
                                    Updated At <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Available actions">
                                    Actions <i class="fas fa-info-circle ml-1"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm"></tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 5%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Item number">
                                    # <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 5%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Brand's Banner">
                                    Banner <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 5%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Brand's Logo">
                                    Logo <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 5%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Brand's name">
                                    Brand Name <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Status of the brand">
                                    Status <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Whether the brand is featured">
                                    Featured <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Last update time">
                                    Updated At <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" title="Available actions">
                                    Actions <i class="fas fa-info-circle ml-1"></i>
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
            var route = "{{ route('fetch-brand') }}";
            var table = $('#brand-list').DataTable({
                dom: "Bfrtip",
                responsive: true,
                processing: true,
                // serverSide: true,
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
                },
                columns: [{
                        data: "id"
                    },
                    {
                        data: "banner"
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
                        data: "featured"
                    },
                    {
                        data: "updated_at"
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

            table.on("click", "#uploadLogo", function() {
                const id = $(this).attr("data-id");
                const name = $(this).attr("data-name");
                $('#uploadLogoModal').modal('show');
                $('#uploadLogoModal').on('shown.bs.modal', function() {
                    $('#ModalLabel').html('Upload Logo ' + name);
                    $('#id').val(id);
                });

                $('#uploadLogoModal').on('hidden.bs.modal', function() {
                    $('#ModalLabel').html('');
                    $('#id').val('');
                    $('#logo').val('');
                    $('#logoPreview').attr('src', '#').hide();
                    $('form').attr('action', '');
                    table.ajax.reload(null, false);
                });
            });


            table.on("click", "#deleteBtn", function() {
                const id = $(this).attr("data-id");
                if (confirm(
                        "Anda akan menghapus brand ini?, Semua produk yang berhubungan dengan kategori ini akan terhapus juga!"
                    )) {
                    $.ajax({
                        url: "{{ route('brand.destroy', ['id' => 'idd']) }}".replace('idd',
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

            table.on("click", "#updateStatus", function() {
                const id = $(this).attr("data-id");
                if (confirm(
                        "Anda akan mengubah status brand ini?"
                    )) {
                    $.ajax({
                        url: "{{ route('brand.update.status', ['id' => 'idd']) }}".replace('idd',
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
                        url: "{{ route('brand.update.featured', ['id' => 'idd']) }}".replace('idd',
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
    @include('admin.produk.brand._partials.modal')
@endpush
