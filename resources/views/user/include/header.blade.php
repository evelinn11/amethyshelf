<!-- Top Bar -->
<div class="top-bar">
    <div class="d-flex justify-content-between align-items-center header-content gap-3">
        <div class="d-flex align-items-center gap-3 flex-grow-1" style="min-width: 0;">
            <div>
                <h4 class="brand-text mb-0">AMETHYSHELF</h4>
                <div class="brand-subtitle">ISB's Largest Bookstore</div>
            </div>
            <form action="{{ route('search.redirect') }}" method="GET" class="search-wrapper" style="flex:1;">
                <i class="fas fa-search"></i>
                <input type="text" name="q" class="form-control" placeholder="Cari Produk" required>
            </form>

        </div>
        <div class="text-white d-flex align-items-center me-5">
            <li class="nav-item dropdown hover-dropdown" style="list-style: none;">
                <a class="nav-link dropdown-toggle" href="#" role="button">
                    Felicia <i class="fas fa-user ms-2"></i>
                </a>
                <ul class="dropdown-menu" style="min-width:120px; height:90px;">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <form id="logout-form" action="{{ route('signout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>

                </ul>
            </li>
        </div>

    </div>
</div>

<!-- Second Bar -->
<div class="bottom-bar">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-light">
            <!-- Tombol Toggle (icon titik tiga) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Konten Navbar (yang akan tersembunyi di HP dan muncul ketika diklik) -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <div class="row w-100">
                    <!-- Kiri -->
                    <div class="col-12 col-md-8">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item mx-3"><a class="nav-link" href="{{ route('home.show') }}">Home</a>
                            </li>
                            <li class="nav-item dropdown hover-dropdown mx-3">
                                <a class="nav-link dropdown-toggle" href="#" role="button">Categories</a>
                                <ul class="dropdown-menu">
                                    {{-- @foreach ($categories as $category)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('products.show', ['category' => $category->id]) }}">
                                            {{ $category->name }}
                                        </a> --}}
                                        {{-- @foreach ($categories as $category)
                                            <li><a class="dropdown-item" href="#">{{ $category->categories_name }}</a></li>
                                        @endforeach --}}
                                    {{-- </li>
                                    @endforeach --}}
                                    @foreach($categories as $category)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('products.showByCategory', $category->id) }}">{{ $category->categories_name }}</a>
                                        </li>
                                    @endforeach
{{-- 
                                    @foreach ($categories as $category)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('product.showByCategory', ['category' => $category->id]) }}">
                                                {{ $category->categories_name }}
                                            </a>
                                        </li>
                                    @endforeach --}}

                                </ul>
                            </li>
                            <li class="nav-item mx-3"><a class="nav-link" href="{{ route('orders.show') }}">Order
                                    History</a></li>
                            <li class="nav-item mx-3"><a class="nav-link" href="#">About Us</a></li>
                        </ul>
                    </div>
                    <!-- Kanan -->
                    <div class="col-12 col-md-4">
                        <ul class="navbar-nav ms-md-auto justify-content-md-end">
                            <li class="nav-item me-3">
                                <a class="nav-link" href="{{ route('wishlist.index') }}"><i
                                        class="far fa-heart me-1"></i> Wishlist</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" href="{{ route('cart.index') }}"
                                    style="gap:4px;">
                                    <div style="position: relative; display: inline-block;">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>1</span>
                                    </div>
                                    My Cart
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
