<ul class="list-unstyled steps-process d-flex align-items-center justify-content-between flex-wrap">
    <li class="@if(isRouteName('user.checkout.index')) current-step @endif"
        onclick="location.replace('{{ route('user.checkout.index') }}')" style="cursor: pointer">
        <span>
            1
        </span>
        <br>
        {{ trans('site.checkout.step1') }}
    </li>
    <li class="@if(isRouteName('user.checkout.shipping')) current-step @endif">
        <span>
            2
        </span>
        <br>
        {{ trans('site.checkout.step2') }}

    </li>
    <li class="@if(isRouteName('user.checkout.payment')) current-step @endif">
        <span>
            3
        </span>
        <br>
        {{ trans('site.checkout.step3') }}

    </li>
    <li class="@if(isRouteName('user.checkout.finalStep')) current-step @endif">
        <span>
            4
        </span>
        <br>
        {{ trans('site.checkout.step4') }}

    </li>
</ul>
