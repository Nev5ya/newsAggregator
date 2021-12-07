@extends('layouts.app')

@section('title', 'Профиль')
@section('header', 'Профиль')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Профиль') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{Auth::user()->is_admin ? route('admin.users.update', $user) : route('updateProfile', $user)}}">
                            @csrf
                            @method("PUT")
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Электронная почта') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if(Auth::user()->is_admin)
                                <div class="form-group row">
                                    <label for="is_admin" class="col-md-4 col-form-label text-md-right">{{ __('Администратор') }}</label>

                                    <div class="col-md-6 d-flex align-items-center gap-2">
                                        <input id="is_admin" type="checkbox" class="custom-radio @error('is_admin') is-invalid @enderror" name="is_admin" @if ($user->is_admin == 1 || old('is_admin')) checked @endif>

                                        @error('is_admin')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            @if(!Auth::user()->is_admin)
                            <div class="form-group row">
                                <label for="currentPassword" class="col-md-4 col-form-label text-md-right">{{ __('Текущий пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="currentPassword" type="password" class="form-control @error('currentPassword') is-invalid @enderror" name="currentPassword" required autocomplete="current-password">

                                    @error('currentPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Новый пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Подтвердите пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Сохранить') }}
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
