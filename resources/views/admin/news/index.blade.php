@extends('layouts.admin')
@section('title')
    @parent Список новостей @stop

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Список новостей</h1>
        <a href="{{ route('admin.news.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i>&nbsp; Добавить новость</a>
    </div>
    <div class="row">
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Заголовок</th>
                        <th>Описание</th>
                        <th>Дата добавления</th>
                        <th>Категория</th>
                        <th>Управление</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($newsList as $news)
                        <tr>
                            <td>{{ $news->id }}</td>
                            <td>{{ $news->title }}</td>
                            <td>{{ $news->description }}</td>
                            <td>{{ $news->created_at }}</td>
                            <td>{{ $news->category_name }}</td>
                            <td>
                                <a href="">Редактировать</a>
                                /
                                <a href="">Удалить</a>
                            </td>
                        </tr>
                    @empty
                        <h2>Новостей нет.</h2>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
