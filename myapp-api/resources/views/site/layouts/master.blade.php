<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title')</title>
  <meta name="description" content="Sprylo is a free modern HTML template for tech and electronics stores — multi-color bento hero, indigo primary palette, Plus Jakarta + Outfit + Roboto Mono pair, 5 fully responsive pages, no framework, no build step." />
  <meta name="theme-color" content="#4F46E5" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Outfit:wght@400;500;600;700&family=Roboto+Mono:wght@400;500&display=swap" />
  <link rel="stylesheet" href="{{ asset('assets-site/css/styles.css') }}" />
</head>
@yield('style')
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

  <!-- Header -->
  @include('site.layouts.header')

  <!-- Category nav -->
  @include('site.layouts.navbar')

  <!-- Mobile drawer -->
 @include('site.layouts.mobile-drawer')

 @yield('content')

  <!-- FOOTER -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="mark"><span class="brand-mark">S</span> Sprylo</div>
          <p>Modern tech &amp; gadgets — straight from the makers, shipped fast, supported well. Since 2018, we've moved over 400,000 boxes.</p>
          <div class="socials" style="margin-top:var(--s4)">
            <a href="#" aria-label="Twitter"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M22 5.8a8.5 8.5 0 0 1-2.4.7 4.2 4.2 0 0 0 1.8-2.3 8.4 8.4 0 0 1-2.6 1 4.2 4.2 0 0 0-7.2 3.8A11.9 11.9 0 0 1 3 4.8a4.2 4.2 0 0 0 1.3 5.6 4.2 4.2 0 0 1-1.9-.5v.1a4.2 4.2 0 0 0 3.4 4.1 4.2 4.2 0 0 1-1.9.1 4.2 4.2 0 0 0 3.9 2.9A8.4 8.4 0 0 1 2 18.7 11.9 11.9 0 0 0 8.5 21c7.7 0 11.9-6.4 11.9-11.9v-.5A8.5 8.5 0 0 0 22 5.8z"/></svg></a>
            <a href="#" aria-label="LinkedIn"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zM8 18H5v-7h3v7zM6.5 9.7a1.7 1.7 0 1 1 0-3.4 1.7 1.7 0 0 1 0 3.4zM18 18h-3v-4c0-1-.4-1.6-1.4-1.6S12 13 12 14v4H9v-7h3v1c.5-.8 1.4-1.2 2.4-1.2 2 0 3.6 1.4 3.6 4V18z"/></svg></a>
            <a href="#" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg></a>
            <a href="#" aria-label="YouTube"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23 7s-.2-1.5-.9-2.2c-.8-.9-1.8-.9-2.2-1C16.6 3.5 12 3.5 12 3.5s-4.6 0-7.9.3c-.4 0-1.4 0-2.2 1C1.2 5.5 1 7 1 7s-.2 1.7-.2 3.5v1.6c0 1.7.2 3.5.2 3.5s.2 1.5.9 2.2c.8.9 1.9.8 2.4.9 1.7.2 7.7.3 7.7.3s4.6 0 7.9-.3c.4 0 1.4 0 2.2-1 .7-.7.9-2.2.9-2.2s.2-1.7.2-3.5V10.5c0-1.7-.2-3.5-.2-3.5zM9.7 14.5V8.4l6 3-6 3.1z"/></svg></a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Popular Categories</h4>
          <ul>
            <li><a href="shop.html">Laptops &amp; Desktops</a></li>
            <li><a href="shop.html">Smart Home Electronics</a></li>
            <li><a href="shop.html">Smart Watches</a></li>
            <li><a href="shop.html">Headphones</a></li>
            <li><a href="shop.html">Internal Components</a></li>
            <li><a href="shop.html">Virtual Reality Headsets</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Let us help you</h4>
          <ul>
            <li><a href="#">My account</a></li>
            <li><a href="#">My order</a></li>
            <li><a href="#">Shipping policy</a></li>
            <li><a href="#">Help centre</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="#">Popular products</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Resources</h4>
          <ul>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Newsletter</a></li>
            <li><a href="#">Help centre</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#">Reviews</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Get to know us</h4>
          <ul>
            <li><a href="#">About us</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="#">Login / Register</a></li>
            <li><a href="#">Terms &amp; conditions</a></li>
            <li><a href="#">Privacy policy</a></li>
            <li><a href="#">FAQs</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <span>© 2026 Sprylo · All rights reserved</span>
        <span>Free HTML template · No framework · No build step. Distributed by <a href="https://themewagon.com/" target="_blank">ThemeWagon</a></span>
      </div>
    </div>
  </footer>

  <script src="{{ asset('assets-site/js/main.js') }}" defer></script>
  <script src="{{ asset('helpers/cart-helper.js') }}"></script>
  <script>
     const cart = new CartHelper('MyCart');
    //  cart.addItem(1,"Galaxy S24", 1000);
    function addToCart(id, name, price,image) {
      // alert(name + " added to cart");
      cart.addItem(id, name, price,image);
      printItemsNumber();
    }
    // console.log(cart.countItems());
    function printItemsNumber() {
        document.querySelector('.icon-btn--cart .count').innerText = cart.countItems();
    }
    printItemsNumber();
   
  </script>
  @yield('script')
</body>
</html>
