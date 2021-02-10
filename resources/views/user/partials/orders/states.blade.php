<ul class="list-unstyled steps-process d-flex align-items-center justify-content-between flex-wrap">
    <li class="@if($order->hasEverHadStatus("placed")) finished-step @endif">
        <span>
            1
        </span>
        <br>
        {{ trans('site.order.status.placed') }}
    </li>
    <li class="@if($order->hasEverHadStatus("confirmed")) finished-step @endif">
        <span>
            2
        </span>
        <br>
        {{ trans('site.order.status.confirmed') }}
    </li>
    <li class="@if($order->hasEverHadStatus("readyforshipping")) finished-step @endif">
        <span>
            3
        </span>
        <br>
        {{ trans('site.order.status.readyforshipping') }}
    </li>
    <li class="@if($order->hasEverHadStatus("shipped")) finished-step @endif">
        <span>
            4
        </span>
        <br>
        {{ trans('site.order.status.shipped') }}
    </li>
    <li class="@if($order->hasEverHadStatus("delivered")) finished-step @endif">
        <span>
            5
        </span>
        <br>
        {{ trans('site.order.status.delivered') }}
    </li>
</ul>
