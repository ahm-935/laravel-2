<!-- Mobile drawer -->
  <div class="drawer" id="drawer" aria-hidden="true">
    <div class="drawer-head">
      <a href="index.html" class="brand"><span class="brand-mark">S</span> Sprylo</a>
      <button class="drawer-close" aria-label="Close menu">Close ✕</button>
    </div>
    <a href="{{ route('home') }}">Home</a>
    <a href="shop.html">Shop</a>
    <a href="product.html">Products</a>
    <a href="{{ route('cart') }}">Cart</a>
    <a href="contact.html">Contact</a>
    <a href="cart.html" class="btn btn--indigo" style="margin-top:var(--s5); justify-content:center">View cart →</a>
  </div>