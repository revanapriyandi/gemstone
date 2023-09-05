<div class="col-lg-5">
    <div class="product-detail-container">
        <div class="product-detail-top">
            <div>
                <img src="{{ $brand->logo_url }}" alt="{{ ucwords($brand->name) }}" class="product-icon" />
            </div>
            <div class="top-text">
                <div class="d-flex align-items-center">
                    <span class="product-sub badge badge-pill badge-primary text-white">
                        {{ ucwords($brand->type->name) ?? 'Unknown' }}
                    </span>
                </div>
                <div class="game-title">
                    {{ ucwords($brand->name) }}
                </div>

                <div class="product-company">
                    <span class="product-company">
                        {{ $brand->company }}
                    </span>
                    <span class="product-price-currency">
                        {{-- {{ $brand->currency }} --}}
                    </span>
                </div>
            </div>
        </div>
        <div id="product-description" class="product-game-description mt-2">
            {!! $brand->description !!}
        </div>
        <br />
        <div id="product-cara_topup" class="product-game-description mt-2">
            {!! $brand->cara_topup !!}
        </div>
        {{-- <div class="product-links">
            <a href="https://play.google.com/store/apps/details?id=com.mobile.legends" target="_blank"
                class="product-link">
                <span class="icon-Android-OS-Original"></span>
                Unduh
            </a>
            <a href="https://itunes.apple.com/app/id1160056295?country=en" target="_blank" class="product-link">
                <span class="icon-Apple-Logo-Original"></span> Unduh
            </a>
            <a href="https://www.mobilelegends.com/" target="_blank" class="product-link">
                <span class="icon-Language"></span> Situs web
            </a>
            <a href="https://www.facebook.com/MobileLegendsGameMalaysia/?country=en&amp;brand_redir=1212826968780074"
                target="_blank" class="product-link">
                <span class="icon-Forum"></span> Komunitas
            </a>
        </div> --}}
    </div>
</div>
