@extends('user.base.base')

@push('styles')
  {{-- <link rel="stylesheet" href="{{ asset('css/user/product-details.css') }}"> --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  
<style>

.product-card {
     max-width: 1200px;
     margin: auto;
     padding: 30px;
     background: #ffffff;
     border-radius: 10px;
     box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
     display: flex;
     flex-wrap: wrap;
     gap: 30px;
     align-items: flex-start;
 }
/* .product-card img{
    width: 100%;
    max-width: 400px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    object-fit: cover;
    transition: transform 0.3s ease;
} */
.product-image {
    width: 100%;
    max-width: 400px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-image:hover {
    transform: scale(1.02);
}

        .product-info {
            flex: 1;
            min-width: 280px;
        }

        .product-info h2 {
            font-size: 36px;
            color: #0f172a;
            font-weight: 700;
            /* border-bottom: 3px solid #3b82f6; */
            display: inline-block;
            padding-bottom: 4px;
            margin-bottom: 12px;
        }

        h3 {
            margin-top: 24px;
            margin-bottom: 8px;
            color: #1f2937;
            font-size: 20px;
        }

        .product-info p,
        ul {
            font-size: 16px;
            line-height: 1.6;
            color: #374151;
        }

        ul {
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 6px;
        }

        .product-controls {
            margin-top: 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        .quantity-control {
            display: flex;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
            background: #f8fafc;
        }

        .quantity-control button {
            background: #e2e8f0;
            padding: 8px 14px;
            border: none;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .quantity-control button:hover {
            background: #cbd5e1;
        }

        .quantity-control input {
            width: 50px;
            text-align: center;
            border: none;
            outline: none;
            background: transparent;
            font-size: 16px;
        }

        .add-to-cart {
            background-color: #2563eb;
            color: white;
            padding: 10px 20px;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-to-cart:hover {
            background-color: #1d4ed8;
        }

        .wishlist {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .wishlist-filled {
        color: #ef4444;
    }

    .wishlist:hover {
        transform: scale(1.2);
    }

        .summary-box,
        .description-box {
            background: #f9fafb;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .summary-box h3,
        .description-box h3 {
            margin-top: 5px;
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .summary-box i,
        .description-box i {
            margin-right: 10px;
        }

        .summary-text {
            font-style: italic;
            color: #374151;
            line-height: 1.7;
            margin-bottom: 5px;
        }

        .description-list {
            list-style-type: disc;
            padding-left: 20px;
            color: #374151;
            margin-bottom: 5px;
        }

        .description-list li {
            margin-bottom: 8px;
        }

@media (max-width: 768px) {
    .product-card {
        flex-direction: column;
        align-items: center;
    }
    .product-image-full {
        max-width: 100%;
    }

            .product-info {
                width: 100%;
            }

            .product-controls {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 768px) {
            .book-card {
                min-width: 120px;
                max-width: 120px;
            }

            .card-img-top {
                height: 150px;
            }

            .card-title {
                font-size: 0.9rem;
            }

            .carousel-nav {
                font-size: 18px;
                width: 25px;
                height: 25px;
            }
        }

        .product-info {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .author {
            font-size: 20px;
            font-weight: 600;
            color: #666a74;
            /* Tailwind gray-500 */
            margin-bottom: 4px;
        }

        .product-info h5 {
            font-size: 50;
            font-weight: 700;
            color: #111827;
            margin-bottom: 6px;
        }

        .category {
            font-size: 14px;
            color: #6b7280;
            /* Tailwind gray-500 */
            font-weight: 100;
        }

        /* DIBAWAH INI UNTUK SLIDER IMG */

 .carousel-inner {
    min-height: 400px;
}

        .carousel-item {
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .carousel-item img {
            /* height: 100%;
            width: auto;
            max-height: 400px;
            border-radius: 16px;
            object-fit: cover;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease; */

    /* width: 100%;
    max-width: 400px; */
    height: 650px;
    width: 400px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    object-fit: cover;
    transition: transform 0.3s ease;
}
.carousel-item img:hover {
    transform: scale(1.02);
}


        /*DIBAWAH INI ALL REKOMENDASI */
        .scroll-carousel {
            margin-top: 25px;
            display: flex;
            align-items: center;
            width: 100%;
            padding: 10px 30px;
            box-sizing: border-box;
            margin-left: 0;
            padding-left: 40px;
            padding-right: 40px;
            flex-wrap: nowrap;
            overflow-x: auto;
            gap: 12px;
            padding: 0 30px;
            scroll-behavior: smooth;
            position: relative;
            z-index: 3;
        }

        .scroll-container {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            gap: 10px;
            scrollbar-width: none;
            scroll-snap-type: x mandatory;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
        }

        .card {
            scroll-snap-align: start;
            transition: transform 0.3s ease;
            flex: 0 0 auto;
            margin-bottom: 8px;
            width: 120px;
            height: 150px;
            background: white;
            padding: 6px 11px;
            border-radius: 8px;
            box-shadow: 0 6px 8px rgba(128, 0, 128, 0.4);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 14px;
            cursor: pointer;
            user-select: none;
            overflow: hidden;
            word-wrap: break-word;
            margin-left: 1px;
            margin-right: 1px;
        }

.card:hover {
    transform: scale(1.1);
    z-index: 10;
    box-shadow: 0 8px 16px rgba(128, 0, 128, 0.6); /* stronger shadow on hover */
}

.scroll-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: white;
    border: none;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    cursor: pointer;
    box-shadow: 0 0 6px rgba(0, 0, 0, 0.15);
    user-select: none;
    font-size: 18px;
    color: #3C1361;
    display: flex;
    align-items: center;
    justify-content: center;
}

        .scroll-btn.left {
            left: 15px;
            z-index: 3;
        }

        .scroll-btn.right {
            right: 15px;
        }

        /* recommendation */
        .recomm-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 24px;
            max-width: 1180px;
            display: flex;
            flex-direction: column;
            gap: 20x;
            margin: 10px auto 3px auto;
            margin-top: 30px;
        }

        .recomm-title {
            position: relative;
            display: inline-block;
            margin: 0 auto;
            margin-bottom: 5px;
            margin-top: 5px;
        }

        .recomm-title::after {
            content: "";
            display: block;
            height: 3px;
            background-color: #3c1361;
            width: 120px;
            margin: 8px auto 0 auto;
        }

        .recomm-container h2 {
            text-align: center;
        }

        .recomm-inner .scroll-btn.left {
            position: absolute;
            left: -10px;
            /* adjust as needed */
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .recomm-inner .scroll-btn.right {
            position: absolute;
            right: -10px;
            /* adjust as needed */
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .recomm-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: visible;
            position: relative;
        }

.carousel-1 {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    gap: 20px;
    padding-bottom: 10px;
    max-width: 1050px;
    scrollbar-width: none;
    scroll-behavior: smooth;
    flex-wrap: nowrap;
    -webkit-overflow-scrolling: touch;
    overflow-x: auto;
}

.carousel-1-wrapper {
    overflow-x: hidden;
    max-width: 100%;
    position: relative;
    margin: 0 auto;
 }

        .book-card {
            flex: 0 0 auto;
            scroll-snap-align: start;
            background-color: white;
            border-radius: 12px;
            border: 1px solid rgb(168, 167, 167);
            border-width: 1px;
            width: 200px;
            padding: 12px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;

        }

        .book-card:hover {
            background-color: #f3eefe;
        }

        .book-card img {
            width: 100%;
            height: 250px;
            /* atur tinggi sesuai kebutuhan */
            object-fit: cover;
            /* atau contain, sesuai preferensi */
            border-radius: 8px;
        }

        .book-title {
            font-weight: bold;
            margin: 10px 0 4px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .book-author {
            font-size: 13px;
            color: #555;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

/*DIBAWAH INI ALL SLIDER YAH */
.product-carousel-container {
    width: 450px;
    /* max-width: 450px; */
    margin: 0 auto;
}
.product-carousel-inner {
    display: flex;
    align-items: center;
    position: relative;
}
.carousel-1-wrapper {
    /* overflow-x: auto;
    scroll-behavior: smooth;
    flex-grow: 1; */

    overflow-x: hidden;
    max-width: 100%;
    position: relative;
    margin: 0 auto;
}
.carousel-1 {
    /* display: flex;
    gap: 1rem;
    padding: 0.5rem; */

    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    gap: 20px;
    padding-bottom: 10px;
    max-width: 980px;
    scrollbar-width: none;
    scroll-behavior: smooth;
    flex-wrap: nowrap;
    -webkit-overflow-scrolling: touch;
    overflow-x: auto;
}


.product-image-card {
    flex: 0 0 auto;
    width: 450px;
    height: 650px;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.product-image-full {
    width: 100%;
    height: 100%;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    object-fit: cover;
    transition: transform 0.3s ease;

}

.product-image-full:hover {
    transform: scale(1.02);
}


.scroll-btn { 
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: white;
    border: none;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    cursor: pointer;
    box-shadow: 0 0 6px rgba(0, 0, 0, 0.15);
    user-select: none;
    font-size: 18px;
    color: #3C1361;
    display: flex;
    align-items: center;
    justify-content: center;
}

.scroll-btn:hover {
    background-color: rgba(194, 125, 250, 0.7);
}


@media (max-width: 576px) {
  .product-card {
    padding: 20px;
    flex-direction: column;
    align-items: center;
    gap: 20px;
  }
    .carousel-1 {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        gap: 10px;
        -webkit-overflow-scrolling: touch;
    }

    .carousel-1 img {
        flex: 0 0 auto;
        scroll-snap-align: center;
        width: 100%;
        max-width: 320px;
        height: auto;
        border-radius: 12px;
        object-fit: contain;
        display: block;
        margin: 0 auto;
    }


  .product-carousel-container {
    width: 100%;
    max-width: 360px;
    margin: 0 auto;
    padding: 0;
}

  .product-image-card{
    width: 200px;
    height: auto;
    /* max-height: 500px; */
    border-radius: 12px;
  }

  .product-carousel-inner{
    max-width: 200px;
  }
  .product-carousel-container{
    max-width: 200px;
  }
  .product-image-full{
    max-width: 200px;
  }

  .product-info h2 {
    font-size: 24px;
  }

  .product-info h5 {
    font-size: 20px;
  }

  .author {
    font-size: 16px;
  }

  .category {
    font-size: 12px;
  }

  .product-controls {
    flex-direction: column;
    width: 100%;
    gap: 10px;
  }

  .scroll-carousel {
    padding: 0 10px;
    gap: 8px;
  }

  .card {
    width: 100px;
    height: 140px;
    font-size: 12px;
  }

  .recomm-container {
    padding: 16px;
  }

  .recomm-title::after {
    width: 80px;
  }

  .summary-box, .description-box {
    padding: 15px;
  }

  .summary-box h3, .description-box h3 {
    font-size: 16px;
  }

  .summary-text, .description-list li {
    font-size: 14px;
  }
}

</style>
@endpush

@section('content')

    <div class="content-wrapper" style="padding: 20px;">
        <div class="product-card">

            <div class="product-carousel-container">
                <div class="product-carousel-inner">

                    @if($product->images->count() > 1)

                    <button class="scroll-btn left" onclick="scrollCarousel('carousel-product-images', -1)" aria-label="Scroll Left">&#10094;</button>
                    
                    <div class="carousel-1-wrapper">
                        <div class="carousel-1" id="carousel-product-images">
                            {{-- Elemen yang discroll --}}
                            @forelse ($product->images as $image)
                                <div class="product-image-card">
                                    <img src="{{ asset($image->product_images_url) }}" alt="Product Image" class="product-image-full">
                                </div>
                            @empty
                                <p class="text-muted">No images found for this product.</p>
                            @endforelse
                        </div>
                    </div>

                    <button class="scroll-btn right" onclick="scrollCarousel('carousel-product-images', 1)" aria-label="Scroll Right">&#10095;</button>

                    @elseif ($product->images->count() == 1)
                    <div class="carousel-1-wrapper">
                        <div class="carousel-1" id="carousel-product-images">
                            {{-- Elemen yang discroll --}}
                            @forelse ($product->images as $image)
                                <div class="product-image-card">
                                    <img src="{{ asset($image->product_images_url) }}" alt="Product Image" class="product-image-full">
                                </div>
                            @empty
                                <p class="text-muted">No images found for this product.</p>
                            @endforelse
                        </div>
                    </div>
                    @endif

                    
                </div>
                


            <div class="product-info">
                <p class="author">{{ $product->products_author_name }}</p>
                <h2>{{ $product->products_title }}</h2>
                <p class="category">
                    @if ($product->categories->isNotEmpty())
                        {{ $product->categories->pluck('categories_name')->join(', ') }}
                    @else
                        General
                    @endif
                </p>
                <h5 class="price">Rp {{ number_format($product->products_price, 0, ',', '.') }}</h5>

                <div class="summary-box">
                    {{-- <h3><i class="fas fa-quote-left text-gray-500 mr-2"></i>Description</h3> --}}
                    <h3>
                        <i class="fas fa-quote-left text-gray-500 mr-2"></i>
                        <span> Description </span>
                    </h3>
                    <p class="summary-text">
                        {{ $product->products_summary }}
                    </p>
                </div>

                <div class="description-box">
                    <h3>
                        <i class="fas fa-book-open text-gray-500 mr-2"></i>
                        <span>Book's Detail:</span>
                    </h3>
                    <ul class="description-list">
                        <li><strong>Publisher Name:</strong> {{ $product->products_publisher_name }}</li>
                        <li><strong>Language:</strong> {{ $product->products_languange }}</li>
                        <li><strong>Total Pages:</strong> {{ $product->products_total_pages }}</li>
                        <li><strong>Published Year:</strong> {{ $product->products_published_year }}</li>
                        <li><strong>ISBN:</strong> {{ $product->products_isbn }}</li>
                    </ul>
                </div>

                <div class="product-controls">
                    <div class="quantity-control">
                        <button onclick="decrement()">-</button>
                        <input type="number" id="quantity" value="1" min="1">
                        <button onclick="increment()">+</button>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>

                    {{-- Wishlist --}}
                    @php
                        $wishlist = session('wishlist', []);
                        $inWishlist = collect($wishlist)->contains('title', $product->products_title);
                    @endphp

                    {{-- Flash Message --}}
                    @if (session('wishlist_message'))
                        <div class="alert alert-success mt-2">
                            {{ session('wishlist_message') }}
                        </div>
                    @endif

                    <form action="{{ route('wishlist.toggle') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="product_name" value="{{ $product->products_title }}">
                        <input type="hidden" name="product_author" value="{{ $product->products_author_name }}">
                        <input type="hidden" name="product_price" value="{{ $product->products_price }}">
                        <input type="hidden" name="product_image"
                            value="{{ $product->primaryImage->product_images_url }}">

                        <button type="submit" class="product-icon" title="Wishlist"
                            style="background: none; border: none;">
                            <i class="{{ $inWishlist ? 'fas wishlist wishlist-filled' : 'far fa-heart wishlist' }} fa-heart"
                                style="color: #ef4444; {{ $inWishlist ? '#e3342f' : '#ffffff' }}; font-size: 1.5rem;"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommendation -->
    <div class="recomm-container">
        <h2 class="recomm-title fw-bold mb-4">Recommendation For You <span><i class="bi bi-star-fill"
                    style="color:gold;"></i></span></h2>

        <div class="recomm-inner">
            <button class="scroll-btn left" onclick="scrollCarousel('carousel-recomm', -1)"
                aria-label="Scroll Left">&#10094;</button>
            <div class="carousel-1-wrapper">
                <div class="carousel-1" id="carousel-recomm">
                    {{-- Elemen yang discroll --}}
                    @forelse ($recommendations as $rec)
                        <div class="book-card text-center">
                            <a href="{{ route('product.show', ['id' => $rec->id]) }}" class="product-link"
                                style="text-decoration: none;">
                                <img src="{{ asset($rec->primaryImage->product_images_url) }}" class="card-img-top"
                                    alt="{{ $rec->products_title }}">
                                <div class="book-title" style="color:black">{{ $rec->products_title }}</div>
                                <div class="book-author">By {{ $rec->products_author_name }}</div>
                            </a>
                        </div>
                    @empty
                        <p class="text-muted">No recommendations found for this product.</p>
                    @endforelse

                </div>
            </div>
            <button class="scroll-btn right" onclick="scrollCarousel('carousel-recomm', 1)"
                aria-label="Scroll Right">&#10095;</button>
        </div>
    </div>


    <script>
        // untuk + -
        function increment() {
            const qty = document.getElementById('quantity');
            qty.value = parseInt(qty.value) + 1;
        }

        function decrement() {
            const qty = document.getElementById('quantity');
            if (parseInt(qty.value) > 1) {
                qty.value = parseInt(qty.value) - 1;
            }
        }

        function scrollCarousel(id, direction) {
            const carousel = document.getElementById(id);
            if (carousel) {
                const card = carousel.querySelector('.book-card');
                if (!card) return;

                const style = window.getComputedStyle(card);
                const marginLeft = parseFloat(style.marginLeft);
                const marginRight = parseFloat(style.marginRight);

                const scrollAmount = card.offsetWidth + marginLeft + marginRight;

                carousel.scrollBy({
                    left: direction * scrollAmount,
                    behavior: 'smooth'
                });
            }
        }
    </script>
    <script>
        function scrollCarousel(id, direction) {
            const container = document.getElementById(id);
            const scrollAmount = 470; // pixel per scroll
            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }
    </script>
    <script>
        function scrollCarousel(id, direction) {
            const container = document.getElementById(id);
            const scrollAmount = 470; // pixel per scroll
            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }
    </script>
@endsection
