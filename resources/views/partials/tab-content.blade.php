<div class="container-fluid">
    <div class="mt-2 featured-search-seeall-tabs">
        <div class="featured-search-seeall text-primary">
            <form id="search_form_featuredgames" class="mb-0 search-icon-trigger-submit" method="get" action="#">
                <div class="input-group input-icon-group">
                    <input type="text" name="search" class="flat form-control rounded-pill form-clearable"
                        value="" placeholder="Cari di {{ $settings->app_name }}..." />
                    <span class="input-icon-left icon-Search"></span>
                    <div class="input-icon-right clear-button">
                        <span class="icon-Close"></span>
                    </div>
                </div>
            </form>
            <div class="toggle-view">
                <span class="list-view active"><img src="https://cdn.unipin.com/images/navigation/list-icon.png"></span>
                <span class="grid-view hide"><img src="https://cdn.unipin.com/images/navigation/grid-icon.png"></span>
            </div>
            <a href="#" id="home-featured-seeall-link" class="d-flex align-items-center a-plain">
                <div class="pr-2">Lainnya</div>
                <span class="icon-cheveron-Right"></span>
            </a>
        </div>
        <ul class="nav nav-pills mt-3 mt-lg-0" id="homepage-game-tab" role="tablist">
            @foreach ($kategori as $index => $item)
                <li class="nav-item " role="presentation">
                    <a class="game-tab-btn {{ $index == 0 ? 'active' : '' }}" id="{{ $item->id }}"
                        data-toggle="pill" data-category-id="{{ $item->id }}"
                        data-total-brand={{ $item->brands->count() }} href="#{{ Str::slug($item->name) }}"
                        role="tab" aria-controls="{{ Str::slug($item->name) }}" aria-selected="false"
                        data-seeall-link="">{{ ucwords($item->name) }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content " id="homepage-featuredgame-tabContent">
        <div class="tab-pane home-featured-tab-content fade active show" id="home-mobilegames" role="tabpanel"
            aria-labelledby="home-mobilegames-tab">
            <div id="home-mobilegames-track" class="cards-hscroll-track">
                <div class="cards-game-container g-view">
                </div>
            </div>
        </div>
    </div>
</div>
