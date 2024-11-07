@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="container mt-4">
        <!-- Сообщение об успешном обновлении -->
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
            @csrf
            <div class="card profile-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Ваши данные</h3>
                    <!-- Кнопка редактирования с иконкой карандаша -->
                    <button type="button" id="editIcon" class="btn btn-light p-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Редактировать данные">
                        <i class="bi bi-pencil-square"></i> <!-- Иконка карандаша -->
                    </button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Фамилия</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Имя</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="middle_name" class="form-label">Отчество</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" disabled>
                        <div class="invalid-feedback" id="phoneError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="login" class="form-label">Логин</label>
                        <input type="text" class="form-control" id="login" name="login" value="{{ $user->login }}" disabled readonly
                               data-bs-toggle="tooltip" data-bs-placement="top" title="Логин изменить нельзя">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" id="editButton">Изменить данные</button>
                    <button type="button" class="btn btn-secondary d-none" id="cancelButton">Отмена</button>
                    <button type="submit" class="btn btn-success d-none" id="saveButton">Сохранить</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Подключение jQuery и Bootstrap JS для тултипов -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Инициализация тултипов
            var tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Сохраняем исходные значения в переменные
            const originalValues = {
                lastName: $('#last_name').val(),
                firstName: $('#first_name').val(),
                middleName: $('#middle_name').val(),
                phone: $('#phone').val(),
            };

            $('#phone').on('input', function() {
                let input = $(this).val().replace(/\D/g, '').substring(0, 11); // Удаляем всё, кроме цифр и ограничиваем до 11 цифр
                let formatted = '+7';

                if (input.length > 1) {
                    formatted += ' (' + input.substring(1, 4);
                }
                if (input.length >= 4) {
                    formatted += ') ' + input.substring(4, 7);
                }
                if (input.length >= 7) {
                    formatted += '-' + input.substring(7, 9);
                }
                if (input.length >= 9) {
                    formatted += '-' + input.substring(9, 11);
                }

                $(this).val(formatted);
            });

            // Обработчик для кнопки "Изменить данные"
            $('#editButton').on('click', function () {
                // Разблокируем только редактируемые поля (кроме логина)
                $('#profileForm input:not([readonly])').prop('disabled', false);

                // Показать кнопку "Сохранить" и "Отмена", скрыть кнопку "Изменить данные"
                $('#saveButton').removeClass('d-none');
                $('#cancelButton').removeClass('d-none');
                $(this).addClass('d-none');
            });

            // Обработчик для кнопки "Отмена"
            $('#cancelButton').on('click', function () {
                // Восстанавливаем исходные значения
                $('#last_name').val(originalValues.lastName);
                $('#first_name').val(originalValues.firstName);
                $('#middle_name').val(originalValues.middleName);
                $('#phone').val(originalValues.phone);

                // Заблокировать все поля
                $('#profileForm input:not([readonly])').prop('disabled', true);

                // Скрыть кнопки "Сохранить" и "Отмена", показать кнопку "Изменить данные"
                $('#saveButton').addClass('d-none');
                $(this).addClass('d-none');
                $('#editButton').removeClass('d-none');
            });

            // Валидация перед отправкой
            $('#profileForm').on('submit', function(event) {
                const phone = $('#phone').val();
                const phonePattern = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/;

                // Сбрасываем состояние ошибки
                $('#phone').removeClass('is-invalid');
                $('#phoneError').text('');

                if (!phonePattern.test(phone)) {
                    event.preventDefault(); // Отменяем отправку формы
                    $('#phone').addClass('is-invalid'); // Добавляем класс ошибки
                    $('#phoneError').text('Введите корректный номер телефона'); // Устанавливаем текст ошибки
                }
            });
        });
    </script>

    <style>
        .profile-card {
            background-color: rgba(255, 255, 255, 0.7); /* Белый фон с прозрачностью 70% */
            opacity: 0.85; /* Прозрачность всей карточки */
            transition: opacity 0.3s ease, background-color 0.3s ease; /* Плавный переход */
        }

        .profile-card:hover {
            opacity: 1; /* При наведении на карточку opacity становится 1 */
            background-color: rgba(255, 255, 255, 1); /* Убираем прозрачность при наведении */
        }


        /* Кнопка редактирования (иконка карандаша) */
        #editIcon {
            background-color: #f8f9fa;
            border-radius: 50%;
            padding: 8px;
            border: none;
        }

        #editIcon i {
            font-size: 1.5rem; /* Размер иконки */
            color: #007bff;
        }

        #editIcon:hover {
            background-color: #e2e6ea;
        }
    </style>
@endsection
