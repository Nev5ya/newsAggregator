@extends('layouts.app')
@section('title')
    Категории | {{ $currentCategory }} @stop

@section('header', $currentCategory)

@section('content')
    <div class="col-lg-8">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            @forelse($newsList as $news)
                <div class="col-lg-6">
                        <div class="card mb-4">
                            <a href="{{ route('news.show', ['id' => $news->id]) }}"><img class="card-img-top" src="{{ asset($news->image) }}" alt="img" /></a>
                            <div class="card-body">
                                <div class="small text-muted">{{ $news->created_at }}</div>
                                <h2 class="card-title h4">{{ $news->title }}</h2>
                                <p class="card-text">{!! $news->description !!}</p>
                                <p class="card-text">{{ $news->author }}</p>
                                <a class="btn btn-primary" href="{{ route('news.show', ['id' => $news->id]) }}">Read more →</a>
                            </div>
                        </div>
                </div>
            @empty
                <h2 class="card-title h4">Новостей по такой категории нет.</h2>
            @endforelse
        </div>
        <!-- Pagination-->
    </div>
@endsection
