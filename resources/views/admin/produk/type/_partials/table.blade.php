<div class="row mt-4">
    <div class="col-12">
        <div class="card">

            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">All Type Produk</h5>
                        <p class="text-sm mb-0">
                            Berikut adalah semua type produk yang tersedia
                        </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">

                    </div>
                </div>
            </div>
            <div class="card-body text-sm">
                <div class="table-responsive">
                    <table class="table table-flush display" id="type-list">
                        <thead class="thead-light text-center">
                            <tr>
                                <th style="width: 5%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    #
                                </th>
                                <th style="width: 20%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Name
                                </th>
                                <th style="width: 20%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Description
                                </th>
                                <th style="width: 20%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Item Count
                                </th>
                                <th style="width: 10%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status
                                </th>
                                <th style="width: 10%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Featured
                                </th>
                                <th style="width: 10%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Updated At
                                </th>
                                <th style="width: 10%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm"></tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 5%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    #
                                </th>
                                <th style="width: 20%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Name
                                </th>
                                <th style="width: 20%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Description
                                </th>
                                <th style="width: 20%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Item Count
                                </th>
                                <th style="width: 10%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status
                                </th>
                                <th style="width: 10%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Featured
                                </th>
                                <th style="width: 10%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Updated At
                                </th>
                                <th style="width: 10%"
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
            var route = "{{ route('fetch-type') }}";
            var table = $('#type-list').DataTable({
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
                },
                columns: [{
                        data: "id"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "desc"
                    },
                    {
                        data: "itemCount"
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
                    $('#logoError').addClass('d-none');
                    $('#logo').removeClass('is-invalid');
                    table.ajax.reload(null, false);
                });
            });


            table.on("click", "#deleteBtn", function() {
                const id = $(this).attr("data-id");
                if (confirm(
                        "Anda akan menghapus Type Produk ini?, Semua produk yang berhubungan dengan Type ini akan terhapus juga!"
                    )) {
                    $.ajax({
                        url: "{{ route('type.destroy', ['id' => 'idd']) }}".replace('idd',
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
                        "Anda akan mengubah status type ini?"
                    )) {
                    $.ajax({
                        url: "{{ route('type.update.status', ['id' => 'idd']) }}".replace('idd',
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
