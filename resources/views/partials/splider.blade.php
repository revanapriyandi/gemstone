<div id="home-splide" class="splide " style="display: none; padding-top:75px">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach ($brand->where('banner', '!=', null) as $item)
                <li class="splide__slide slider-card ">
                    <a class="gtm-banner-click" href="{{ route('purchase', $item->slug) }}"
                        data-title="Beli Voucher Dana Deals &amp; Saatnya Koleksi Booyah Pass Terbaru!">
                        <img data-splide-lazy="{{ $item->banner_url }}" alt="{{ $item->name }}"
                            class="slider-image-ratio-container" />
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
