<div class="">
    <div class="container clear-padding">
        <div class="row">
            <div class="col-md-12 mobile-v">
                <div class="flashsale-wrap">
                    <div class="flashsale-wrap__title ng-tns-c129-1">
                        <div class="ng-tns-c129-1 ng-star-inserted">
                            <div class="flash-sale-countdown">
                                <div class="flash-sale-countdown__item">
                                    <div class="flash-sale-count ng-star-inserted">
                                        <div class="flash-sale-count__item count-text"><span>Berakhir Dalam :</span>
                                        </div>
                                        <div class="flash-sale-count__item count-number ng-star-inserted"><span> 05 : 10
                                                : 58</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flashsale-wrap__content">
                        <div class="flash-sale-carousel">
                            <div class="swiper ">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @for ($i = 0; $i < 10; $i++)
                                            <div class="swiper-slide">
                                                <div class="bg"
                                                    style="background-image: url('https://api.duniagames.co.id/api/product/upload/image/10677716671690439090.png');">
                                                    <div class="contents">
                                                        <div class="logo">
                                                            <img src="https://api.duniagames.co.id/api/product/upload/image/4614372541659521936.jpg"
                                                                alt="140 Diamond dan WeTV 7hr &amp; 1.5G">
                                                        </div>
                                                        <div class="text-area">
                                                            <div class="text-area__denom">
                                                                <span>140 Diamond dan WeTV 7hr &amp; 1.5G</span>
                                                            </div>
                                                            <div class="text-area__prize">
                                                                <h4>25,227</h4>
                                                            </div>
                                                            <div class="progress-outer">
                                                                <div class="progress-inner"
                                                                    style="width: 33.36%; background-color: rgb(208, 2, 27);">
                                                                    33.36
                                                                </div>
                                                            </div>
                                                            <div class="text-area__sold">
                                                                <h4>1668 tersisa</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a class="url" data-test-id="flash-sale-0"
                                                        href="/top-up/item/freefire?flashsale-reference=980"></a>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var swiper = new Swiper(".swiper-container", {
                slidesPerView: 4,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        });
    </script>
@endpush
