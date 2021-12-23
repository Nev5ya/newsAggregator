@extends('layouts.admin')
@section('title')
    @parent {{ $action = request()->routeIs('*.create') ? 'Добавить' : 'Изменить' }} категорию@stop

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $action }} категорию</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <form method="POST" action="{{ $action === 'Добавить' ? route('admin.category.store') : route('admin.category.update', $category) }}">
                @csrf
                @if($action === 'Изменить')
                    @method("PUT")
                @endif
                <div class="form-group">
                    <label for="category">Название категории(EN)</label>
                    <input type="text" class="form-control" name="category" id="category" value="{{ old('category') ?? $category->category ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="slug">Slug категории(RU)</label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') ?? $category->slug ?? '' }}" required>
                </div>
                <button dusk="addCategory" type="submit" class="btn btn-success">{{ $action }}</button>
            </form>
        </div>
    </div>
@endsection
