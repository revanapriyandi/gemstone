<div class="px-lg-3">
    <div class="col-12">
        <div class="caption-group">
            <div class="sub-caption">
                Game Populer
            </div>
            <div class="caption">
                <h2>Trending Sekarang</h2>
                <div class="text-primary home-featured-paddles">
                    <button class="btn home-featured-paddle-prev" data-paddle-target="">
                        <span class="icon-cheveron-Left"></span>
                    </button>
                    <button class="btn home-featured-paddle-next" data-paddle-target="">
                        <span class="icon-cheveron-Right"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab-pane home-featured-tab-content" id="home-favourite" role="tabpanel"
    aria-labelledby="home-favourite-tab">

    <div id="home-favourite-track" class="cards-hscroll-track">
        <div class="cards-hscroll-container card-hscroll-limit-homepagefeatured hftc">
            @foreach ($brand as $item)
                <div class="card-sizer o">
                    <a class="card-container a-plain" href="{{ route('purchase', ['slug' => $item->slug]) }}">
                        <div class="card-image flex-shrink-0">
                            <img data-src="{{ $item->logo_url }}" alt="{{ ucwords($item->name) }}" loading="lazy"
                                class=" ls-is-cached lazyloaded" src="{{ $item->logo_url }}">
                        </div>
                        <div class="card-title-publisher-wrap">
                            <div class="card-game-publisher">-</div>
                            <div class="card-game-title">{{ ucwords($item->name) }}</div>
                        </div>
                        <div class="card-actions">
                            <div class="topup-button rounded-pill flex-center-xy">
                                <div class="topup-button-text">Beli Sekarang</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
