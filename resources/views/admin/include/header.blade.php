<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .admin-header {
    margin-left: 250px;
    background-color: white;
    padding: 20px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.admin-header-left h1 {
    font-size: 18px;
    font-weight: bold;
    margin: 0;
}

.admin-header-user {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #4b0082;
    font-weight: 500;
}

.admin-main-content {
    margin-left: 250px;
    padding: 30px;
}

@media (max-width: 768px) {
    .admin-header {
        position: fixed;
        top: 60px;
        left: 0;
        right: 0;
        margin-left: 0;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        z-index: 1;
        padding-top: 30px;
    }
}

    </style>
</head>
<body>

    <header class="admin-header">
        <div class="admin-header-left">
            <h1>{{ $title }}</h1>
        </div>
        <div class="admin-header-user">
            <span class="icon">👤</span>
            <span class="username">Admin</span>
        </div>
    </header>
</body>
</html>
