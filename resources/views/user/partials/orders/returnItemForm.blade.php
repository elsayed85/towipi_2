<div class="modal fade" id="returnItemForm-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="returnItemForm"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('site.return_item.text') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('user.orders.return_item' , ['order' => $order , 'item' => $item]) }}"
                    id="return_item_form_{{ $item->id }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ trans('site.return_item.message') }}</label>
                        <textarea name="message" class="form-control" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('site.cancel') }}</button>
                <button type="submit" onclick="document.getElementById('return_item_form_{{ $item->id }}').submit()"
                    class="btn btn-primary">{{ trans('site.send') }}</button>
            </div>
        </div>
    </div>
</div>
