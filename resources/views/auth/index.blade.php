@extends('layouts.main')
@section('title', 'Авторизация')

@section('content')
    <div class="container container-width-custom px-5 my-5">
        <form>
            <div class="form-floating mb-3">
                <input class="form-control" id="login" type="text" placeholder="Логин"/>
                <label for="логин">Логин</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="password" type="text" placeholder="Пароль"/>
                <label for="пароль">Пароль</label>
            </div>
            <div class="mb-3">
                <label class="form-label d-block">Запомнить меня</label>
                <div class="form-check">
                    <input class="form-check-input" id="remember" type="checkbox" name="запомнитьМеня"/>
                    <label class="form-check-label" for="remember"></label>
                </div>
            </div>
            <div class="d-grid custom-btn-width">
                <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Войти</button>
            </div>
        </form>
    </div>
@endsection
