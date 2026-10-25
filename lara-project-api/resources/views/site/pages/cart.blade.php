@extends('site.layouts.master')

@section('title', 'Cart')

@section('content')
    <main id="main">

        <section class="page-head">
            <div class="container">
                <div class="crumbs"><a href="index.html">Home</a> <span class="sep">›</span> <span>Shopping cart</span>
                </div>
                <h1>Your cart</h1>
                <p>Ready to ship. Free delivery on this order. Estimated arrival 21 – 23 May.</p>
                @if (session('success'))
                    <div
                        style="margin-top: var(--s7); padding: var(--s6); background: linear-gradient(135deg, var(--indigo), var(--card-purple)); color: var(--paper); border-radius: var(--r-lg); position: relative; overflow: hidden">
                        <div
                            style="position: absolute; inset: 0; background-image: radial-gradient(circle at 80% 20%, rgba(255,255,255,0.18) 0, transparent 40%); pointer-events: none">
                        </div>
                        <div style="position: relative">
                            <h5 style="color: var(--paper); font-size: var(--text-xl); margin-bottom: var(--s3)">
                                {{ session('success') }}
                            </h5>
                            <a href="/" class="btn btn--paper">Continue Shopping →</a>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="cart-layout">

                    <div>
                        <div class="cart-list"></div>

                        <div style="margin-top: var(--s5); display: flex; gap: var(--s3); flex-wrap: wrap">
                            <a href="shop.html" class="btn btn--ghost">← Continue shopping</a>
                            <button class="btn btn--ghost">Update cart</button>
                        </div>

                        <!-- Trust strip -->
                        <div
                            style="margin-top: var(--s7); display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--s4); padding: var(--s5); background: var(--bg); border-radius: var(--r)">
                            <div style="display:flex; align-items:center; gap:var(--s3)">
                                <div
                                    style="width:40px; height:40px; background:var(--indigo-soft); color:var(--indigo); border-radius:999px; display:grid; place-items:center; font-size:18px">
                                    ⚡</div>
                                <div>
                                    <div style="font-family:var(--ff-display); font-weight:700; font-size:var(--text-sm)">
                                        Free fast
                                        shipping</div>
                                    <div style="font-family:var(--ff-mono); font-size:11px; color:var(--fg-mute)">2 — 3
                                        business days
                                    </div>
                                </div>
                            </div>
                            <div style="display:flex; align-items:center; gap:var(--s3)">
                                <div
                                    style="width:40px; height:40px; background:var(--indigo-soft); color:var(--indigo); border-radius:999px; display:grid; place-items:center; font-size:18px">
                                    ↺</div>
                                <div>
                                    <div style="font-family:var(--ff-display); font-weight:700; font-size:var(--text-sm)">
                                        30-day free
                                        returns</div>
                                    <div style="font-family:var(--ff-mono); font-size:11px; color:var(--fg-mute)">No
                                        questions asked</div>
                                </div>
                            </div>
                            <div style="display:flex; align-items:center; gap:var(--s3)">
                                <div
                                    style="width:40px; height:40px; background:var(--indigo-soft); color:var(--indigo); border-radius:999px; display:grid; place-items:center; font-size:18px">
                                    ★</div>
                                <div>
                                    <div style="font-family:var(--ff-display); font-weight:700; font-size:var(--text-sm)">
                                        2-year warranty
                                    </div>
                                    <div style="font-family:var(--ff-mono); font-size:11px; color:var(--fg-mute)">On
                                        every
                                        Sprylo order
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <aside class="cart-summary">
                        <h3>Order summary</h3>

                        <div class="cart-line"><span>Subtotal</span><span
                                style="font-family:var(--ff-display); font-weight:600; color:var(--ink)"
                                id="subtotal">$0.00</span>
                        </div>
                        <div class="cart-line"><span>Shipping</span><span style="font-weight: 600"
                                id="shippingCost">$0.00</span></div>
                        <div class="cart-line"><span>Estimated tax</span><span
                                style="font-family:var(--ff-display); font-weight:600; color:var(--ink)"
                                id="tax">$0.00</span>
                        </div>

                        <div class="cart-line is-total"><span>Total</span><span id="total">$0.00</span></div>

                        <a href="javascript:void(0);" class="btn-proceed btn btn--indigo btn--block">Proceed to checkout
                            →</a>

                        <form action="{{ route('orders.store') }}" method="POST" class="checkout-form">
                            @csrf
                            <div class="field-row">
                                <div class="field">
                                    <label for="c-first">Name</label>
                                    <input id="c-first" type="text" name="name" required="" placeholder="Mira">
                                </div>
                                <div class="field">
                                    <label for="c-last">Phone</label>
                                    <input id="c-last" type="tel" name="phone" required=""
                                        placeholder="0151 123 456">
                                </div>
                            </div>
                            <div class="field">
                                <label for="c-topic">Choose a payment method</label>
                                <select id="c-topic" name="payment_method">
                                    <option value="1">Cash on delivery</option>
                                    <option value="2" disabled>bKash</option>
                                    <option value="3" disabled>Visa / Mastercard</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="c-msg">Shipping Address</label>
                                <textarea name="shipping_address" id="c-msg" required="" placeholder="12 Mothijheel, Dhaka-100"></textarea>
                            </div>
                            <input type="hidden" name="items" value="">
                            <button type="submit" class="btn btn--indigo btn--block">Order Now →</button>
                        </form>

                        <div
                            style="display: flex; justify-content: center; gap: var(--s3); margin-top: var(--s5); flex-wrap: wrap">
                            <span
                                style="font-family: var(--ff-mono); font-size: 11px; color: var(--fg-mute); padding: 6px 10px; background: var(--paper); border-radius: 4px">VISA</span>
                            <span
                                style="font-family: var(--ff-mono); font-size: 11px; color: var(--fg-mute); padding: 6px 10px; background: var(--paper); border-radius: 4px">MASTERCARD</span>
                            <span
                                style="font-family: var(--ff-mono); font-size: 11px; color: var(--fg-mute); padding: 6px 10px; background: var(--paper); border-radius: 4px">AMEX</span>
                            <span
                                style="font-family: var(--ff-mono); font-size: 11px; color: var(--fg-mute); padding: 6px 10px; background: var(--paper); border-radius: 4px">PAYPAL</span>
                            <span
                                style="font-family: var(--ff-mono); font-size: 11px; color: var(--fg-mute); padding: 6px 10px; background: var(--paper); border-radius: 4px">APPLE
                                PAY</span>
                        </div>

                        <p
                            style="margin-top: var(--s5); font-size: 11px; font-family: var(--ff-mono); color: var(--fg-mute); text-align: center; line-height: 1.6">
                            Encrypted checkout · SSL secured. Your payment information is never stored on our servers.
                        </p>
                    </aside>

                </div>
            </div>
        </section>

    </main>
