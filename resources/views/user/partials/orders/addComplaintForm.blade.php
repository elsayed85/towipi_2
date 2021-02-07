<div class="modal fade" id="addComplaint-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="addComplaint"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('site.file_complant') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('user.orders.add_complaint' , ['order' => $order , 'item' => $item]) }}"
                    id="complaint_form_{{ $item->id }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ trans('site.product_complaint_content') }}</label>
                        <textarea name="content" class="form-control" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('site.cancel') }}</button>
                <button type="submit" onclick="document.getElementById('complaint_form_{{ $item->id }}').submit()"
                    class="btn btn-primary">{{ trans('site.send') }}</button>
            </div>
        </div>
    </div>
</div>
