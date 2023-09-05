 <div id="top-navbar" class="fixed-top background-white nav-top-outter">
     <nav class="navbar justify-content-between justify-content-lg-between navbar-light bg-primary">
         <div class="navbar-menu">
             <a class="nav-logo" href="/">
                 <img src="{{ asset('logo/logo.png') }}" alt="{{ config('app.name') }}" style="width: 100%" />
             </a>
             <div class="border-left pl-4"></div>
             <div id="menus">
                 <a href="{{ route('home') }}" class="btn btn-link text-white font-weight-bold d-none d-md-inline">
                     <span class="fa fa-home"></span>
                     <span class="d-none d-lg-inline">Beranda</span>
                 </a>
                 <a href="#" class="btn btn-link text-white font-weight-bold d-none d-md-inline">
                     <span class="fa fa-percent"></span>
                     <span class="d-none d-lg-inline">Promo</span>
                 </a>
                 <a href="#" class="btn btn-link text-white font-weight-bold d-none d-md-inline">
                     <span class="fa fa-gamepad"></span>
                     <span class="d-none d-lg-inline">Game</span>
                 </a>
             </div>
         </div>

         <div class="desktop-searchbar d-none">
             <form id="search-form" class="mb-0 search-icon-trigger-submit" method="get" action="#">
                 <div class="input-group input-icon-group">
                     <input id="search_input" type="text" name="search"
                         class="flat form-control rounded-pill search_input" value=""
                         placeholder="Cari di {{ config('app.name') }}..." autocomplete="off" />
                     <span class="input-icon-left icon-Search"></span>
                     <div class="input-icon-right clear-button">
                         <span class="icon-Close"></span>
                     </div>
                 </div>
             </form>
         </div>
         <div class="navbar-edge-item edge-right">
             @guest
                 <button class="btn btn-primary open-search-btn pr-5">
                     <i class="fa fa-search"></i>
                 </button>
                 <a id="navbar-signin-button" href="{{ route('login') }}" class="btn btn-warning text-white">Masuk</a>
             @endguest
             @auth

                 <div class="nav-profile-container">
                     <div class="nav-uc-container">
                         <button class="btn btn-primary open-search-btn">
                             <i class="fa fa-search"></i>
                         </button>
                         <div class="dropdown dropleft nav-uc-profile-wrap">
                             <div class="nav-uc-profile-icon"
                                 style="background-image: url('{{ auth()->user()->profile_photo_url }}');"
                                 data-toggle="dropdown">
                             </div>
                             <div
                                 class="dropdown-menu desktop-dropdown-container profile-dropdown-container up-animate slideIn">
                                 <div class="bg-primary">
                                     <div class="container-fluid d-block">
                                         <div class="row">
                                             <div class="col-12">
                                                 <div class="profile-details-container">
                                                     <div class="profile-icon"
                                                         style="background-image: url('{{ auth()->user()->profile_photo_url }}');">
                                                     </div>

                                                     <div class="profile-name-email-wrap">
                                                         <div id="profile-fullname-container" class="profile-name"
                                                             data-value="{{ auth()->user()->name }}">
                                                             {{ auth()->user()->name }}
                                                         </div>
                                                         <div class="d-inline">
                                                             <div id="profile-email-container"
                                                                 class="profile-email d-inline"
                                                                 data-value=" {{ auth()->user()->email }}">
                                                                 {{ auth()->user()->email }}</div>
                                                         </div>
                                                     </div>
                                                     <a class="signout-button"
                                                         onclick="if (confirm('Apakah Anda ingin keluar dari sesi saat ini?')) document.getElementById('logout-form').submit();"
                                                         style="cursor: pointer">
                                                         <span class="icon-Login"></span>
                                                     </a>

                                                     <form action="{{ route('logout') }}" method="POST" class="d-none"
                                                         id="logout-form">
                                                         @csrf
                                                     </form>

                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="container-fluid d-block mb-4">
                                     <div class="row">
                                         <div class="col-12">
                                             <div class="profile-container-offset">
                                                 <div class="profile-wallet-card">
                                                     <div class="profile-uc-label text-dark-50">
                                                         Saldo {{ $settings->app_name }}
                                                     </div>
                                                     <div class="profile-uc-amount">
                                                         <span class="text-primary h4">
                                                             Rp. {{ number_format(auth()->user()->saldo) }}
                                                         </span>
                                                         <a href="https://www.unipin.com/reload"
                                                             class="topup-button rounded-pill">top up</a>
                                                     </div>
                                                     <div class="profile-ewallet-linked-container">
                                                         <div class="payment-channel-button-container">
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="title-case-1 text-white mt-3">Features</div>
                                             <div class="profile-feature-container">
                                                 <a href="https://www.unipin.com/edit-profile" class="profile-feature-item">
                                                     <div class="profile-feature-icon">
                                                         <span class="icon-Account-Circle"></span>
                                                     </div>
                                                     Ubah profil
                                                 </a>
                                                 <a href="https://www.unipin.com/membership" class="profile-feature-item">
                                                     <div class="profile-feature-icon">
                                                         <img src="https://cdn.unipin.com/images/sampleimages/membership/membership.png"
                                                             width="32" height="32">
                                                         <div style="position:relative">
                                                             <div class="new-ribbon-profile animate">
                                                                 <div>New</div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     Keanggotaan
                                                 </a>
                                                 <a href="https://www.unipin.com/history" class="profile-feature-item">
                                                     <div class="profile-feature-icon">
                                                         <span class="icon-Receipt-Long"></span>
                                                     </div>
                                                     Riwayat Transaksi
                                                 </a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <button class="btn btn-primary">Cari</button>

                     </div>
                 </div>
             @endauth
         </div>
     </nav>
 </div>

 {{-- <div class="navbar-offset"></div> --}}

 @push('scripts')
     <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js"></script>
     <script>
         $(document).ready(function() {
             var path = "{{ route('searchHome') }}";
             $(".search_input").autocomplete({
                 source: function(request, response) {
                     $.ajax({
                         url: path,
                         type: 'GET',
                         dataType: "json",
                         data: {
                             term: request.term
                         },
                         success: function(data) {
                             response(data);
                         }
                     });
                 },
                 select: function(event, ui) {
                     $('.search_input').val(ui.item.label);
                     window.location.href = '{{ route('purchase', 'idd') }}'.replace('idd', ui.item
                         .slug);
                     return false;
                 }
             });

             $('.open-search-btn').on('click', function() {
                 var desktopSearch = $('.desktop-searchbar');
                 if (desktopSearch.hasClass('d-none')) {
                     desktopSearch.removeClass('d-none');
                     desktopSearch.addClass('d-block');
                     $('.navbar-menu').addClass('d-none');
                     $('.navbar-edge-item').addClass('d-none');
                 } else {
                     desktopSearch.removeClass('d-block');
                     desktopSearch.addClass('d-none');
                     $('.navbar-menu').removeClass('d-none');
                     $('.navbar-edge-item').removeClass('d-none');
                 }
             });

             var clearButton = $('.clear-button');

             if (clearButton.length > 0) {
                 var desktopSearch = $('.desktop-searchbar');
                 clearButton.on('click', function() {
                     desktopSearch.removeClass('d-block');
                     desktopSearch.addClass('d-none');
                     $('.navbar-menu').removeClass('d-none');
                     $('.navbar-edge-item').removeClass('d-none');
                 });
             }
         });
     </script>
 @endpush
