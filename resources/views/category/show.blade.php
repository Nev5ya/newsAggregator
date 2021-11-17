@extends('layouts.main')
@section('title')
    Категории | {{ $currentCategory }} @stop

@section('content')
    <div class="col-lg-8">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            @forelse($newsList as $news)
                <div class="col-lg-6">
                        <div class="card mb-4">
                            <a href="{{ route('news.show', ['id' => $news->id]) }}"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="img" /></a>
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
        <nav aria-label="Pagination">
            <hr class="my-0" />
            <ul class="pagination justify-content-center my-4">
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                <li class="page-item"><a class="page-link" href="#!">2</a></li>
                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                <li class="page-item"><a class="page-link" href="#!">15</a></li>
                <li class="page-item"><a class="page-link" href="#!">Older</a></li>
            </ul>
        </nav>
    </div>
@endsection
