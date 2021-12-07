@extends('layouts.admin')
@section('title')
    @parent {{ $action = request()->routeIs('*.create') ? 'Добавить' : 'Изменить' }} новость@stop

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $action }} новость</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <form method="POST" action="{{ $action === 'Добавить' ? route('admin.news.store') : route('admin.news.update', $news) }}" enctype="multipart/form-data">
                @csrf
                @if($action === 'Изменить')
                    @method("PUT")
                @endif
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $news->title ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="author">Автор</label>
                    <input type="text" class="form-control" name="author" id="author" value="{{ old('author') ?? $news->author ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="category">Категория</label>
                    <select class="custom-select" name="category_id" id="category_id">
                            @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"

                                @isset($news)
                                    @if($news->category_id == $category->id) selected @endif
                                @endisset

                                @if ($category->id == old('category_id')) selected @endif>
                                {{ $category->slug }}
                            </option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Описание новости</label>
                    <textarea class="form-control" name="description" id="description" required>{{ old('description') ?? $news->description ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <input class="custom-file" type="file" name="image">
                </div>
                <button dusk="addNews" type="submit" class="btn btn-success">{{ $action }}</button>
            </form>
        </div>
    </div>
@endsection
