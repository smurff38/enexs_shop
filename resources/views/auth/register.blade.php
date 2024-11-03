<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Регистрация</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0;
            background: -webkit-linear-gradient(90deg, #e4c0a1,#e9c0b2,#b97ec3);
            background: linear-gradient(90deg, #e4c0a1,#e9c0b2,#b97ec3);
        }
        .form-container {
            width: 100%;
            max-width: 400px; 
            padding: 20px;
            background: white; 
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .input-group-text {
            cursor: pointer; 
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2 class="text-center">Регистрация</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="last_name" class="form-label">Фамилия</label>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">Имя</label>
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
        </div>
        <div class="mb-3">
            <label for="middle_name" class="form-label">Отчество</label>
            <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
        </div>
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" name="login" value="{{ old('login') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <span class="input-group-text" id="togglePassword">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                <span class="input-group-text" id="togglePasswordConfirmation">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
    </form>

    <div class="mt-3 text-center">
        <span>Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></span>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Маска для телефона
        $('#phone').on('input', function() {
            let input = $(this).val().replace(/\D/g, '');
            let formatted = '+7 ('; 

            if (input.length > 1) {
                formatted += input.slice(1, 4);
            }
            if (input.length >= 4) {
                formatted += ') ' + input.slice(4, 7);
            }
            if (input.length >= 7) {
                formatted += '-' + input.slice(7, 9);
            }
            if (input.length >= 9) {
                formatted += '-' + input.slice(9, 11); 
            }

            $(this).val(formatted);
        });

        // Скрипт для переключения видимости пароля
        $('#togglePassword').click(function() {
            const passwordField = $('#password');
            const passwordFieldType = passwordField.attr('type');
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                passwordField.attr('type', 'password');
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });

        // Скрипт для переключения видимости подтверждения пароля
        $('#togglePasswordConfirmation').click(function() {
            const passwordConfirmationField = $('#password_confirmation');
            const passwordConfirmationFieldType = passwordConfirmationField.attr('type');
            if (passwordConfirmationFieldType === 'password') {
                passwordConfirmationField.attr('type', 'text');
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                passwordConfirmationField.attr('type', 'password');
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    });
</script>
</body>
</html>
