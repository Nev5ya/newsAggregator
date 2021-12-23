{{--todo create popular themes--}}
<div class="col-lg-3 ml-5 d-none">
    <div class="card">
        <div class="card-header">Популярные темы</div>
        <div class="card-body">
            <ul class="list-unstyled navbar-brand m-0">
                @foreach($categories as $item)
                    <li class="list-group-item-light"><a href="{{ route('category.show', ['id' => $item->category]) }}" class="text-decoration-none text-left">{{ $item->slug }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
