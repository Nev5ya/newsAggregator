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
                        <form method="POST" action="{{ route('profile.update', $user) }}">
                            @csrf
                            @method("PUT")

                            <div class="form-group row justify-content-center">
                                <img src="{{ $user->avatar }}" alt="avatar" class="rounded-circle w-25 mb-3">
                            </div>

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

                            @if(auth()->user()->getAttribute('is_admin') && $user != auth()->user())
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Администратор') }}</label>

                                    <div class="col-md-6 d-flex justify-content-center align-items-center gap-2">
                                        <label for="is_admin_on" class="col-form-label">{{ __('Да') }}</label>
                                        <input id="is_admin_on" type="radio" class="custom-radio mr-5 @error('is_admin') is-invalid @enderror" name="is_admin" value="1" @if ($user->is_admin == 1) checked @endif>
                                        <label for="is_admin_off" class="col-form-label">{{ __('Нет') }}</label>
                                        <input id="is_admin_off" type="radio" class="custom-radio mr-5 @error('is_admin') is-invalid @enderror" name="is_admin" value="0" @if ($user->is_admin == 0) checked @endif>

                                        @error('is_admin')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 d-flex justify-content-around">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Сохранить') }}
                                    </button>

                                    <a href="{{ route('profile.password.edit', $user) }}" class="btn btn-danger">
                                        {{ __('Изменить пароль') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
