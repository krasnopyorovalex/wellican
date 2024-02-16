<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Войти в панель администрирования Wellican</title>
    <link rel="shortcut icon" href="{{ asset('app/images/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('app/images/favi.png') }}"/>
    <link rel="stylesheet" href="{{ asset('dashboard/compiled/css/auth-forgot-password.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/compiled/css/app.css') }}" />
</head>
<body>
    @yield('content')
</body>
</html>
