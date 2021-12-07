@extends('layouts.admin')
@section('title')
    @parent Список пользователей @stop

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
        <h1 class="h3 mb-0 text-gray-800">Список пользователей</h1>
    </div>
    <hr class="sidebar-divider">
    <div class="row">
        <div class="col-md-12">
            @if(empty($users->all()))
                <h2>Пользователей нет.</h2>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Имя пользователя</th>
                            <th>E-Mail</th>
                            <th>Дата регистрации</th>
                            <th>Дата изменения</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                        @csrf
                                        @method("DELETE")
                                        <a class="btn btn-facebook mb-1"
                                           href="{{ route('admin.users.edit', $user) }}"><i
                                                class="fas fa-edit fa-sm text-white-50"></i>&nbsp; Редактировать</a>
                                        <button class="btn btn-google mb-1" type="submit"><i
                                                class="fas fa-trash fa-sm text-white-50"></i>&nbsp; Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <!-- Pagination-->
    {{ $users->links() }}

@endsection
