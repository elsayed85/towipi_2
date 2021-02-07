<form action="{{ route('user.orders.add_rate' , ['order' => $order ,'item' => $item]) }}" method="POST">
    @csrf
    <label class="mb-0">{{ trans('site.rate_product_msg') }}</label>
    <select name="rate_value" id="rate" class="form-control mb-2 mt-2">
        <option value="1" @if(old('rate_value')==1) selected @endif>1
            {{ trans('site.star') }}</option>
        <option value="2" @if(old('rate_value')==2) selected @endif>2
            {{ trans('site.star') }}</option>
        <option value="3" @if(old('rate_value')==3) selected @endif>3
            {{ trans('site.star') }}</option>
        <option value="4" @if(old('rate_value')==4) selected @endif>4
            {{ trans('site.star') }}</option>
        <option value="5" @if(old('rate_value')==5) selected @endif>5
            {{ trans('site.star') }}</option>
    </select>
    @error('rate_value')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <div class="form-group">
        <textarea name="review" class="form-control " id="note" rows="2">{{ old('review') }}</textarea>
        @error('review')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button class="btn btn-sm btn-danger font-11 rounded-pill">{{ trans('site.rate') }}</button>
</form>
