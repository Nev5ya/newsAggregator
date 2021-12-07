<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('news.index') }}">
                Агрегатор новостей
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('news.index')) active @endif" href="{{ route('news.index') }}">Домой</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('category.index')) active @endif" href="{{ route('category.index') }}">Категории</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('contact')) active @endif" href="{{ route('contact') }}">Напишите нам</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link @if (request()->routeIs('login')) active @endif" href="{{ route('login') }}">Войти</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link @if (request()->routeIs('register')) active @endif" href="{{ route('register') }}">Зарегистрироваться</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(auth()->user()?->is_admin)
                                        <a class="dropdown-item" href="{{ route('admin.news.index') }}">
                                            {{ __('Админка') }}
                                        </a>
                                @endif
                                    <a class="dropdown-item" href="{{ route('showProfile', Auth::user()->id) }}">
                                        {{ __('Профиль') }}
                                    </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Выйти') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <header class="py-4 bg-light border-bottom mb-4">
        <div class="container">
            <h2 class="accordion-header font-weight-normal">@section('header') Все новости @show</h2>
        </div>
    </header>
</div>
