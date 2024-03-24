<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? '' }}"/>
    <meta name="keywords" content="{{ $keywords ?? '' }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('app/images/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('app/images/favi.png') }}"/>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />
    <link href="{{ asset('app/css/style.css') }}" rel="stylesheet"/>
</head>
<body>
<header class="{{ $headerClass ?? '' }}">
    <div class="container text-center top-menu">
        <div class="row">
            <div class="top_bar">
                <a class="logo" href="{{ route('home') }}">
                    <img src="{{ asset('app/images/logo.svg') }}" alt=""/>
                </a>
                <ul class="first_level">
                    <li>
                        <a href="{{ route('page.show', ['alias' => 'catalog']) }}">Типы недвижимости</a>
                        @if(count($objectTypes))
                            <ul class="sub">
                                @foreach($objectTypes as $objectType)
                                    <li>
                                        <a href="{{ route('object_type.show', ['alias' => $objectType->alias]) }}">
                                            {{ $objectType->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    <li><a href="{{ route('page.show', ['alias' => 'catalog']) }}">Объекты в продаже</a></li>
                    <li><a href="/">Услуги </a></li>
                    <li><a href="/ipoteka">Все об ипотеке</a></li>
                    <li><a href="{{ route('page.show', ['alias' => 'contacts']) }}">Контакты</a></li>
                </ul>
                <div class="favorites">
                    <span class="phone"><img src="{{ asset('app/images/top_phone_icon.svg') }}" alt=""> +7 (978) 939-33-33</span>
                    <a href="/"><img src="{{ asset('app/images/comparison_icon.svg') }}" alt="" /></a>
                    <a href="#"><img src="{{ asset('app/images/favorites_icon.svg') }}" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
    @yield('slogan')
</header>

@yield('content')

<footer class="section blue">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="footer_content">
                    Телефон: <br>
                    <strong>+7 (978) 939-33-33</strong>
                    <span>Крым, Красные пещеры</span>
                    <div>
                        <a href="#"><img src="{{ asset('app/images/footer/vk.svg') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('app/images/footer/whats.svg') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('app/images/footer/viber.svg') }}" alt=""></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="copy">
        © {{ date('Y') }}, Wellican Бюро недвижимости
    </div>
</footer>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
></script>

<script src="{{ asset('app/js/main.js') }}"></script>
@stack('scripts')
</body>
</html>
