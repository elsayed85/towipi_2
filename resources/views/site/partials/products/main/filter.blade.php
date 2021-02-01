<div class="product-filters">
    <!-- .filter-box -->
    <form action="{{ route('product.index') }}" method="get">
        <div class="filter-box">
            <h3 class="text-uppercase">
                Category
                <span><i class="fas fa-chevron-down"></i></span>
            </h3>
            <ul class="list-unstyled">
                @foreach ($categories as $category)
                <div class="input-group mb-3 active-filter">
                    <div class="input-group-prepend">
                        <label>
                            <input name="categories[]" type="checkbox" value="{{ $category->id }}" />
                            {{ $category->name }}
                        </label>
                    </div>
                </div>
                @endforeach
            </ul>
            <button class="btn btn-block update-filter">@lang('site.update')</button>
        </div>
    </form>
</div>
