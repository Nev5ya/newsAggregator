@extends('layouts.main')

@section('content')

    <div class="col-lg-8">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            @forelse($newsList as $category => $news)
                <div class="col-lg-6">
                        @foreach($news as $eachNews)
                            <div class="card mb-4">
                                <a href="#"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="img" /></a>
                                <div class="card-body">
                                    <div class="small text-muted">{{ $eachNews['created_at'] }}</div>
                                    <h2 class="card-title h4">{{ $eachNews['title'] }}</h2>
                                    <p class="card-text">{!! $eachNews['description'] !!}</p>
                                    <p class="card-text">{{ $eachNews['author'] }}</p>
                                    <p class="card-text"><span class="fw-bold">Категория:</span> {{ $category }}</p>
                                    <a class="btn btn-primary" href="{{ route('news.show', ['id' => $eachNews['id']]) }}">Read more →</a>
                                </div>
                            </div>
                        @endforeach
                </div>
            @empty
                <h2 class="card-title h4">Новостей нет.</h2>
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
