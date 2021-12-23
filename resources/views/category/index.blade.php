@extends('layouts.app')

@section('title', 'Список категорий')
@section('header', 'Все категории')

@section('content')
    <ul class="list-unstyled navbar-brand d-flex flex-column flex-xl-grow-1">
        @foreach($categories as $item)
            <li class="list-group-item-light"><a href="{{ route('category.show', ['id' => $item->category]) }}" class="text-decoration-none">{{ $item->slug }}</a></li>
        @endforeach
    </ul>
@endsection