@endsection

@section('style')
    <style>
        .checkout-form {
            display: none;
        }
    </style>
@endsection

@section('script')
    @if (session('success'))
        <script>
            cart.emptyCart();
        </script>
    @endif
    <script>
        // Cart
        // =================
        // console.log(cart.getCart());
        var cartList = document.querySelector('.cart-list');

        function printCart() {
            var list = cart.getCart();
            document.querySelector('.checkout-form input[name="items"]').value = JSON.stringify(list);
            var html = '';
            var subtotal = 0;
            list.forEach(item => {
                // let img = item.img ? item.img : 'https://placehold.net/product-400x400.png';
                let img = item.img ? "{{ asset(':img') }}".replace(':img', item.img) :
                    'https://placehold.net/product-400x400.png';
                html += `
            <article class="cart-row">
                <div class="pic"><img
                        src="${img}"
                        alt="" /></div>
                <div class="info">
                    <div class="name">${item.name}</div>
                    <div class="variant">$${item.price}</div>
                </div>
                <div class="qty">
                    <button onclick="decreaseQty(${item.id})" aria-label="Decrease">−</button>
                    <input type="text" value="${item.quantity}" inputmode="numeric" aria-label="Quantity" />
                    <button onclick="increaseQty(${item.id})" aria-label="Increase">+</button>
                </div>
                <span class="subtotal">$${(item.price * item.quantity).toFixed(2)}</span>
                <button class="remove" aria-label="Remove" onclick="removeFromCart(${item.id})">✕</button>
            </article>
            `;
                subtotal += parseFloat(item.price * item.quantity);
            });
            cartList.innerHTML = html;
            document.querySelector('#subtotal').innerText = `$${subtotal.toFixed(2)}`;
            document.querySelector('#shippingCost').innerText = "$" + (subtotal ? 30 : 0).toFixed(2);
            document.querySelector('#tax').innerText = `$${(subtotal * .05).toFixed(2)}`;
            document.querySelector('#total').innerText =
                `$${(subtotal + (subtotal ? 30 : 0) + (subtotal * .05)).toFixed(2)}`;
        }
        printCart();

        function removeFromCart(id) {
            cart.removeItem(id);
            printCart();
            printItemsNumber();
        }

        function increaseQty(id) {
            cart.increaseQuantity(id);
            printCart();
        }

        function decreaseQty(id) {
            cart.decreaseQuantity(id);
            printCart();
            printItemsNumber();
        }

        // Order Form
        // =================
        document.querySelector('.btn-proceed').addEventListener('click', function(e) {
            this.style.display = 'none';
            document.querySelector('.checkout-form').style.display = 'block';
        })
    </script>
@endsection
