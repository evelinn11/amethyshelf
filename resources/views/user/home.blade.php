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
            <a href="{{ route('products.show') }}">
                <div class="card">
                    <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                    <div class="label">Academics</div>
                </div>
            </a>
            <a href="{{ route('products.show') }}">
                <div class="card">
                    <div class="icon"><i class="fas fa-palette"></i></div>
                    <div class="label">Art and Photography</div>
                </div>
            </a>
            <a href="{{ route('products.show') }}">
                <div class="card">
                    <div class="icon"><i class="fas fa-user"></i></div>
                    <div class="label">Biography</div>
                </div>
            </a>
            <a href="{{ route('products.show') }}">
                <div class="card">
                    <div class="icon"><i class="fas fa-briefcase"></i></div>
                    <div class="label">Business</div>
                </div>
            </a>
            <a href="{{ route('products.show') }}">
                <div class="card">
                    <div class="icon"><i class="fas fa-book"></i></div>
                    <div class="label">Comic</div>
                </div>
            </a>
            <a href="{{ route('products.show') }}">
                <div class="card">
                    <div class="icon"><i class="fas fa-laugh"></i></div>
                    <div class="label">Comedy</div>
                </div>
            </a>
            <a href="{{ route('products.show') }}">
                <div class="card">
                    <div class="icon"><i class="fas fa-landmark"></i></div>
                    <div class="label">History</div>
                </div>
            </a>
            <a href="{{ route('products.show') }}">
                <div class="card">
                    <div class="icon"><i class="fas fa-book"></i></div>
                    <div class="label">Novel</div>
                </div>
            </a>
            <a href="{{ route('products.show') }}">
                <div class="card">
                    <div class="icon"><i class="fas fa-rocket"></i></div>
                    <div class="label">Science Fiction</div>
                </div>
            </a>
            <a href="{{ route('products.show') }}">
                <div class="card">
                    <div class="icon"><i class="fas fa-heart"></i></div>
                    <div class="label">Romance</div>
                </div>
            </a>
            <a href="{{ route('products.show') }}">
                <div class="card">
                    <div class="icon"><i class="fas fa-user-graduate"></i></div>
                    <div class="label">Self Help</div>
                </div>
            </a>
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
                    <div class="book-card">
                        <img src="images/Bumi.jpg" alt="Bumi Manusia">
                        <div class="book-title">Bumi Manusia</div>
                        <div class="book-author">By Pramoedya Ananta Toer</div>

                    </div>
                    <div class="book-card">
                        <img src="images/habit.jpg" alt="Habit">
                        <div class="book-title">Habit</div>
                        <div class="book-author">By Charles Duhigg</div>
                    </div>
                    <div class="book-card">
                        <img src="images/laskar-pelangi.jpg" alt="Laskar Pelangi">
                        <div class="book-title">Laskar Pelangi</div>
                        <div class="book-author">By Andrea Hirata</div>
                    </div>
                    <div class="book-card">
                        <img src="images/tentang-kamu.jpg" alt="Tentang Kamu">
                        <div class="book-title">Tentang Kamu</div>
                        <div class="book-author">By Tere Liye</div>
                    </div>
                    <div class="book-card">
                        <img src="images/atomic-habits.jpg" alt="Atomic habits">
                        <div class="book-title">Atomic Habits</div>
                        <div class="book-author">By James Clear</div>
                    </div>
                    <div class="book-card">
                        <img src="images/laut-bercerita.jpg" alt="Laut Bercerita">
                        <div class="book-title">Laut Bercerita</div>
                        <div class="book-author">By Leila Chudori</div>
                    </div>
                    <div class="book-card">
                        <img src="images/dilan.jpg" alt="Dilan">
                        <div class="book-title">Dilan</div>
                        <div class="book-author">By Pidi Baiq</div>
                    </div>
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
                    <div class="book-card">
                        <img src="images/dilan.jpg" alt="Dilan">
                        <div class="book-title">Dilan</div>
                        <div class="book-author">By Pidi Baiq</div>
                    </div>
                    <div class="book-card">
                        <img src="images/laut-bercerita.jpg" alt="Laut Bercerita">
                        <div class="book-title">Laut Bercerita</div>
                        <div class="book-author">By Leila Chudori</div>
                    </div>
                    <div class="book-card">
                        <img src="images/habit.jpg" alt="Habit">
                        <div class="book-title">Habit</div>
                        <div class="book-author">By Charles Duhigg</div>
                    </div>

                    <div class="book-card">
                        <img src="images/tentang-kamu.jpg" alt="Tentang Kamu">
                        <div class="book-title">Tentang Kamu</div>
                        <div class="book-author">By Tere Liye</div>
                    </div>
                    <div class="book-card">
                        <img src="images/laskar-pelangi.jpg" alt="Laskar Pelangi">
                        <div class="book-title">Laskar Pelangi</div>
                        <div class="book-author">By Andrea Hirata</div>
                    </div>
                    <div class="book-card">
                        <img src="images/Bumi.jpg" alt="Bumi Manusia">
                        <div class="book-title">Bumi Manusia</div>
                        <div class="book-author">By Pramoedya Ananta Toer</div>
                    </div>
                    <div class="book-card">
                        <img src="images/atomic-habits.jpg" alt="Atomic habits">
                        <div class="book-title">Atomic Habits</div>
                        <div class="book-author">By James Clear</div>
                    </div>

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
                            “The best deh Oke banget puas cepet sample makasih amethyshelf”
                        </p>
                        <div class="stars">★ ★ ★ ★ ★</div>
                        <div class="name">Felicia Kathrin</div>
                        <div class="location">Jawa Timur</div>
                    </div>
                    <div class="testimonial-box">
                        <p class="testimonial-text">
                            “The best deh Oke banget puas cepet sample makasih amethyshelf”
                        </p>
                        <div class="stars">★ ★ ★ ★ ★</div>
                        <div class="name">Felicia Kathrin</div>
                        <div class="location">Jawa Timur</div>
                    </div>
                    <div class="testimonial-box">
                        <p class="testimonial-text">
                            “The best deh Oke banget puas cepet sample makasih amethyshelf”
                        </p>
                        <div class="stars">★ ★ ★ ★ ★</div>
                        <div class="name">Felicia Kathrin</div>
                        <div class="location">Jawa Timur</div>
                    </div>
                    <div class="testimonial-box">
                        <p class="testimonial-text">
                            “The best deh Oke banget puas cepet sample makasih amethyshelf”
                        </p>
                        <div class="stars">★ ★ ★ ★ ★</div>
                        <div class="name">Felicia Kathrin</div>
                        <div class="location">Jawa Timur</div>
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
