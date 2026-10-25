<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <meta name="description"
        content="Sprylo is a free modern HTML template for tech and electronics stores — multi-color bento hero, indigo primary palette, Plus Jakarta + Outfit + Roboto Mono pair, 5 fully responsive pages, no framework, no build step." />
    <meta name="theme-color" content="#4F46E5" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Outfit:wght@400;500;600;700&family=Roboto+Mono:wght@400;500&display=swap" />
    <link rel="stylesheet" href={{ asset('assets-site/css/styles.css') }} />
    @yield('style')
</head>

<body>
    <a class="skip-link" href="#main">Skip to content</a>

    <!-- Top utility strip -->
    <div class="utility">
        <div class="container">
            <span class="promo">
                <span class="tag">SALE</span>
                Free shipping on orders over $50 · 30-day returns
            </span>
            <span class="links">
                <a href="#">Track order</a>
                <a href="#">Help</a>
                <a href="#">EN · USD</a>
            </span>
        </div>
    </div>

    @include('site.layouts.header')
    @include('site.layouts.navbar')
    @include('site.layouts.mobile-drawer')

    @yield('content')

    @include('site.layouts.footer')

    <script src={{ asset('assets-site/js/main.js') }} defer></script>
    <script src={{ asset('helpers/cart-helper.js') }}></script>
    <script>
        const cart = new CartHelper('laraCart');
        function addToCart(id,name,price,img) {
            cart.addItem(id,name,price,img);
            printItemsNumber();
        }
        // console.log(cart.countItems());
        function printItemsNumber(){
            document.querySelector('.icon-btn--cart .count').innerText = cart.countItems();
        }
        printItemsNumber();
    </script>

    @yield('script')
</body>

</html>
