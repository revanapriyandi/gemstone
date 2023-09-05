<div class="content d-none d-md-block bg-primary-dark" style="margin-top: -5.7em">
    <div class="px-3">
        <div class="block block-rounded animated fadeIn">
            <div class="block-content block-content-full">
                <div class="d-flex justify-content-between align-items-center py-3 px-4">
                    @foreach ($type as $item)
                        <a class="h-100 d-flex flex-column align-items-center justify-content-center" href="#">
                            <img class="lazy entered loaded" style="width: 30px; height: 30px;"
                                src="{{ $item->logo_url }}" data-src="{{ $item->logo_url }}" alt="{{ $item->name }}"
                                data-ll-status="loaded">
                            <span class="text-dark fs-xs fw-light mt-1 text-center">{{ ucwords($item->name) }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container container-1440">
    <div class="px-lg-3">
        <div class="row">
            <div class="col-12 product-detail-container">
                <div class="icon-s-container">
                    @foreach ($type as $item)
                        <div class="icon-s">
                            <a href="javascript:;">
                                <div class="avatar avatar-50  border-0">
                                    <div class="overlay gradient-primary">
                                        <img class="img-fluid" src="{{ $item->logo_url }}" alt="{{ $item->name }}">
                                    </div>
                                </div><span title="{{ $item->name }}">{{ $item->name }}</span>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div> --}}
