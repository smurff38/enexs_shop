<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интернет-магазин</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="p-3 bg-light">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Логотип" width="auto" height="10" class="me-2">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="/" class="nav-link px-2 text-secondary">Главная</a></li>
                    <li><a href="/catalog" class="nav-link px-2 text-dark">Каталог</a></li>
                    <li><a href="/contacts" class="nav-link px-2 text-dark">Контакты</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control" placeholder="Поиск..." aria-label="Search">
                </form>

                <a href="/cart" class="btn btn-outline-secondary rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                <div class="text-end">
                    @if(Auth::check())
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Профиль
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="/lk/profile">Мои данные</a></li>
                                <li><a class="dropdown-item" href="/lk/orders">Мои заказы</a></li>
                                <li>
                                    <form action="/lk/logout" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Выйти</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="/lk/login" class="btn btn-outline-primary me-2">Войти</a>
                        <a href="/lk/register" class="btn btn-primary">Регистрация</a>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <main class="container my-4">
        @yield('content')
    </main>

    <footer class="bg-light py-3 mt-auto">
        <div class="container text-center">
            <p>&copy; 2024 Интернет-магазин</p>
            <span></span>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
