@extends('layouts.admin')
@section('title')
    @parent Список категорий @stop

@section('content')
{{--    todo некорректно работает передача в компонент переменных    --}}
{{--    @if(session('type'))--}}
{{--        <x-alert type='{{ session('type') }}' :message='{{ session('message') }}'></x-alert>--}}
{{--    @endif--}}

@if(session('type'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Список категорий</h1>
        <a href="{{ route('admin.category.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i>&nbsp; Добавить категорию</a>
    </div>
    <div class="row">
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Категория</th>
                        <th>Дата добавления</th>
                        <th>Дата изменения</th>
                        <th>Управление</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at ?? 'Без изменений' }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.category.destroy', $category) }}">
                                    @csrf
                                    @method("DELETE")
                                    <a class="btn btn-facebook mb-1" href="{{ route('admin.category.edit', $category) }}"><i class="fas fa-edit fa-sm text-white-50"></i>&nbsp; Редактировать</a>
                                    <button class="btn btn-google" type="submit"><i class="fas fa-trash fa-sm text-white-50"></i>&nbsp; Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
