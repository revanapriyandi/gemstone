<div class="row mt-4">
    <div class="col-12">
        <div class="card">

            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">All Kategori</h5>
                        <p class="text-sm mb-0">
                            This table shows all kategori that you have.
                        </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">

                    </div>
                </div>
            </div>
            <div class="card-body text-sm">
                <div class="table-responsive">
                    <table class="table table-flush display" id="kategori-list">
                        <thead class="thead-light text-center">
                            <tr>
                                <th class="text-uppercase text-center text-secondary font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Centang untuk merubah statun pin">
                                    # <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 30%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Kategori Name">
                                    Name <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 30%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Kategori Deskripsi">
                                    Deskripsi <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Kategori status">
                                    Status <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Kategori di tampilkan di home">
                                    Pin <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Item Count">
                                    Jumlah Item <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Last updated time">
                                    Updated At <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Actions">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm"></tbody>
                        <tfoot>
                            <tr>
                                <th class="text-uppercase text-center text-secondary font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Centang untuk merubah statun pin">
                                    # <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 30%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Kategori Name">
                                    Name <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 30%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Kategori Deskripsi">
                                    Deskripsi <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Kategori status">
                                    Status <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Kategori di tampilkan di home">
                                    Pin <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Item Count">
                                    Jumlah Item <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Last updated time">
                                    Updated At <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th style="width: 15%"
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Actions">Actions</span>
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
            var route = "{{ route('fetch-kategori') }}";
            var table = $('#kategori-list').DataTable({
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
                        data: "deskripsi"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "pin"
                    },
                    {
                        data: "item"
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

            table.on("click", "#editBtn", function() {
                const id = $(this).attr("data-id");

                $('#editKategori').modal('show');

                $.ajax({
                    url: "{{ route('kategori.edit', ['id' => 'idd']) }}".replace('idd', id),
                    type: "GET",
                    success: function(data) {
                        $('#id').val(data.id);
                        $('#name').val(data.name);
                        $('#deskripsi').val(data.deskripsi);
                        $('#ModalLabel').text('Edit Kategori ' + data.name);
                    }
                });

            });

            table.on("click", "#deleteBtn", function() {
                const id = $(this).attr("data-id");
                if (confirm(
                        "Anda akan menghapus kategori ini?, Semua produk yang berhubungan dengan kategori ini akan terhapus juga!"
                    )) {
                    $.ajax({
                        url: "{{ route('kategori.destroy', ['id' => 'idd']) }}".replace('idd',
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

            table.on("click", "#pinChanger", function() {
                const id = $(this).attr("data-id");
                if (confirm(
                        "Anda akan mengubah status pin kategori ini?"
                    )) {
                    $.ajax({
                        url: "{{ route('kategori.update.pin', ['id' => 'idd']) }}".replace('idd',
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

            table.on("click", "#statusChanger", function() {
                const id = $(this).attr("data-id");
                if (confirm(
                        "Anda akan mengubah status kategori ini?"
                    )) {
                    $.ajax({
                        url: "{{ route('kategori.update.status', ['id' => 'idd']) }}".replace('idd',
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

        });
    </script>
@endpush

@push('modal')
    @include('admin.produk.kategori._partials.modal')
@endpush
