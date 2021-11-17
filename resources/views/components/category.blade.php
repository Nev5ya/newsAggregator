<div class="col-lg-4">
    <div class="card mb-4">
        <div class="card-header">Категории</div>
        <div class="card-body">
            <div class="row">
                <ul class="list-unstyled d-flex justify-content-evenly">
                    @foreach($categories as $item)
                        <li class="list-group-item-light"><a href="{{ route('category.show', ['id' => $item->category]) }}" class="text-decoration-none">{{ $item->slug }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
