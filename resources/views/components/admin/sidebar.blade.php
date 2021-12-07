<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Админка</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('news.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Перейти на сайт</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item @if(request()->routeIs('admin.news.*')) active @endif">
        <a class="nav-link" href="{{ route('admin.news.index') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Новости</span></a>
    </li>

    <li class="nav-item @if(request()->routeIs('admin.category.*')) active @endif">
        <a class="nav-link" href="{{ route('admin.category.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Категории</span></a>
    </li>

    <li class="nav-item @if(request()->routeIs('admin.users.*')) active @endif">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Пользователи</span></a>
    </li>

    <li class="nav-item @if(request()->routeIs('admin.download')) active @endif">
        <a class="nav-link" href="{{ route('admin.download.index') }}">
            <i class="fas fa-fw fa-download"></i>
            <span>Выгрузить данные</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />
</ul>
