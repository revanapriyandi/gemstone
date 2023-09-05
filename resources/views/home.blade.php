@extends('layouts.app')

@section('content')
    <div class="flashsale">
        @include('partials.splider')
        @include('partials.flash')
    </div>
    {{-- @include('partials.menu') --}}
    @include('partials.produk-slide')
    @include('partials.trending')

    @include('partials.tab-content')

    @include('layouts.partials.app.accountModal')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var limit = 12;
            var lastPage = 1;
            var tabLimits = {};

            function loadBrands(categoryId, limit, totalBrand, tabId) {
                $.ajax({
                    url: "{{ route('getBrandsByCategory', 'idd') }}".replace('idd', categoryId) +
                        "?limit=" + limit,
                    method: 'GET',
                    success: function(response) {
                        $('.cards-game-container').html('');
                        var cardContainer = '';
                        response.data.forEach(item => {
                            var slug = item.slug;
                            var route = "{{ route('purchase', ['slug' => 'slugs']) }}".replace(
                                'slugs', slug);

                            var card =
                                '<div class="card-sizer o">' +
                                '<a class="card-container a-plain" href="' + route + '">' +
                                '<div class="card-image flex-shrink-0">' +
                                '<img data-src="' + item.logo_url + '" alt="' + item.name +
                                '" loading="lazy" class=" ls-is-cached lazyloaded" src="' + item
                                .logo_url + '"> </div>' +
                                '<div class="card-title-publisher-wrap">' +
                                '<div class="card-game-publisher">-</div>' +
                                '<div class="card-game-title">' + item.name + '</div>' +
                                '</div>' +
                                '<div class="card-actions">' +
                                '<div class="topup-button rounded-pill flex-center-xy">' +
                                '<div class="topup-button-text">Beli Sekarang</div>' +
                                '</div>' +
                                '</div>' +
                                '</a>' +
                                '</div>'

                            cardContainer += card;
                        });

                        var load = '';
                        if (limit < totalBrand) {
                            load = '<div id="load_more_container">' +
                                '<button type="button" name="load_more_button_mobile" ' +
                                'class="btn btn-success form-control load-more-btn" ' +
                                'data-category="mobile" data-offset="18" data-loop="18" ' +
                                'data-tab-id="' + tabId + '">Lebih Banyak</button>' +
                                '</div>';
                        }
                        cardContainer += load;
                        $('.cards-game-container').append(cardContainer);
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
            }


            $(document).on('click', '.load-more-btn', function() {
                $(this).addClass('btn-loading');
                $(this).html('Loading...');
                var categoryId = $('.game-tab-btn.active').data('category-id');
                var totalBrand = $('.game-tab-btn.active').data('total-brand');
                var tabId = $('.game-tab-btn.active').attr('id');
                tabLimits[tabId] += 12;
                loadBrands(categoryId, tabLimits[tabId], totalBrand, tabId);
            });

            $('.game-tab-btn').click(function() {
                var categoryId = $(this).data('category-id');
                var totalBrand = $(this).data('total-brand');
                var tabId = $(this).attr('id'); // Get tab ID
                tabLimits[tabId] = 12; // Reset limit for this tab
                loadBrands(categoryId, tabLimits[tabId], totalBrand, tabId);
            });

            function loadDefault() {
                var categoryId = $('.game-tab-btn.active').data('category-id');
                var totalBrand = $('.game-tab-btn.active').data('total-brand');
                var tabId = $('.game-tab-btn.active').attr('id');
                tabLimits[tabId] = 12;
                loadBrands(categoryId, tabLimits[tabId], totalBrand, tabId);
            }

            loadDefault();

        });
    </script>
@endpush
