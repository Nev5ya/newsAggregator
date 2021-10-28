@extends('layouts.main')
@section('content')

<div class="col-lg-8">
    <div class="card mb-4">
        <img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="img" />
        <div class="card-body">
            <div class="small text-muted"><h4>ID {{ $id }}</h4></div>
            <h2 class="card-title">Featured Post Title</h2>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
        </div>
    </div>
</div>

@endsection
