@extends('layouts.admin')
@section('title')
    @parent Список категорий @stop

@section('content')
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
                        <th>Управление</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categoryList as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>{{ date('d:m:Y') }}</td>
                            <td>
                                <a href="">Редактировать</a>
                                /
                                <a href="">Удалить</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
