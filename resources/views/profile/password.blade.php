@extends('layouts.app')

@section('title', 'Профиль')
@section('header', 'Профиль')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Смена пароля') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.password.update', $user) }}">
                            @method("PUT")
                            @csrf
                            @if(!auth()->user()->getAttribute('is_admin'))
                                <div class="form-group row">
                                    <label for="currentPassword"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Текущий пароль') }}</label>

                                    <div class="col-md-6">
                                        <input id="currentPassword" type="password"
                                               class="form-control @error('currentPassword') is-invalid @enderror"
                                               name="currentPassword" autocomplete="current-password">

                                        @error('currentPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Новый пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Подтвердите пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 d-flex justify-content-around">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Обновить пароль') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
