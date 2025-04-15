@extends('layouts.admin')
@section('title', 'Ресурсы')

@section('content')
    @if(session('type'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Список ресурсов</h1>
        <a href="{{ route('admin.resource.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i>&nbsp; Добавить ресурс</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Ссылка</th>
                        <th>Управление</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($resources as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->link }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.resource.destroy', $item) }}">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-google" type="submit"><i class="fas fa-trash fa-sm text-white-50"></i>&nbsp; Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <h2>Ресурсов нет</h2>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Pagination-->
    {{ $resources->links() }}
@endsection
