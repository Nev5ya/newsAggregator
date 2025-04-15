@extends('layouts.admin')
@section('title')
    @parent Добавить ресурс@stop

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавить ресурс</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <form method="POST" action="{{ route('admin.resource.store') }}">
                @csrf
                <div class="form-group">
                    <label for="link">Ссылка</label>
                    <input type="url" class="form-control" name="link" id="link" value="{{ old('link') }}" required>
                </div>
                <button dusk="addResource" type="submit" class="btn btn-success">Добавить</button>
            </form>
        </div>
    </div>
@endsection
