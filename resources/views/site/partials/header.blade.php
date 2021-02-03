<header>
    <!-- .navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark primary-bg-color top-header ">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto  align-md-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user font-26"></i>
                        </a>
                        @guest
                        <div class="dropdown-menu text-center mb-0" aria-labelledby="navbarDropdown">
                            <a class="btn btn-sm btn-outline-dark rounded-pill " href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt mr-1"></i> {{ trans('site.login') }}
                            </a>
                            <span class="position-relative d-block mt-4 mb-3 or-divider">
                                <span
                                    class="badge badge-pill badge-light position-absolute">{{ trans('site.or') }}</span>
                            </span>
                            <a href="{{ route('register') }}" class="text-dark text-uppercase">
                                <i class="fas fa-user-plus mr-1"></i> {{ trans('site.register') }}
                            </a>
                        </div>
                        @endguest
                        @auth
                        <div class="dropdown-menu text-center mb-0" aria-labelledby="navbarDropdown">
                            @role('user')
                            <a class="btn btn-sm btn-outline-dark rounded-pill " href="{{ route('user.home') }}">
                                <i class="fas fa-sign-in-alt mr-1"></i>{{ trans('site.dashboard') }}
                            </a>
                            @endrole

                            @role(['admin' ,'super_admin'])
                            <a class="btn btn-sm btn-outline-dark rounded-pill " href="{{ route('admin.home') }}">
                                <i class="fas fa-sign-in-alt mr-1"></i>{{ trans('site.dashboard') }}
                            </a>
                            @endrole

                            <a class="btn btn-sm btn-outline-dark rounded-pill "
                                onclick="document.getElementById('logout_form').submit()">
                                <i class="fas fa-sign-in-alt mr-1"></i>{{ trans('site.logout') }}
                            </a>
                        </div>
                        @endauth
                    </li>

                    @auth
                    @include('site.partials.wishlist_dropdown')

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-shopping-cart font-26"></i>
                            <span class="count-cart count">{{ $cart->count() }}</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <ul class="list-unstyled w-100 favorites-list cart-list">
                                <li class="d-flex justify-content-between align-items-center pb-2">
                                    <h6 class="font-13 mb-0">
                                        {{ trans('site.cart.name') }} <i class="fas fa-shopping-cart ml-1"></i>
                                    </h6>
                                    <span class="font-12 badge badge-dark">
                                        {{ $cart->count() }}
                                    </span>
                                    <form action="{{ route('user.cart.clear') }}" method="post">
                                        @csrf
                                        <button class="btn btn-primary btn-sm text-center" type="submit">Clear</button>
                                    </form>
                                </li>
                                @foreach ($cart as $item)
                                @if($product = $item->model)
                                <li class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('product.show' , $product) }}">
                                        {{ $product->title }}
                                    </a>
                                    <form action="{{ route('user.cart.remove' , $item->rowId) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="text-danger delete-cart-btn btn">
                                            <i class="far fa-times-circle"></i>
                                        </button>
                                    </form>
                                </li>
                                @endif
                                @endforeach

                                @if($cart->count())
                                <a href="{{ route('user.checkout.index') }}">
                                    <button class="btn btn-primary btn-block text-center">checkout</button>
                                </a>
                                @else
                                {{ trans('site.cart.is_empty') }}
                                @endif
                            </ul>
                        </div>

                    </li>
                    @endauth

                    <li class="nav-item dropdown languages-toggler">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-globe-europe"></i> {{ strtoupper(getCurrentLocale()) }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach(getSupportedLocales() as $localeCode => $properties)
                            @if($localeCode != getCurrentLocale())
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode ,  null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </li>
                </ul>
                <form class="form-inline search-form" action="{{ route('product.index') }}">
                    <input name="product_title" value="{{ request('product_title') }}" class="form-control mr-sm-2"
                        type="search" placeholder="{{ trans('site.search.placeholder') }}" aria-label="Search">

                    <button class="search-form-btn my-2 my-sm-0" type="submit">
                        <i class="fa fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- ./navbar -->

    <!-- .twoipi-navbar -->
    <nav class="twoipi-navbar">
        <div class="container">
            <div class="row justify-content-center align-items-center flex-wrap">
                <div class="col-12 col-md-3">
                    <a href="{{ route('category.index' , ['category' => "cake-tools"]) }}" class="btn-pink mr-md-3">
                        {{ trans('site.menu.cake_tools') }}
                    </a>
                </div>
                <div class="col-12 col-md-2">
                    <a href="{{ route('home') }}" class="nav-logo">
                        <img src="{{ getSiteNavLogo() }}" alt="towipi-logo">
                    </a>
                </div>
                <div class="col-12 col-md-3">
                    <a href="{{ route('category.index' , ['category' => "party-supplies"]) }}" class="btn-pink ml-md-3">
                        {{ trans('site.menu.party_supplies') }}
                    </a>
                </div>
            </div>
            <div class="mt-3">
                <ul class="list-unstyled d-flex justify-content-center align-items-center flex-wrap">
                    <li>
                        <a href="{{ route('home') }}" class="btn-blue">{{ trans('site.nav.home') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('page' , "about-us") }}" class="btn-blue">{{ trans('site.nav.about') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('page' , "contact-us") }}"
                            class="btn-blue">{{ trans('site.nav.contact') }}</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <!-- .twoipi-navbar -->
</header>
