 <div class="payment-step-container step-denomination" id="produks">
     <div class="step-title text-primary">
         Pilih Produk
     </div>
     @php
         $processedProduk = $brand->produk
             ->map(function ($item) use ($brand) {
                 $cleanedName = str_ireplace(ucwords(strtolower($brand->name)), '', $item->name);
                 return [
                     'id' => $item->id,
                     'name' => ucwords($cleanedName),
                     'harga_jual' => $item->harga_jual,
                 ];
             })
             ->sortBy('harga_jual');
     @endphp

     <div class="block-content pb-2">
         <div class="row animated fadeIn">
             @foreach ($processedProduk as $item)
                 <div class="col-4 col-md-3 px-2 mb-3 produk">
                     <div class="form-block highlight h-100">
                         <input type="radio" class="form-check-input" id="{{ $item['id'] }}" name="produkId"
                             value="{{ $item['id'] }}" required="" data-harga="{{ $item['harga_jual'] }}">
                         <label class="form-check-label-rounded-lg h-100 py-3 bg-body" for="{{ $item['id'] }}">
                             <div
                                 class="d-flex flex-column text-center justify-content-center align-items-center h-100 ">
                                 <img class="mb-1 " style="width: 35px; height: 35px; object-fit: cover;"
                                     src="{{ $brand->logo_url }}" alt="{{ $item['name'] }}">
                                 <span id="productDenominationTitle_JU330S87"
                                     class="fs-sm fw-semibold">{{ $item['name'] }}</span>
                                 <p class="fs-sm mb-0 mt-1">
                                     {{ 'Rp ' . number_format($item['harga_jual'], 2, ',', '.') }}
                                 </p>
                             </div>
                         </label>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </div>
