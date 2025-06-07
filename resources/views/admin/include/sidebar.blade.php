<head>
    <meta charset="UTF-8">
    <title>Amethyshelf Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="mobile-header">
    <span class="brand">AMETHYSHELF</span>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
</div>


<div class="sidebar">
    <h2 class="sidebar-title">AMETHYSHELF</h2>
    <ul class="sidebar-menu">
        <li><a href="{{ route("dashboard") }}"><span class="iconify" data-icon="mdi:home" data-inline="false"></span> Dashboard</a></li>
        <li><a href="{{ route("product") }}"><span class="iconify" data-icon="mdi:book" data-inline="false"></span> Products</a></li>
        <li><a href="{{ route("category") }}"><span class="iconify" data-icon="mdi:category" data-inline="false"></span> Category</a></li>
        <li><a href="{{ route("admin-orders") }}"><span class="iconify" data-icon="mdi:cart" data-inline="false"></span> Orders</a></li>
        <li><a href="{{ route("user") }}"><span class="iconify" data-icon="mdi:account" data-inline="false"></span> Users</a></li>   
    </ul>
    <hr>
    <form method="POST" action="{{ route('signout') }}">
         @csrf
         <button class="logout-btn" type="submit"><span class="iconify logout-icon" data-icon="mdi:door" data-inline="false"></span>Logout</button>
    </form>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('active');
    }
</script>
