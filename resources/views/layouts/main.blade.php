<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@section('title') Главная | @show</title>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
</head>
<body>
<x-header></x-header>
<div class="container">
    <div class="row">
        @yield('content')
        <!-- Side widgets-->
        @if(@request()->is(['/', 'news/*', 'category/*']))<x-category></x-category>@endif
    </div>
</div>
<x-footer></x-footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
