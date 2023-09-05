<div class="col-sm-8 mt-sm-0 mt-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="font-weight-bolder">Meta Brand</h5>
                <button type="button" id="autoGenerateMeta" class="btn btn-dark btn-sm mb-0">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    Auto Generate
                </button>
            </div>

            <div class="col-md-12">
                <label class="mt-4">Meta Title</label>
                <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title"
                    required autocomplete="current-meta_title" id="meta_title" value="{{ $data->meta_title }}"
                    placeholder="Meta Title">
                @error('meta_title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-12">
                <label class="mt-4">Meta keyword</label>
                <input type="text" class="form-control @error('meta_keyword') is-invalid @enderror"
                    name="meta_keyword" required autocomplete="current-meta_keyword" id="meta_keyword"
                    value="{{ $data->meta_keywords }}" placeholder="Meta Keyword">
                @error('meta_keyword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-12">
                <label class="mt-4">Meta Description</label>
                <textarea name="meta_description" id="meta_description" cols="15" rows="5"
                    class="form-control @error('meta_description') is-invalid @enderror" placeholder="Meta Description">{{ $data->meta_description }}</textarea>
                @error('meta_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            if (document.getElementById('meta_keyword')) {
                var tags = document.getElementById('meta_keyword');
                const metaKeyword = new Choices(tags, {
                    removeItemButton: true
                });
            }

            $('#autoGenerateMeta').on('click', function() {
                $(this).find('.spinner-border').removeClass('d-none');
                var prompt = $('#brand').val();
                $.ajax({
                    url: "{{ route('inq.completions') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        prompt: prompt,
                        type_data: 'meta'
                    },
                    success: function(data) {
                        $('.spinner-border').addClass('d-none');
                        if (data.status === 'success') {
                            var meta_title = data.data.meta_title;
                            var meta_keywords = data.data.meta_keywords;
                            var meta_description = data.data.meta_description;

                            updateMeta(meta_title, meta_keywords, meta_description);

                        } else {
                            console.log('Error generating data');
                        }
                    }
                });
            });

            function updateMeta(meta_title, meta_keywords, meta_description) {
                var prompt = $('#brand').val();
                $.ajax({
                    url: "{{ route('brand.update.meta', 'idd') }}".replace('idd', '{{ $data->id }}'),
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        meta_title: meta_title,
                        meta_keywords: meta_keywords,
                        meta_description: meta_description
                    },
                    success: function(data) {
                        window.location.reload();
                    },
                    error: function(data) {
                        console.log('Error generating data');
                        alert('Meta gagal di update, silahkan coba lagi');
                    }
                });
            }
        });
    </script>
@endpush
