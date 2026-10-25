<article class="product-card">

    <a href="{{ route('product-details',  $item->id) }}">
        <div class="img-wrap">
            <span class="badge">New</span>

            <button class="wishlist" aria-label="Wishlist">
                ♡
            </button>
            @if($item->image)
                <img src="{{ asset($item->image) }}" alt="Product img" class="table-user-avatar">
            @else
                <img src="https://placehold.net/product-400x400.png" alt="Product img" class="table-user-avatar"
                    onerror="this.src = 'assets/images/avatar.png'">
            @endif
        </div>

        <div class="stock">
            <span class="dot"></span>
            In stock · {{ $item->quantity }} items
        </div>

        <a class="name">
            {{$item->name}}
        </a>

        <div class="price">
            <span class="now">${{ $item->price }}</span>
        </div>

        <div class="stars">
            ★★★★★
            <span class="count">(56)</span>
        </div>
    </a>
    <a href="javascript:void(0)" onclick="addToCart({{ $item->id }},'{{ $item->name }}', {{ $item->price }}, '{{ $item->image ?? '' }}')" class="btn">
        Add to Cart →
    </a>

</article>