<div class="row">
    <div class="col-md-6">
        <div class="form-inline input-group-multiple">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                </div>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="Email"
                    placeholder="Email" value="{{ auth()->user() ? auth()->user()->email : '' }}" autofocus>
            </div>
            <small class="invalid-feedback d-none" id="emailFeedback"></small>
        </div>
    </div>
</div>
