<div class="d-flex flex-column mb-5" style="scroll-margin-top: 100px;">
    <div class="px-lg-3">
        <div class="col-12">
            <div class="caption-group">
                <div class="sub-caption">
                    Game
                </div>
                <div class="caption">
                    <h2>
                        <span class="text-primary">Topup</span> Game Favoritmu
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative pb-2">
        <div class="content py-0 my-0">
            <div class="mx-2 mx-lg-4">
                <div class="horizon-scroll-control overflow-auto disable-scrollbars">
                    <div class="d-flex pt-4">
                        @foreach ($type as $item)
                            <div class="list-group d-flex flex-column gap-3 me-3 ">
                                @php
                                    $shuffledBrands = $item->brands;
                                    $counter = 0;
                                @endphp
                                @foreach ($shuffledBrands as $brand)
                                    @php
                                        if ($counter >= 3) {
                                            break;
                                        }
                                        $counter++;
                                    @endphp
                                    <a class="horizon-scroll-item list-group-item list-group-item-action d-flex   align-items-center p-3 border"
                                        href="{{ route('purchase', $brand->slug) }}"
                                        style="border-radius: 12px; min-width: 280px;">
                                        <img class="block block-fx-shadow block-bordered p-0 my-0 ms-0 lazy me-3 entered loaded"
                                            data-src="{{ $brand->logo_url }}" src="{{ $brand->logo_url }}"
                                            style="width: 64px; height: 64px; border-radius: 12px;"
                                            data-ll-status="loaded">
                                        <div class="d-flex flex-column justify-content-center gap-2">
                                            <span class="text-dark text-nowrap">{{ $brand->name }}</span>
                                            <div class="d-flex gap-2 align-items-center text-nowrap">
                                                <span class="rounded bg-xsmooth-lighter text-xsmooth fs-xs fw-medium"
                                                    style="padding: 1px 4px">
                                                    Featured
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="position-absolute top-50 start-0 translate-middle-y" style="z-index: 800;">
            <div class="ms-2 ms-md-3 ms-lg-4 ms-xl-6 ps-xl-2 pt-4">
                <button id="scroll-control-left" type="button"
                    class="btn ratio ratio-1x1 bg-body-light p-4 rounded rounded-circle block m-0 p-0 block-bordered block-fx-shadow animated bounceIn d-none"
                    style="cursor: pointer;">
                    <div>
                        <div class="d-flex justify-content-center align-items-center h-100 w-100">
                            <span class="fa-fw fa-lg icon-cheveron-Left"></span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
        <div class="position-absolute top-50 end-0 translate-middle-y" style="z-index: 800;">
            <div class="me-2 me-md-3 me-lg-4 me-xl-6 pe-xl-2 pt-4">
                <button id="scroll-control-right" type="button"
                    class="btn ratio ratio-1x1 bg-body-light p-4 rounded rounded-circle block m-0 p-0 block-bordered block-fx-shadow animated bounceIn"
                    style="cursor: pointer;">
                    <div>
                        <div class="d-flex justify-content-center align-items-center h-100 w-100">
                            <span class="fa-fw fa-lg icon-cheveron-Right"></span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.querySelectorAll(".horizon-scroll-control")?.forEach(element => {
            const dataSign = element.getAttribute("data-sign");
            const elementWitdh = parseInt(element.offsetWidth || element.clientWidth);
            const addScroll = elementWitdh + (0.02 * elementWitdh);
            const controlLeftElem = document.querySelector(`#scroll-control-left`);
            const controlRightElem = document.querySelector(`#scroll-control-right`);
            controlLeftElem?.addEventListener('click', function() {
                var scrollLeft = parseInt(element.scrollLeft);
                element.scrollTo({
                    left: scrollLeft - addScroll,
                    behavior: 'smooth'
                });
                controlLeftElem.blur();
            });
            controlRightElem?.addEventListener('click', function() {
                var scrollLeft = parseInt(element.scrollLeft);
                element.scrollTo({
                    left: scrollLeft + addScroll,
                    behavior: 'smooth'
                });
                controlRightElem.blur();
            });
            const scrollable = $(element).css('overflow-y') === 'scroll' || $(element).css('overflow-y') === 'auto';
            if (parseInt(elementWitdh + element.scrollLeft + 15) < element.scrollWidth && scrollable) {
                controlRightElem?.classList?.remove('d-none');
            } else {
                controlRightElem?.classList?.add('d-none');
            }
            element.addEventListener('scroll', function() {
                var scrollLeft = parseInt(element.scrollLeft);
                if (scrollLeft < 5) {
                    controlLeftElem?.classList?.add('d-none');
                } else if (scrollLeft > 5) {
                    controlLeftElem?.classList?.remove('d-none');
                }
                if (parseInt(elementWitdh + element.scrollLeft + 5) < element.scrollWidth) {
                    controlRightElem?.classList?.remove('d-none');
                } else {
                    controlRightElem?.classList?.add('d-none');
                }
            });
        });
    </script>
@endpush
