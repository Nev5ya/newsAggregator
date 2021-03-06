@extends('layouts.admin')
@section('title')
    @parent Добавить новость@stop

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавить новость</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <form method="GET" action="{{ route('admin.news.index') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label for="author">Автор новости</label>
                    <input type="text" class="form-control" name="author" id="author" value="{{ old('author') }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Описание новости</label>
                    <textarea class="form-control" name="description" id="description" value="{{ old('description') }}" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
