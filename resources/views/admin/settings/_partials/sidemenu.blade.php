 <div class="col-lg-3">
     <div class="card position-sticky top-1">
         <ul class="nav flex-column bg-white border-radius-lg p-3">
             <li class="nav-item">
                 <a class="nav-link text-body active tab-setting" data-scroll=""
                     data-href="{{ route('setting.index', ['x' => 'general']) }}" id="general-tab" data-bs-toggle="pill"
                     data-bs-target="#general-info" type="button" role="tab" aria-controls="general-info"
                     aria-selected="true">
                     <div class="icon me-2">
                         <span class="fa fa-book"></span>
                     </div>
                     <span class="text-sm">General</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link text-body  tab-setting" data-scroll=""
                     data-href="{{ route('setting.index', ['x' => 'harga-jual']) }}" id="harga-jual-tab"
                     data-bs-toggle="pill" data-bs-target="#harga-jual-info" type="button" role="tab"
                     aria-controls="harga-jual-info" aria-selected="true">
                     <div class="icon me-2">
                         <span class="fa fa-cart-plus"></span>
                     </div>
                     <span class="text-sm">Harga Jual</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link text-body  tab-setting" data-scroll=""
                     data-href="{{ route('setting.index', ['x' => 'email']) }}" id="email-tab" data-bs-toggle="pill"
                     data-bs-target="#email-info" type="button" role="tab" aria-controls="email-info"
                     aria-selected="true">
                     <div class="icon me-2">
                         <span class="fa fa-mail-bulk"></span>
                     </div>
                     <span class="text-sm">Email Settings</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link text-body  tab-setting" data-scroll=""
                     data-href="{{ route('setting.index', ['x' => 'social-login']) }}" id="social-login-tab"
                     data-bs-toggle="pill" data-bs-target="#social-login-info" type="button" role="tab"
                     aria-controls="social-login-info" aria-selected="true">
                     <div class="icon me-2">
                         <span class="fa fa-google-plus"></span>
                     </div>
                     <span class="text-sm">Social Login</span>
                 </a>
             </li>
         </ul>
     </div>
 </div>

 @push('scripts')
     <script>
         $(document).ready(function() {
             $('.tab-setting').click(function() {
                 window.location.href = $(this).data('href');
             });
         });
     </script>
 @endpush
