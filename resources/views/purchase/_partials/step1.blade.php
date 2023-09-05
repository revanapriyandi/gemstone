<div class="payment-step-container step-input-id mt-lg-0" id="step1">
    <div class="step-title text-primary">
        Masukkan Data Akun
    </div>
    @if ($brand->prepost == 'prepaid')
        @include('purchase._partials.step1.step-prepaid')
    @elseif($brand->prepost == 'game-feature')
        @include('purchase._partials.step1.step-game-feature')
    @elseif($brand->prepost == 'social-media')
        @include('purchase._partials.step1.step-social-media')
    @endif
    <small class="step-input-description">
        {!! $brand->deskripsi_field !!}
    </small>
</div>
