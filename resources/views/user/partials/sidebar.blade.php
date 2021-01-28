<ul class="list-group text-left">
    <li class="list-group-item d-flex align-items-center pt-4 pb-4">
        <i class="fas fa-user-circle user-icon main-color"></i>
        <span class="font-weight-600 secondary-color d-flex flex-column ml-2">
            <span class="name font-12">{{ auth()->user()->name }}</span>
            <span class="email font-9">{{ auth()->user()->email }}</span>
        </span>
    </li>
    <li class="list-group-item @if(isRoute(route('user.orders.index'))) active @endif">
        <a href="{{ route('user.orders.index') }}">
            <i class="fas fa-shopping-cart"></i> {{ trans('site.user.orders') }}
        </a>
    </li>
    <li class="list-group-item @if(isRoute(route('user.wishlist.index'))) active @endif">
        <a href="{{ route('user.wishlist.index') }}">
            <i class="fas fa-heart"></i> {{ trans('site.user.wishlist') }}
        </a>
    </li>
    <li class="list-group-item @if(isRoute(route('user.profile.index'))) active @endif">
        <a href="{{ route('user.profile.index') }}">
            <i class="fas fa-user"></i> {{ trans('site.user.profile.name') }}
        </a>
    </li>
    <li class="list-group-item @if(isRoute(route('user.address.index'))) active @endif">
        <a href="{{ route('user.address.index') }}">
            <i class="fas fa-map-marker-alt"></i> {{ trans('site.user.shipping_address') }}
        </a>
    </li>

</ul>
