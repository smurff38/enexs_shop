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
            <div class="card">
                <div class="card-header">
                    <h3>Ваши данные</h3>
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
                        <div class="invalid-feedback" id="phoneError"></div> <!-- Элемент для сообщения об ошибке -->
                    </div>
                    <div class="mb-3">
                        <label for="login" class="form-label">Логин</label>
                        <input type="text"
                               class="form-control"
                               id="login"
                               name="login"
                               value="{{ $user->login }}"
                               disabled
                               readonly
                               data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="Логин изменить нельзя">
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

    <!-- Подключение jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
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
@endsection
