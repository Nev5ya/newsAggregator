@extends('layouts.main')

@section('title', 'Контакты')

@section('content')
    <div class="col-lg-12">
        <div class="p-1 mb-5">
            <h1 class="card-subtitle mb-2">Свяжитесь с нами!</h1>
            <p class="card-subtitle font-weight-bold">Наш адрес: Россия, Москва, улица Арбат, 37/2с6</p>
        </div>
    </div>
    <form class="form-group mb-3" action="">
        <h3>!todo Форма обратной связи</h3>
    </form>
    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A909e81f678c37304daa4e6c137728fd969ca45318ff1403acaca31c7f1637fd1&amp;width=977&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
@endsection
