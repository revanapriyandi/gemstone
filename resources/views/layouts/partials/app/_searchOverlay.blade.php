<div id="search-overlay" class="full-overlay overlay-slide-down ">
    <div class="navbar-offset"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="topbar mt-2">
                    <div class="topbar-left-action" onclick="toggleSearchOverlay();">
                        <span class="icon-cheveron-Left"></span>
                    </div>
                    <div class="topbar-control">
                        <div class="input-group input-icon-group">
                            <form id="search_form_mobile_overlay" class="mb-0 w-100 search-icon-trigger-submit"
                                method="get" action="https://www.unipin.com/games/search">
                                <input id="search-overlay-input" type="text"
                                    class="flat form-control rounded-pill form-clearable search_input"
                                    placeholder="Cari di {{ $settings->app_name }}..." value=""
                                    name="search" />
                                <span class="input-icon-left icon-Search"></span>
                                <div class="input-icon-right clear-button">
                                    <span class="icon-Close"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12"></div>
        </div>
    </div>
    <div class="bottom-bar-offset"></div>
    <div class="floating-chat-offset"></div>
</div>
