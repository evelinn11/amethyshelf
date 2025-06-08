@extends('user.base.base')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/home.css') }}">
@endpush

@section('content')
    <!-- banner -->
    <div class="container-fluid px-0">
        <div class="banner-wrapper">
            <div class="row gx-2" style="height: 300px">
                <!-- Carousel -->
                <div class="col-12 col-md-9 h-100">
                    <div id="bannerCarousel" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="3000"
                        style="height: 300px;">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                        </div>
                        <div class="carousel-inner h-100">
                            <div class="carousel-item active h-100">
                                <img src="{{ asset('images/bookfair.png') }}"
                                    class="d-block w-100 h-100 big-banner img-fluid" alt="Banner 1">
                            </div>
                            <div class="carousel-item h-100">
                                <img src="{{ asset('images/signupp.png') }}"
                                    class="d-block w-100 h-100 big-banner img-fluid" alt="Banner 2">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>

                <!-- Right images -->
                <div class="right-banner col-12 col-md-3 d-flex flex-md-column flex-row justify-content-between h-100"
                    style="">
                    <img src="{{ asset('images/comingsoon.png') }}" alt="Top Right" class="right-img"
                        style="row-gap:10 px; height: 49%; object-fit: cover; width: 100%;">
                    <img src="{{ asset('images/comingsoon.png') }}" alt="Bottom Right" class="right-img"
                        style="row-gap:10 px; height: 49%; object-fit: cover; width: 100%;">
                </div>
            </div>
        </div>
    </div>


    <!-- categories -->
    <div class="scroll-carousel mt-3">
        <button class="scroll-btn left" aria-label="Scroll Left">&#10094;</button>

        <div class="scroll-container ms-4 me-4 py-5 px-5">
            @foreach ($categories as $category)
                <a href="{{ route('products.showByCategory', $category->id) }}">
                    <div class="card">
                        <div class="icon">
                            <i class="fas {{ $iconMap[$category->categories_name] ?? 'fa-book' }}"></i>
                        </div>
                        <div class="label">{{ $category->categories_name }}</div>
                    </div>
                </a>
            @endforeach
        </div>

        <button class="scroll-btn right" aria-label="Scroll Right">&#10095;</button>
    </div>

    <!-- Editors Pick -->
    <div class="editor-pick-container">
        <h2 class="editor-title">Editor's Pick <span>🏅</span></h2>

        <div class="editor-pick-inner">
            <button class="scroll-btn left" onclick="scrollCarousel('carousel-editor', -1)"
                aria-label="Scroll Left">&#10094;</button>
            <div class="carousel-1-wrapper">
                <div class="carousel-1" id="carousel-editor">
                    @foreach ($editorsPickBooks as $book)
                        <div class="book-card">
                            <a href="{{ route('product.show', ['id' => $book->id]) }}" class="product-link"
                                style="text-decoration: none;">
                                <img src="{{ asset($book->primaryImage->product_images_url) }}"
                                    alt="{{ $book->products_title }}" class="card-img-top">
                                <div class="book-title" style="color:black">{{ $book->products_title }}</div>
                                <div class="book-author">By {{ $book->products_author_name }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <button class="scroll-btn right" onclick="scrollCarousel('carousel-editor', 1)"
                aria-label="Scroll Right">&#10095;</button>
        </div>
    </div>

    <!-- Hottest -->
    <div class="editor-pick-container">
        <h2 class="editor-title">Hottest's Books <span>🔥</span></h2>

        <div class="editor-pick-inner">
            <button class="scroll-btn left" onclick="scrollCarousel('carousel-hottest', -1)"
                aria-label="Scroll Left">&#10094;</button>
            <div class="carousel-1-wrapper">
                <div class="carousel-1" id="carousel-hottest">
                    @foreach ($topBooks as $book)
                        <div class="book-card">
                            <a href="{{ route('product.show', ['id' => $book->id]) }}" class="product-link"
                                style="text-decoration: none;">
                                <img src="{{ asset($book->product_images_url) }}" alt="{{ $book->products_title }}"
                                    class="card-img-top">
                                <div class="book-title" style="color:black">{{ $book->products_title }}</div>
                                <div class="book-author">By {{ $book->products_author_name }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <button class="scroll-btn right" onclick="scrollCarousel('carousel-hottest', 1)"
                aria-label="Scroll Right">&#10095;</button>
        </div>
    </div>


    <div class="editor-pick-container">
        <h2 class="editor-title">Customers Testimonials</h2>
        <div class="editor-pick-inner">
            <div class="carousel-1-wrapper">
                <div class="carousel-1" id="carousel-hottest">
                    <div class="testimonial-box">
                        <p class="testimonial-text">
                            “E-commerce ini benar-benar membantu saya menemukan buku favorit dengan mudah. Pelayanan cepat dan
                            ramah!”
                        </p>
                        <div class="stars">★ ★ ★ ★ ★</div>
                        <div class="name">Rina Saraswati</div>
                        <div class="location">Jakarta</div>
                    </div>
                    <div class="testimonial-box">
                        <p class="testimonial-text">
                            “Pengiriman tepat waktu dan kualitas barang sesuai harapan. Recomended banget untuk pecinta
                            buku.”
                        </p>
                        <div class="stars">★ ★ ★ ★ ☆</div>
                        <div class="name">Andi Pratama</div>
                        <div class="location">Bandung</div>
                    </div>
                    <div class="testimonial-box">
                        <p class="testimonial-text">
                            “Sistem mudah digunakan, banyak pilihan buku menarik, dan harga terjangkau.”
                        </p>
                        <div class="stars">★ ★ ★ ★ ★</div>
                        <div class="name">Siti Aisyah</div>
                        <div class="location">Surabaya</div>
                    </div>
                    <div class="testimonial-box">
                        <p class="testimonial-text">
                            “Customer service sangat membantu ketika saya ada kendala. Sangat puas berbelanja
                            di sini.”
                        </p>
                        <div class="stars">★ ★ ★ ★ ☆</div>
                        <div class="name">Dedi Wijaya</div>
                        <div class="location">Yogyakarta</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollContainer = document.querySelector('.scroll-container');
            const scrollLeftBtn = document.querySelector('.scroll-btn.left');
            const scrollRightBtn = document.querySelector('.scroll-btn.right');

            const getCardScrollAmount = () => {
                const card = scrollContainer.querySelector('.card');
                const style = window.getComputedStyle(card);
                const marginLeft = parseFloat(style.marginLeft);
                const marginRight = parseFloat(style.marginRight);
                return card.offsetWidth + marginLeft + marginRight;
            };

            scrollLeftBtn.addEventListener('click', () => {
                scrollContainer.scrollBy({
                    left: -getCardScrollAmount(),
                    behavior: 'smooth'
                });
            });

            scrollRightBtn.addEventListener('click', () => {
                scrollContainer.scrollBy({
                    left: getCardScrollAmount(),
                    behavior: 'smooth'
                });
            });
        });

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
@endsection
