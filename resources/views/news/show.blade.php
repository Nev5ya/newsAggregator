@extends('layouts.app')
@section('header', $news?->title ?? 'Not found.')

@section('title')
    Новость | {{ $news->title ?? 'Отсутствует' }} @stop
@section('content')
<div class="col-lg-6">
    @if(!is_object($news))
        <h2 class="card-title">Такой новости не существует.</h2>
    @else
    <div class="card mb-4">
        <img class="card-img" src="{{ asset($news->image) }}" alt="img" />
        <div class="card-body">
            <h2 class="card-title">{{ $news->title }}</h2>
            <p class="card-text">{!! $news->description !!}</p>
            <a href="{{ $news->link }}" class="card-link">Смотреть в источнике</a>
            <p class="card-text text-muted">{{ date('H:i:s d.m.Y', strtotime($news->publicDate)) }}</p>
        </div>
    </div>
    @endif
</div>
@endsection
