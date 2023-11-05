<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Wellikan</title>
    <link rel="shortcut icon" href="{{ asset('app/images/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('app/images/favi.png') }}"/>
    <link rel="stylesheet" href="{{ asset('dashboard/compiled/css/app.css') }}" />
    @stack('css')
</head>

<body>
<div id="app">
    <div id="sidebar">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header position-relative">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="{{ route('admin.home') }}">
                            <img src="{{ asset('dashboard/compiled/svg/logo.svg') }}" alt="Wellikan" srcset="" />
                        </a>
                    </div>
                    <div class="theme-toggle d-flex gap-2 align-items-center mt-2"></div>
                    <div class="sidebar-toggler x">
                        <a href="#" class="sidebar-hide d-xl-none d-block">
                            <i class="bi bi-x bi-middle"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title sidebar-item active">Меню</li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.pages.index') }}" class="sidebar-link">
                            <i class="bi bi-file-earmark"></i>
                            <span>Страницы</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.news.index') }}" class="sidebar-link">
                            <i class="bi bi-newspaper"></i>
                            <span>Новости</span>
                        </a>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-folder-fill"></i>
                            <span>Каталог</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="{{ route('admin.objects.index') }}" class="submenu-link">
                                    Объекты
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.locations.index') }}" class="sidebar-link">
                            <i class="bi bi-geo-alt"></i>
                            <span>Населённые пункты</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.object-types.index') }}" class="sidebar-link">
                            <i class="bi bi-list-ol"></i>
                            <span>Типы недвижимости</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.users.index') }}" class="sidebar-link">
                            <i class="bi bi-people-fill"></i>
                            <span>Пользователи</span>
                        </a>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-lock-fill"></i>
                            <span>Роли</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="{{ route('admin.roles.index') }}" class="submenu-link">
                                    Роли
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ route('admin.permissions.index') }}" class="submenu-link">
                                    Разрешения
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>@yield('pageName')</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.home') }}">Dashboard</a>
                                </li>
                                @yield('breadcrumbs')
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            @yield('content')
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>{{ date('Y') }} &copy; Wellikan</p>
                </div>
                <div class="float-end"></div>
            </div>
        </footer>
    </div>
</div>

<script src="{{ asset('dashboard/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dashboard/compiled/js/app.js') }}"></script>
<script src="{{ asset('dashboard/extensions/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/static/js/user_scripts.js') }}"></script>
@stack('scripts')
</body>
</html>
