@extends('layouts.admin')
@section('title')
    @parent Выгрузить данные @stop

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Выгрузить данные</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <form method="POST" action="{{ route('admin.download') }}">
                @csrf
                <div class="form-group">
                    <label for="category">Новости по категории</label>
                    <select class="custom-select" name="category" id="category">
                        <option value="all">Все</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['category'] }}">{{ $category['slug'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="format">Формат данных</label>
                    <select class="custom-select" name="format" id="format">
                        <option value="json">JSON</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Скачать</button>
            </form>
        </div>
    </div>
@endsection
