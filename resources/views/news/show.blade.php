@extends('layouts.app')
@section('header', $news?->title ?? 'Not found.')

@section('title')
    Новость | {{ $news->title ?? 'Отсутствует' }} @stop
@section('content')
    @if(session('type'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
<div class="col-lg-6">
    @if(!is_object($news))
        <h2 class="card-title">Такой новости не существует.</h2>
    @else
    <div class="card mb-4">
        <img class="card-img" src="{{ asset($news->image) }}" alt="img" />
        <div class="card-body">
            <h2 class="card-title">{{ $news->title }}</h2>
            <p class="card-text">{{ $news->description }}</p>
            <p class="card-text">{{ $news->author }}</p>
            <p class="card-text text-muted">{{ $news->created_at }}</p>
        </div>
    </div>
    @endif
</div>
@endsection
