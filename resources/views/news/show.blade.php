@extends('layouts.main')

@section('title')
    Новость | {{ isset($news['title']) }} @stop
@section('content')
<div class="col-lg-8">
    @if(!is_array($news))
        <h2 class="card-title">Такой новости не существует.</h2>
    @else
    <div class="card mb-4">
        <img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="img" />
        <div class="card-body">
            <h2 class="card-title">{{ $news['title'] }}</h2>
            <p class="card-text">{{ $news['description'] }}</p>
            <p class="card-text">{{ $news['author'] }}</p>
            <p class="card-text text-muted">{{ $news['created_at'] }}</p>
        </div>
    </div>
    @endif
</div>
@endsection
