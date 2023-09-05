 <meta name='application-name' content="{{ config('app.name') }}" />
 <meta name="copyright" content="&copy; {{ date('Y') }} by {{ config('app.name') }}">
 <meta name='description'
     content="Top up or buy game credits/diamonds/game voucher, fast and cheap at {{ config('app.name') }}. {{ config('app.name') }} is the best way to buy game credits/game vouchers." />
 <meta name="title" content="{{ config('app.name') }} - The Leading Digital Entertainment Enabler" />
 <meta name="robots" content="noodp, noydir" />
 <meta name="theme-color" content="#111340">
 <link rel="manifest" href="{{ asset('manifest.json') }}">
 <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('logo/apple-icon.png') }}" />
 <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('logo/apple-icon.png') }}" />
 <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('logo/apple-icon.png') }}" />
 <link rel="apple-touch-icon" href="{{ asset('logo/apple-icon.png') }}" />
 <link rel="shortcut icon" sizes="196x196" href="{{ asset('logo/apple-icon.png') }}" />
 <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo/favicon.ico') }}" />
 <link rel="icon" type="image/x-icon" href="{{ asset('logo/favicon.ico') }}" />
 <meta property="og:url" content="/" />
 <meta property="og:type" content="website" />
 <meta property="og:title"
     content="{{ config('app.name') }} {{ config('app.name') }} - Cheapest and Fastest Online Game Voucher" />
 <meta property="og:description"
     content="Top up or buy game credits/diamonds/game voucher, fast and cheap at {{ config('app.name') }}. {{ config('app.name') }} is the best way to buy game credits/game vouchers." />
 <meta property="og:image" content="{{ asset('logo/logo-dark.png') }}" />
 <meta property="twitter:card" content="summary">
 <meta property="twitter:site" content="@">
 <meta property="twitter:title"
     content="{{ config('app.name') }} {{ config('app.name') }} - Cheapest and Fastest Online Game Voucher" />
 <meta property="twitter:description"
     content="Top up or buy game credits/diamonds/game voucher, fast and cheap at {{ config('app.name') }}. {{ config('app.name') }} is the best way to buy game credits/game vouchers." />
 <meta property="twitter:image" content="{{ asset('logo/logo-dark.png') }}" />
 <meta property="twitter:url" content="/" />
 <link rel="preload" href="{{ asset('logo/logo.svg') }}" as="image">
 <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('logo/apple-icon.png') }}">
 <link rel="icon" type="image/png" href="{{ asset('logo/icon-logo.png') }}">
 {{-- <link rel="preconnect" href="https://www.googletagmanager.com/" crossorigin> --}}
 {{-- <link rel="preconnect" href="https://connect.facebook.net/" crossorigin> --}}

 <style>
     .drawer-offset {
         display: block;
     }

     .splide-placeholder {
         margin-right: 30px !important;
         margin-left: 15px;
         margin-top: 15px;
         margin-bottom: 25px;
     }

     .splide-placeholder-wrapper {

         margin-top: 15px !important;
         margin-bottom: 25px !important;
     }

     .slider-placeholder-ratio-container {
         width: 100%;
         padding-top: 40%;
         position: relative;
     }

     .slider-placeholder-ratio-container img {
         width: 100%;
         height: 100%;
         position: absolute;
         top: 0;
         left: 0;
         bottom: 0;
         right: 0;
     }

     @media(min-width:992px) {
         .splide-placeholder {
             height: 384px;
             visibility: hidden;
         }
     }

     .owl-nav.disabled {
         display: none !important;
     }

     #seacaNav {
         display: flex;
         justify-content: flex-end;
         margin-bottom: 10px;
     }

     #seacaNav button {
         border: none;
         background: none;
         font-weight: bold;
         margin: 0 10px;
         font-size: 25px;
     }

     #seacaNav button:focus,
     #seacaNav button:active {
         background: #f7e5cb;
         border: none;
         outline: none;
     }

     .owl-dots {
         counter-reset: dots;
     }

     .owl-dot:before {
         counter-increment: dots;
         content: counter(dots, decimal-leading-zero);
     }

     .owl-carousel .owl-item img {
         border-radius: 10px;
     }

     .owl-stage {
         left: -15px;
     }

     #seaca_section .owl-carousel .owl-item img {
         height: 280px;
     }

     @media (min-width: 576px) {
         #seaca_section .owl-carousel .owl-item img {
             height: 400px;
         }
     }

     @media (min-width: 768px) {
         #seaca_section .owl-carousel .owl-item img {
             height: 300px;
         }

         .owl-stage {
             left: 0;
         }
     }

     @media (min-width: 992px) {
         #seaca_section .owl-carousel .owl-item img {
             height: 480px;
         }
     }

     #bonusBannerMobile {
         display: flex;
     }

     .navbar-offset {
         height: 125px;
     }

     @media (min-width: 576px) {
         .navbar-offset {
             height: 135px;
         }
     }

     @media (min-width: 992px) {
         #bonusBannerWeb {
             display: -webkit-box;
             display: flex;
         }

         #bonusBannerMobile {
             display: none;
         }

         .navbar-offset {
             height: 160px;
         }
     }

     .top-banner-trigger {
         cursor: pointer;
     }


     .modal-dialog-redeem {
         margin: 1.75rem auto;
         max-width: 310px;
         top: 50%;
         -webkit-transform: translateY(-50%) !important;
         transform: translateY(-50%) !important;
     }

     .modal-dialog-redeem img {
         width: 100%;
     }

     @media (min-width: 576px) {
         .modal-dialog-redeem {
             max-width: 800px;
         }
     }
 </style>
