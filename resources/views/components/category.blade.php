<div class="col-lg-4">
    <div class="card mb-4">
        <div class="card-header">Категории</div>
        <div class="card-body">
            <div class="row">
                <ul class="list-unstyled d-flex justify-content-evenly">
                    @foreach($categories as $category)
                        <li class="list-group-item-light"><a href="#!" class="text-decoration-none">{{ $category }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
