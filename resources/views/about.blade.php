@extends('layouts.app')

@section('title', 'О нас')

@section('content')
    <div class="container">
        <div class="row align-items-center" style="min-height: 70vh;">
            <!-- Текстовый блок -->
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <p style="font-family: 'Montserrat Alternates', sans-serif; font-weight: 800; font-size: 36px; line-height: 1.2;">
                    Наша компания появилась на свет в 2024 году.
                </p>
                <p style="font-family: 'Montserrat Alternates', sans-serif; font-weight: 700; font-size: 24px; line-height: 1.4;">
                    Основана на продаже периферийных устройств для компьютеров в Иркутске.
                </p>
                <p style="font-family: 'Montserrat Alternates', sans-serif; font-weight: 400; font-size: 14px; line-height: 1.6;">
                    Мы выбираем лучшие кампании и тщательно контролируем каждый этап процесса сборки устройств. Наш магазин поможет найти подходящее устройство для вашего компьютера.
                </p>
            </div>
            <!-- Изображение -->
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img src="{{ asset('images/about.png') }}" alt="О нас" class="img-fluid rounded" style="object-fit: cover; border-radius: 10px; max-width: 60%; height: auto;">
            </div>
        </div>
    </div>
@endsection

