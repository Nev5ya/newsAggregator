@extends('layouts.admin')
@section('title')
    @parent Список новостей @stop

@section('content')
    @if(session('type'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Список новостей</h1>
        <a href="{{ route('admin.news.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i>&nbsp; Добавить новость</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Заголовок</th>
                        <th>Описание</th>
                        <th>Дата добавления</th>
                        <th>Дата изменения</th>
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
                            <td>{{ $news->updated_at }}</td>
                            <td>{{ $categories[$news->category_id]->slug }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.news.destroy', $news) }}">
                                    @csrf
                                    @method("DELETE")
                                    <a class="btn btn-facebook mb-1" href="{{ route('admin.news.edit', $news) }}"><i class="fas fa-edit fa-sm text-white-50"></i>&nbsp; Редактировать</a>
                                    <button class="btn btn-google" type="submit"><i class="fas fa-trash fa-sm text-white-50"></i>&nbsp; Удалить</button>
                                </form>
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
    <!-- Pagination-->
    {{ $newsList->links() }}
@endsection
