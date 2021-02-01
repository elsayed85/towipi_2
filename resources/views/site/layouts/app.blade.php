<!DOCTYPE html>
<html lang="{{ getCurrentLocale() }}" dir="{{ getCurrentLocaleDirection() }}">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}" />
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <!-- aos cdn -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    @yield('css')
    @livewireStyles
    <style>
        .invalid-feedback {
            display: block;
        }
    </style>

    <title>
        @yield('title', getSiteName())
    </title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <form action="{{ route('logout') }}" method="post" id="logout_form">@csrf</form>

    <main>
        @include('site.partials.header')
        @yield('content')
    </main>

    @include('site.partials.footer')

    <!-- Jquery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- bootstrap -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- aos -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- nice scroll -->
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    <!-- Main Scripts -->
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script src="{{ asset('js/sweetalert2@10.js') }}"></script>
    <script src="//code.tidio.co/rw3ukwxdtobrfotxlqun6b6sfb8krcet.js" async></script>

    @yield('js')
    @livewireScripts

    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    @if(session()->has('success'))
    Toast.fire({
        type: 'success',
        title: '{{ session("success") }}'
    })
    @endif

    @if(session()->has('failed'))
    Toast.fire({
        type: 'error',
        title: '{{ session("failed") }}'
    })
    @endif

    window.addEventListener('added_to_wislist', event => {
        var data = event.detail;
        $(".wishlist_ul").append(`
        <li class="d-flex justify-content-between align-items-center" id="product_` + data.product_id + `">
            <a href="` + data.url + `">
                ` + data.product_title + `
            </a>
            <a href="#" class="text-danger delete-cart-btn remove_wishlist_elemnt" data-product-id=` + data.product_id  + ` onclick="removeWishlistElement(this)">
                <i class="far fa-times-circle"></i>
            </a>
        </li>
        `)
        $(".wishlist_count").text(data.count)
        Toast.fire({
            type: 'success',
            title: data.message
        })
    });

    window.addEventListener('removed_from_wislist', event => {
        var data = event.detail;
        $(".wishlist_ul #product_" + data.product_id).remove()
        $(".wishlist_count").text(data.count)
        Toast.fire({
            type: 'success',
            title: data.message
        })
    });

    function removeWishlistElement(el){
        var product_id = $(el).data('product-id')
        var wishlistCounter = $(".wishlist_count")
        $.ajax({
            type:'POST',
            url:'{{ route('user.wishlist.destroy_ajax') }}',
            data: {
                _token : "{{ csrf_token() }}",
                product_id : product_id
            },
            success:function(data) {
                if(data['success'] == true){
                    $(el).parent().remove()
                    wishlistCounter.text(data.wishlist_count)
                }
            }
        });
    }
    </script>
</body>

</html>
