<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('news.index') }}">Агрегатор новостей</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if (request()->routeIs('news.index')) active @endif" href="{{ route('news.index') }}">Домой</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (request()->routeIs('contact')) active @endif" href="{{ route('contact') }}">Напишите нам</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth') }}">Войти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.news.index') }}">Админка</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4"><div class="container"></div></header>
