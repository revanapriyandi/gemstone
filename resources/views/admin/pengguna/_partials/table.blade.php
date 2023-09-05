<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">
                            All User List
                        </h5>
                        <p class="text-sm mb-0">
                            This is the list of all user
                        </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">

                    </div>
                </div>
            </div>
            <div class="card-body text-sm">
                <div class="table-responsive">
                    <table class="table table-flush display" id="user-list">
                        <thead class="thead-light text-center">
                            <tr>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Column number"># <i
                                        class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Photo Profile">Profile <i
                                        class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="User's name">Name <i
                                        class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="User's email">Email <i
                                        class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="User's phone number">Phone
                                    <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="User's account status">
                                    Status <i class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="User's Created At date">
                                    Created At <i class="fas fa-info-circle ml-1"></i>
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
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Photo Profile">Profile <i
                                        class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="User's name">Name <i
                                        class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="User's email">Email <i
                                        class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="User's phone number">Phone
                                    <i class="fas fa-info-circle ml-1"></i>
                                </th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="User's account status">
                                    Status <i class="fas fa-info-circle ml-1"></i></th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="User's Created At date">
                                    Created At <i class="fas fa-info-circle ml-1"></i>
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
            var route = "{{ route('fetch-pengguna') }}";
            var table = $('#user-list').DataTable({
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
                        $('#user-list').addClass('loading');
                        // flasher.info('Sedang Memuat Data Produk...', {
                        //     "timeOut": 30000
                        // })
                    },
                    complete: function() {
                        // Hide loading spinner when data loading is complete
                        $('#user-list').removeClass('loading');
                        $('.filter').prop('disabled', false);
                        $('#filterLabel').removeClass('d-none');
                        $('#filterLabel').text($('.filter.active').text());
                        // flasher.clear();
                        // flasher.success('Data Produk Berhasil Dimuat!', {
                        //     "timeOut": 1000
                        // })
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                    },
                    {
                        data: "profile"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "phone"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "created_at"
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


            $('.filter').on('click', function() {
                var filter = $(this).data('filter');
                if (filter == 'clear') {
                    window.location.reload();
                }
                $('.filter').removeClass('active');
                $(this).addClass('active').addClass('loading');

                $('.filter').prop('disabled', true);
                table.ajax.reload(null, false);
            });

            table.on("click", "#deleteBtn", function() {
                const id = $(this).attr("data-id");
                if (confirm(
                        "Anda akan menghapus pengguna ini?"
                    )) {
                    $.ajax({
                        url: "{{ route('pengguna.destroy', ['id' => 'idd']) }}".replace('idd',
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
