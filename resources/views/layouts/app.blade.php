<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Enexs Shop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Playfair Display', serif;
            background-color: #CDD8FF;
        }

        header {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .header-content {
            background-color: #8BA3F4;
            border-radius: 10px;
            padding: 0 20px;
            display: flex;
            flex-direction: column-reverse;
            flex-wrap: wrap;
            max-width: 95%;
            margin: 0 auto; /* Центрируем шапку */
        }

        .search-input {
            border-radius: 20px; /* Скругление */
            padding-right: 2.5rem; /* Отступ справа для иконки */
            padding-left: 2.5rem; /* Отступ слева для иконки */
            background-color: rgba(255, 255, 255, 0.8); /* Прозрачность фона */
            transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Плавные переходы */
        }

        /* Иконка поиска */
        .search-icon {
            position: absolute;
            left: 15px; /* Отступ для иконки */
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        /* Цвет текста плейсхолдера */
            .search-input::placeholder {
        }

        /* Эффект при наведении */
        .search-input:hover, .search-input:focus {
            background-color: rgba(255, 255, 255, 1); /* Убираем прозрачность при наведении */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Тень при наведении */
        }

        footer {
            background-color: #8BA3F4;
            color: #333;
            display: flex;
            align-items: center;
        }

        footer .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .dropdown-toggle {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            padding: 0;
            border: none;
        }

        .dropdown-toggle:focus {
            box-shadow: none; /* Убираем синее выделение */
        }

        .dropdown-toggle::after {
            display: none; /* Убираем стрелочку */
        }

        .dropdown:hover .dropdown-menu {
            display: block; /* Показываем меню при наведении */
        }

        .dropdown-menu {
            display: none; /* Скрываем меню по умолчанию */
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<header>
    <div class="container">
        <div class="header-content">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Логотип" class="me-2" style="max-width: 100px;">
                </a>

                <a href="/catalog" class="btn btn-light me-2">
                    <i class="fas fa-th-large me-1"></i> Каталог
                </a>

                <div class="position-relative w-50">
                    <input type="text" class="form-control search-input" placeholder="Поиск..." aria-label="Search">
                    <i class="fas fa-search search-icon"></i>
                </div>

                <a href="/cart" class="btn btn-outline-secondary rounded-circle me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                <a href="/about" class="btn btn-light me-3">О нас</a>

                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="profile-icon">
                            <i class="fas fa-user"></i>
                        </div>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                        @if(Auth::check())
                            <li><a class="dropdown-item" href="/lk/profile">Мои данные</a></li>
                            <li><a class="dropdown-item" href="/lk/orders">Мои заказы</a></li>
                            <li>
                                <form action="/lk/logout" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Выйти</button>
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="/lk/login">Вход</a></li>
                            <li><a class="dropdown-item" href="/lk/register">Регистрация</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="container my-4">
    @yield('content')
</main>

<footer class="py-4 mt-auto">
    <div class="container">
        <div class="col-md-4 d-flex flex-column justify-content-center">
            <ul class="list-unstyled">
                <li><a href="/" class="text-dark">Главная</a></li>
                <li><a href="/catalog" class="text-dark">Каталог</a></li>
                <li><a href="/about" class="text-dark">О нас</a></li>
            </ul>
        </div>
        <div class="col-md-4 d-flex flex-column justify-content-center align-items-center text-center">
            <ul class="list-unstyled">
                <li><i class="fas fa-phone me-2"></i> <a href="tel:+79000000000" class="text-dark">+7 (900) 000-00-00</a></li>
                <li><i class="fas fa-envelope me-2"></i> <a href="mailto:info@enexs.shop" class="text-dark">info@enexs.shop</a></li>
                <li><i class="fas fa-map-marker-alt me-2"></i> Иркутск, ул. Ленина, д. 5А</li>
            </ul>
        </div>
        <div class="col-md-4 d-flex flex-column justify-content-center">
            <p class="text-dark">
                Данный интернет-сайт предоставляет информацию о товарах, но не является публичной офертой согласно статье 437 Гражданского кодекса РФ.
            </p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
