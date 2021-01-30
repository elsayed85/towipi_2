<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 text-center">
                <a class="d-block" href="{{ route('home') }}">
                    <img src="{{ getSiteFooterLogo() }}" class="logo" alt="logo">
                </a>
                <ul class="list-unstyled d-flex justify-content-center align-items-center flex-wrap follow-us">
                    <li>
                        <a href="#" class="text-uppercase ml-2 font-weight-bold">follow us</a>
                    </li>
                    <li>
                        <span class="ml-2 text-light font-weight-bold">|</span>
                    </li>
                    <li>
                        <a href="#" class="text-uppercase ml-2 font-weight-bold">contact us</a>
                    </li>
                </ul>
                <ul class="social-media list-unstyled d-flex flex-wrap justify-content-center align-items-center">
                    @foreach ($site_social as $type => $link)
                    <li style="margin-top: 11px;">
                        <a href="{{ $link }}">
                            <img src="{{ asset("img/footer/{$type}.png") }}" alt="{{ $type }}" style="width: 55px;height: 71px;">
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-md-6">
                <ul class="sitemap list-unstyled">
                    @foreach ($footerPages as $page)
                    <li>
                        <a href="{{ route('page' , $page) }}" class="text-uppercase font-weight-bold">
                            {{ $page->title }}
                        </a>
                    </li>
                    @endforeach
                    <li>
                        <a href="{{ route('faq') }}" class="text-uppercase font-weight-bold">
                            {{ trans('site.footer.faqs') }}
                        </a>
                    </li>
                </ul>
                <ul class="payments d-flex flex-wrap list-unstyled">
                    <li>
                        <a href="#">
                            <img src="{{ asset('img/footer/payments/01.png') }}" alt="payment-method">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ asset('img/footer/payments/02.png') }}" alt="payment-method">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ asset('img/footer/payments/03.png') }}" alt="payment-method">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ asset('img/footer/payments/04.png') }}" alt="payment-method">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ asset('img/footer/payments/05.png') }}" alt="payment-method">
                        </a>
                    </li>


                </ul>
            </div>
            <div class="col-12">
                <div class="copyrights text-center font-24">
                    Copyright © {{ date('Y') }} <b>@siteName()</b> All Rights Reserved.
                </div>
            </div>
        </div>
    </div>
</footer>
