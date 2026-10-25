@extends('site.layouts.master')

@section('title', 'Home')

@section('content')
    <main id="main">

        <!-- HERO: bento grid -->
        <section class="hero">
            <div class="container">
                <div class="bento">

                    <article class="bento-card bento-card--lg">
                        <div class="sparkle"></div>
                        <div>
                            <span class="eyebrow">⚡ Audio &middot; Featured</span>
                            <h2>Apple HomePod<br />2nd Gen Speaker</h2>
                            <p>Apple ecosystem with high-quality audio playback while serving as a hub for controlling
                                smart home devices. Spatial audio, room-sensing tech.</p>
                            <a href="product.html" class="btn btn--paper">Shop Now
                                <svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <div class="dots"><span class="active"></span><span></span><span></span></div>
                        </div>
                        <img class="product"
                            src="https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=900&q=80&auto=format&fit=crop"
                            alt="HomePod speaker" />
                    </article>

                    <article class="bento-card bento-card--purple">
                        <div class="sparkle"></div>
                        <span class="eyebrow">Wearables</span>
                        <h3 style="font-size:var(--text-xl); line-height:1.15">Explore<br />Apple Watch</h3>
                        <a href="product.html" class="shop-now">Shop Now
                            <svg width="12" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true">
                                <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.6"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <img class="product"
                            src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&q=80&auto=format&fit=crop"
                            alt="Apple Watch" />
                    </article>

                    <article class="bento-card bento-card--teal">
                        <div class="sparkle"></div>
                        <span class="eyebrow">Latest Phones</span>
                        <h3 style="font-size:var(--text-xl); line-height:1.15">Galaxy S24<br />Ultra · 5G</h3>
                        <a href="product.html" class="shop-now">Shop Now
                            <svg width="12" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true">
                                <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.6"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <img class="product"
                            src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=600&q=80&auto=format&fit=crop"
                            alt="Samsung Galaxy phone" />
                    </article>

                    <div class="bento-row">
                        <article class="bento-card bento-card--orange">
                            <div class="sparkle"></div>
                            <span class="eyebrow">Cameras</span>
                            <h3 style="font-size:var(--text-lg); line-height:1.2">Samsung<br />Gear Camera</h3>
                            <a href="product.html" class="shop-now">Shop Now
                                <svg width="12" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <img class="product"
                                src="https://images.unsplash.com/photo-1606983340126-99ab4feaa64a?w=500&q=80&auto=format&fit=crop"
                                alt="Camera" />
                        </article>

                        <article class="bento-card bento-card--green">
                            <div class="sparkle"></div>
                            <span class="eyebrow">Audio</span>
                            <h3 style="font-size:var(--text-lg); line-height:1.2">Beats<br />Studio Buds</h3>
                            <a href="product.html" class="shop-now">Shop Now
                                <svg width="12" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <img class="product"
                                src="https://images.unsplash.com/photo-1606220945770-b5b6c2c55bf1?w=500&q=80&auto=format&fit=crop"
                                alt="Earbuds" />
                        </article>

                        <article class="bento-card bento-card--black">
                            <div class="sparkle"></div>
                            <span class="eyebrow">DSLR</span>
                            <h3 style="font-size:var(--text-lg); line-height:1.2">Hero Camera<br />X-Series</h3>
                            <a href="product.html" class="shop-now">Shop Now
                                <svg width="12" height="10" viewBox="0 0 14 10" fill="none"
                                    aria-hidden="true">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <img class="product"
                                src="https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=500&q=80&auto=format&fit=crop"
                                alt="DSLR camera" />
                        </article>
                    </div>

                </div>
            </div>
        </section>

        <!-- LATEST PRODUCTS -->
        <section class="section" style="padding-top: var(--s5)">
            <div class="container">
                <div class="section-head">
                    <h2>Latest Products</h2>
                    <a href="shop.html" class="view-all">View all
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none">
                            <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>

                <div class="tabs" role="tablist">

                    <!-- Mobile Tab -->
                    <button class="tab is-active" type="button" role="tab" aria-selected="true"
                        data-target="#mobile-products">
                        Mobile
                    </button>

                    <!-- Watch Tab -->
                    <button class="tab" type="button" role="tab" aria-selected="false"
                        data-target="#watch-products">
                        Watch
                    </button>

                    <!-- Camera Tab -->
                    <button class="tab" type="button" role="tab" aria-selected="false"
                        data-target="#camera-products">
                        Camera
                    </button>

                    <!-- Accessories Tab -->
                    <button class="tab" type="button" role="tab" aria-selected="false"
                        data-target="#accessories-products">
                        Accessories
                    </button>

                    <!-- Speaker Tab -->
                    <button class="tab" type="button" role="tab" aria-selected="false"
                        data-target="#speaker-products">
                        Speaker
                    </button>

                </div>


                <!-- =====================================================
                     MOBILE PRODUCTS
                ===================================================== -->

                <div class="products tab-pane" id="mobile-products">

                    @forelse ($mobiles as $item)
                        <x-site.product-card :item="$item" />
                    @empty
                        <div>No products found</div>
                    @endforelse

                </div>


                <!-- =====================================================
                     WATCH PRODUCTS
                ===================================================== -->

                <div class="products tab-pane" id="watch-products">

                    @forelse ($watches as $item)
                        <x-site.product-card :item="$item" />
                    @empty
                        <div>No products found</div>
                    @endforelse

                </div>


                <!-- =====================================================
                     CAMERA PRODUCTS
                ===================================================== -->

                <div class="products tab-pane" id="camera-products">

                    @forelse ($cameras as $item)
                        <x-site.product-card :item="$item" />
                    @empty
                        <div>No products found</div>
                    @endforelse

                </div>


                <!-- =====================================================
                     ACCESSORIES PRODUCTS
                ===================================================== -->

                <div class="products tab-pane" id="accessories-products">

                    @forelse ($accessories as $item)
                        <x-site.product-card :item="$item" />
                    @empty
                        <div>No products found</div>
                    @endforelse

                </div>


                <!-- =====================================================
                     SPEAKER PRODUCTS
                ===================================================== -->

                <div class="products tab-pane" id="speaker-products">

                    @forelse ($speakers as $item)
                        <x-site.product-card :item="$item" />
                    @empty
                        <div>No products found</div>
                    @endforelse

                </div>

            </div>
        </section>

        <!-- DISCOUNT BANNERS -->
        <section class="section" style="padding-top:0">
            <div class="container">
                <div class="discount-row">
                    <article class="discount-card discount-card--watch">
                        <span class="meta">THIS WEEK ONLY</span>
                        <h3>Mega Discounts<br /><span class="pct">50% Off</span></h3>
                        <a href="shop.html" class="shop-now">Shop Now
                            <svg width="14" height="10" viewBox="0 0 14 10" fill="none">
                                <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <img class="product"
                            src="https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=500&q=80&auto=format&fit=crop"
                            alt="Smart watch" />
                    </article>
                    <article class="discount-card discount-card--airpods">
                        <span class="meta">LIMITED EDITION</span>
                        <h3>Studio Buds Pro<br /><span class="pct">30% Off</span></h3>
                        <a href="shop.html" class="shop-now">Shop Now
                            <svg width="14" height="10" viewBox="0 0 14 10" fill="none">
                                <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <img class="product"
                            src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=500&q=80&auto=format&fit=crop"
                            alt="Earbuds" />
                    </article>
                </div>
            </div>
        </section>

        <!-- CATEGORIES grid -->
        <section class="section" style="padding-top: var(--s5)">
            <div class="container">
                <div class="section-head">
                    <h2>Shop by category</h2>
                    <a href="shop.html" class="view-all">View all products
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none">
                            <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="cats-grid">
                    <a href="shop.html" class="cat-tile">
                        <div class="pic"><img
                                src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&q=80&auto=format&fit=crop"
                                alt="" /></div>
                        <div class="name">Watch</div>
                        <div class="count">28 Products</div>
                    </a>
                    <a href="shop.html" class="cat-tile">
                        <div class="pic"><img
                                src="https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=300&q=80&auto=format&fit=crop"
                                alt="" /></div>
                        <div class="name">Camera</div>
                        <div class="count">42 Products</div>
                    </a>
                    <a href="shop.html" class="cat-tile">
                        <div class="pic"><img
                                src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=300&q=80&auto=format&fit=crop"
                                alt="" /></div>
                        <div class="name">Smart Phone</div>
                        <div class="count">76 Products</div>
                    </a>
                    <a href="shop.html" class="cat-tile">
                        <div class="pic"><img
                                src="https://images.unsplash.com/photo-1592840496694-26d035b52b48?w=300&q=80&auto=format&fit=crop"
                                alt="" /></div>
                        <div class="name">Accessories</div>
                        <div class="count">112 Products</div>
                    </a>
                    <a href="shop.html" class="cat-tile">
                        <div class="pic"><img
                                src="https://images.unsplash.com/photo-1606220945770-b5b6c2c55bf1?w=300&q=80&auto=format&fit=crop"
                                alt="" /></div>
                        <div class="name">Smart Buds</div>
                        <div class="count">35 Products</div>
                    </a>
                </div>
            </div>
        </section>

        <!-- COMPACT row (4 cards in 2x2 layout) -->
        <section class="section" style="padding-top:0">
            <div class="container">
                <div class="section-head">
                    <h2>Just for you</h2>
                    <a href="shop.html" class="view-all">More picks
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none">
                            <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="compact-row">
                    <article class="compact-card">
                        <div class="pic"><img
                                src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=300&q=80&auto=format&fit=crop"
                                alt="" /></div>
                        <div>
                            <div class="stock">IN STOCK · 12</div>
                            <div class="name">Apple Airpods V57</div>
                            <div class="price">$680</div>
                            <a href="cart.html" class="btn">Order Now</a>
                        </div>
                    </article>
                    <article class="compact-card">
                        <div class="pic"><img
                                src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=300&q=80&auto=format&fit=crop"
                                alt="" /></div>
                        <div>
                            <div class="stock">IN STOCK · 8</div>
                            <div class="name">Apple MacBook Pro</div>
                            <div class="price">$2,780</div>
                            <a href="cart.html" class="btn">Order Now</a>
                        </div>
                    </article>
                    <article class="compact-card">
                        <div class="pic"><img
                                src="https://images.unsplash.com/photo-1592840496694-26d035b52b48?w=300&q=80&auto=format&fit=crop"
                                alt="" /></div>
                        <div>
                            <div class="stock">IN STOCK · 24</div>
                            <div class="name">Power Wired Controller</div>
                            <div class="price">$190</div>
                            <a href="cart.html" class="btn">Order Now</a>
                        </div>
                    </article>
                    <article class="compact-card">
                        <div class="pic"><img
                                src="https://images.unsplash.com/photo-1527814050087-3793815479db?w=300&q=80&auto=format&fit=crop"
                                alt="" /></div>
                        <div>
                            <div class="stock">IN STOCK · 36</div>
                            <div class="name">Gaming Mouse Pro</div>
                            <div class="price">$190</div>
                            <a href="cart.html" class="btn">Order Now</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- BRAND STRIP -->
        <section class="brands">
            <div class="container">
                <div class="brand-row">
                    <a href="#" class="brand-logo">HP</a>
                    <a href="#" class="brand-logo">Huawei</a>
                    <a href="#" class="brand-logo">Nokia</a>
                    <a href="#" class="brand-logo">Samsung</a>
                    <a href="#" class="brand-logo">Canon</a>
                    <a href="#" class="brand-logo">Sony</a>
                </div>
            </div>
        </section>

        <!-- NEWSLETTER -->
        <section style="background: var(--paper)">
            <div class="container">
                <div class="newsletter">
                    <div class="newsletter-grid">
                        <div>
                            <h2>Get <strong>20% Off</strong> your first order — straight to your inbox.</h2>
                            <p>Drop your email and we'll send a one-time discount, plus first-look offers on the gear we
                                just got in. Unsubscribe anytime.</p>
                        </div>
                        <form class="newsletter-form"
                            onsubmit="event.preventDefault(); this.querySelector('button').textContent='Sent ✓';">
                            <input type="email" required placeholder="Enter your email" aria-label="Email address" />
                            <button class="btn" type="submit">Subscribe →</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection


<!-- =====================================================
         TAB JAVASCRIPT
    ===================================================== -->
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const tabs = document.querySelectorAll(".tab");
            const panes = document.querySelectorAll(".tab-pane");

            // Hide every pane except Mobile
            panes.forEach(function(pane) {
                if (pane.id !== "mobile-products") {
                    pane.style.display = "none";
                }
            });

            tabs.forEach(function(tab) {

                tab.addEventListener("click", function() {

                    const targetSelector = this.getAttribute("data-target");
                    const targetPane = document.querySelector(targetSelector);

                    if (!targetPane) {
                        return;
                    }

                    // Remove active state from all tabs
                    tabs.forEach(function(item) {
                        item.classList.remove("is-active");
                        item.setAttribute("aria-selected", "false");
                    });

                    // Add active state to clicked tab
                    this.classList.add("is-active");
                    this.setAttribute("aria-selected", "true");

                    // Hide all product sections
                    panes.forEach(function(pane) {
                        pane.style.display = "none";
                    });

                    // Show selected product section
                    targetPane.style.display = "";
                });

            });

        });
    </script>
@endsection
