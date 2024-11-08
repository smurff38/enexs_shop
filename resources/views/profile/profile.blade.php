@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="container mt-4">
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="row">
            <!-- Левая колонка: Карточка профиля -->
            <div class="col-md-6">
                <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
                    @csrf
                    <div class="card profile-card">
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

            <!-- Правая колонка: История заказов -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>История заказов</h3>
                    </div>
                    <div class="card-body">
                        @forelse($orders as $order)
                            <div class="mb-4 border-bottom pb-2">
                                <h5>Заказ #{{ $order->id_order }}</h5>
                                <p>Дата заказа: {{ $order->order_date->format('d.m.Y H:i') }}</p>
                                <p>Статус: <span class="badge bg-info">{{ $order->status }}</span></p>
                                <p>Сумма: {{ number_format($order->summ, 2) }} ₽</p>
                                <h6>Товары:</h6>
                                <ul>
                                    @foreach($order->items as $item)
                                        <li>
                                            {{ $loop->iteration }}. {{ $item->product->name_product ?? 'Неизвестный товар' }}
                                            <span class="float-end">{{ $item->kol }} шт × {{ number_format($item->price, 2) }} ₽ = {{ number_format($item->kol * $item->price, 2) }} ₽</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @empty
                            <p>У вас пока нет заказов.</p>
                        @endforelse
                    </div>
                </div>
            </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            var tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });

            const originalValues = {
                lastName: $('#last_name').val(),
                firstName: $('#first_name').val(),
                middleName: $('#middle_name').val(),
                phone: $('#phone').val(),
            };

            $('#phone').on('input', function() {
                let input = $(this).val().replace(/\D/g, '').substring(0, 11);
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

            $('#editButton').on('click', function () {
                $('#profileForm input:not([readonly])').prop('disabled', false);
                $('#saveButton').removeClass('d-none');
                $('#cancelButton').removeClass('d-none');
                $(this).addClass('d-none');
            });

            $('#cancelButton').on('click', function () {
                $('#last_name').val(originalValues.lastName);
                $('#first_name').val(originalValues.firstName);
                $('#middle_name').val(originalValues.middleName);
                $('#phone').val(originalValues.phone);

                $('#profileForm input:not([readonly])').prop('disabled', true);
                $('#saveButton').addClass('d-none');
                $(this).addClass('d-none');
                $('#editButton').removeClass('d-none');
            });

            $('#profileForm').on('submit', function(event) {
                const phone = $('#phone').val();
                const phonePattern = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/;

                $('#phone').removeClass('is-invalid');
                $('#phoneError').text('');

                if (!phonePattern.test(phone)) {
                    event.preventDefault();
                    $('#phone').addClass('is-invalid');
                    $('#phoneError').text('Введите корректный номер телефона');
                }
            });
        });
    </script>

    <style>
        .profile-card {
            background: linear-gradient(90deg, #e4c0a1, #e9c0b2, #b97ec3);
            opacity: 0.85;
            transition: opacity 0.3s ease;
            color: white;
        }
        .profile-card:hover {
            opacity: 1;
        }
        .card {
            border: none; /* Убираем чёрную обводку */
            box-shadow: none; /* Убирает тень, если была */

        }
    </style>
@endsection
