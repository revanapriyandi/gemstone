<div class="col-sm-12 mt-sm-0 mt-4">
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="font-weight-bolder">Game Server</h5>
            <div class="d-flex">
                <button type="button" id="btnTambahServer"
                    class="btn bg-gradient-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 btn-sm mb-3">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    Simpan</button>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-sm">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Server</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data->gameServer as $item)
                                <tr>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->is_active == 1)
                                            <span class="badge bg-gradient-success">Aktif</span>
                                        @else
                                            <span class="badge bg-gradient-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-link btn-sm text-warning" id="btnEdit"
                                            data-id="{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:;" class="btn btn-link btn-sm text-danger"
                                            onclick="if (confirm('Apakah anda ingin menghapus data ini ?')) {document.getElementById('formDeleteServer-' + '{{ $item->id }}').submit();}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    <form action="{{ route('brand.server.destroy', $item->id) }}" method="POST"
                                        id="formDeleteServer-{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('modal')
    @include('admin.produk.brand.edit.brand-game-server-modal')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#btnTambahServer').on('click', function() {
                $('#modal-server').modal('show');
                $('#modal-server').find('.modal-title').text('Tambah Game Server');
            });

            $('#modal-server').on('hidden.bs.modal', function() {
                $('#modal-server').find('#kode').val('');
                $('#modal-server').find('#name').val('');

                $('#modal-server').find('#kode').removeClass('is-invalid');
                $('#modal-server').find('#name').removeClass('is-invalid');

                $('#modal-server').find('.kode-error').addClass('d-none').text('');
                $('#modal-server').find('.server-error').addClass('d-none').text('');
            });

            $('#btnEdit').on('click', function() {
                $('#modal-server').modal('show');
                $('#modal-server').find('.modal-title').text('Edit Game Server');

                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('brand.server.edit', 'idd') }}".replace('idd', id),
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#modal-server').find('#id').val(data.id);
                        $('#modal-server').find('#kode').val(data.kode);
                        $('#modal-server').find('#name').val(data.name);
                    }
                });
            });

        });
    </script>
@endpush
