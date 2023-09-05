 <div class="payment-step-container step-payment-channel step-3" onclick="validateForm()" id="payment-channel">
     @foreach ($payment as $i => $item)
         <div id="{{ $i }}" class="method-container d-flex flex-column">
             <div class="method-group-label form-block highlight mb-3">
                 <div class="form-check-label-rounded-lg h-100 p-0"
                     onclick="document.querySelector('#{{ $i }}').classList.toggle('active');">
                     <div class="d-flex align-items-center py-2">
                         <div class="flex-grow-1 d-flex align-items-center mx-2 mx-md-4">
                             <span
                                 class="fw-semibold text-start my-2 me-1">{{ ucwords(str_replace('_', ' ', $i)) }}</span>
                             <i class="method-angle-down fa fa-caret-down"></i>
                             <i class="method-angle-up fa fa-caret-up" style="display: none;"></i>
                         </div>
                         <div
                             class="productMethodPrice method-angle-down d-flex justify-content-end my-auto pe-2 pe-md-4 text-nowrap">
                             <span class="text-currency d-block fs-sm fw-semibold text-end ms-2">
                                 Rp. -
                             </span>
                         </div>
                     </div>
                     <div
                         class="method-icons d-flex align-items-center justify-content-between px-2 px-md-4 py-3 border-top border-2 animated fadeIn">
                         <div class="d-flex flex-row flex-wrap justify-content-start gap-2">
                             @foreach ($item as $it)
                                 <div class="text-center bg-white rounded px-2 border">
                                     <img class="img-sq-sm fit-contain" src="{{ $it->logo_url }}">
                                 </div>
                             @endforeach
                         </div>
                     </div>
                 </div>
             </div>
             <div class="method-group d-flex flex-column animated fadeIn" style="display: none;">
                 @foreach ($item as $it)
                     <div id="{{ $it->id }}" class="form-block highlight mb-3 ms-3 ms-md-3">
                         <input type="radio" class="form-check-input paymentMethod" id="payment-{{ $it->id }}"
                             name="paymentMethod" value="{{ $it->id }}" required="">
                         <label class="form-check-label-rounded-lg h-100 p-0" for="payment-{{ $it->id }}">
                             <div class="d-flex justify-content-between">
                                 <div class="d-inline-flex">
                                     <div class="text-center bg-white rounded my-3 mx-2 mx-md-4 px-2 border">
                                         <img class="img-sq-sm fit-contain" src="{{ $it->logo_url }}">
                                     </div>
                                     <div class="my-auto">
                                         <span class="chTitle fs-sm d-block fw-semibold">{{ ucwords($it->name) }}</span>
                                         <p class="mtdTitle fs-xs m-0">
                                             {{ ucwords(str_replace('_', ' ', $i)) }}</p>
                                     </div>
                                     <div class="my-auto pl-5">
                                         <span class="text-danger fs-sm d-block fw-semibold d-none"
                                             id="infoChannel-{{ $it->id }}"></span>

                                     </div>

                                 </div>
                                 <div class="produkPrice d-flex justify-content-end my-auto">
                                     <span class="text-currency d-block fs-sm fw-semibold text-end ms-2 me-2 me-md-4">
                                         Rp. -
                                     </span>
                                 </div>
                             </div>
                         </label>
                     </div>
                 @endforeach
             </div>
         </div>
     @endforeach
 </div>

 @push('scripts')
     <script>
         $(document).ready(function() {
             $('.paymentMethod').on('click', function() {
                 $('.loading').show();
                 if (!validateForm()) return;

                 var id = $(this).attr('id');
                 var data = getFormData();
                 data['payment_method'] = id.split('-')[1];
                 console.log('{{ $brand->id }}')

                 $('#checkoutModal').modal('show');
                 $('#checkoutModal').on('shown.bs.modal', function() {
                     $('.loading').hide();
                     $('#checkoutIframe').attr('src',
                         "{{ route('purchase.checkout', ['brand' => $brand->id, 'produk' => 'produkk', 'payment' => 'paymentt', 'mail' => 'maill']) }}"
                         .replace('produkk', data.product_id)
                         .replace('paymentt', data.payment_method)
                         .replace('maill', data.email)
                     );
                 });
                 $('#checkoutModal').on('hidden.bs.modal', function() {
                     $('.loading').hide();
                     $('#checkoutIframe').attr('src', '');
                 });
             })

             function getFormData() {
                 var produkType = "{{ $brand->prepost }}";

                 var data = {
                     'product_id': $('input[name="produkId"]:checked').val(),
                     'product_price': $('input[name="produkId"]:checked').data('harga'),
                     'payment_method': $('input[name="paymentMethod"]:checked').val(),
                 };

                 if (produkType === 'prepaid') {
                     data['email'] = $('input[name="email"]').val();
                 } else if (produkType === 'postpaid' || produkType === 'social-media') {
                     data['data_pengguna'] = $('input[name="data_pengguna"]').val();
                 } else if (produkType === 'game-feature') {
                     data['id_pengguna'] = $('input[name="id_pengguna"]').val();
                     data['id_zona'] = $('input[name="id_zona"]').val();
                 }

                 return data;
             }

         })
     </script>
 @endpush
