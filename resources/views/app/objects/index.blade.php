@extends('layouts.app', ['title' => $object->name, 'description' => $object->name, 'keywords' => $object->name])

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumbs_box">
                        <ul>
                            <li><a href="{{ route('home') }}">Главная</a></li>
                            <li>
                                <a href="{{ route('page.show', ['alias' => 'catalog']) }}">Каталог недвижимости</a>
                            </li>
                            <li>
                                <a href="{{ route('object_type.show', ['alias' => $object->type->alias]) }}">{{ $object->type->name }}</a>
                            </li>
                            <li class="active">
                                {{ $object->name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div id="object_view">
                        <div class="top__object_view">
                            <a class="to_back" href="{{ route('page.show', ['alias' => 'catalog']) }}">
                                Вернуться к списку
                            </a>
                            <h1>{{ $object->name }}</h1>
                            <strong class="article">Арт. {{ $object->articul }}</strong>
                            <div class="location">
                                {{ $object->address }}
                                <span>На карте</span>
                            </div>
                            <div class="buttons">
                                <button onclick="addFavorite()" class="favorite">Добавить в избранное</button>
                                <button onclick="addToCompare()" class="compare">Сравнить</button>
                                <button onclick="share()" class="share">
                                    Поделиться ссылкой
                                </button>
                            </div>
                        </div>
                        <div class="middle__object_view">
                            <div class="left_part_object_view">
                                @if(count($object->images))
                                @if($object->is_premium === \Domain\Entities\Object\Enums\IsPremium::Yes->value)
                                    <div class="is_wellican_chose"></div>
                                @endif

                                    <div class="main_photo">

                                        <div id="carouselObjectView" class="carousel slide">
                                            <div class="carousel-indicators">
                                                @foreach($object->images as $image)
                                                    <button type="button" data-bs-target="#carouselObjectView" data-bs-slide-to="{{ $loop->index }}" aria-label="Слайд {{ $loop->index + 1 }}"></button>
                                                @endforeach
                                            </div>
                                            <div class="carousel-inner">
                                                @foreach($object->images as $image)
                                                    <div class="carousel-item">
                                                        <a data-fslightbox="carousel-gallery" href="{{ $image->url }}">
                                                            <img src="{{ $image->url }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselObjectView" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselObjectView" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>


                                    </div>

                                    <div class="shorts">
                                        @foreach($object->images as $image)
                                            <a data-fslightbox="shorts-gallery" href="{{ $image->url }}">
                                                <img src="{{ $image->thumb }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="description">
                                    {!! $object->description !!}
                                </div>
                                <div class="options">
                                    <div class="option_box">
                                        <strong class="option_head">О доме</strong>
                                        <ul class="option_items_list">
                                            <li>
                                                <span class="option_key">Площадь</span>
                                                <span class="option_value">{{ $object->square }} м<sup>2</sup></span>
                                            </li>
                                            <li>
                                                <span class="option_key">Тип недвижимости</span>
                                                <span class="option_value">{{ $object->type->name }}</span>
                                            </li>
                                            <li>
                                                <span class="option_key">Населённый пункт</span>
                                                <span class="option_value">{{ $object->location->name }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    @if(count($object->filterOptions))
                                    <div class="option_box">
                                        <strong class="option_head">Характеристики</strong>
                                        <ul class="option_items_list">
                                            @foreach($object->filterOptions as $filterOption)
                                            <li>
                                                <span class="option_key">{{ $filterOption->filter->name }}</span>
                                                <span class="option_value">{{ $filterOption->name }}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                                <div id="map" style="width: 100%; height: 300px" data-longitude="{{ $object->longitude }}" data-latitude="{{ $object->latitude }}"></div>
                            </div>

                            <div class="right_part_object_view">
                                <div class="consultation">
                                    <div class="head text-center">
                                        Консультация по объекту
                                    </div>
                                    <span class="desc text-center">
                                        Мы перезвоним вам или ответим в удобном для вас чате, расскажем подробнее об интересующем вас объекте
                                    </span>
                                    <form class="row">
                                        <div class="col-md-12">
                                            <input
                                                class="form-control"
                                                type="text"
                                                placeholder="Введите номер телефона"
                                                aria-label="default input"
                                            />
                                        </div>

                                        <div class="col-md-12 text-lg-center">
                                            <button type="submit" class="button middle">
                                                связаться с нами
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="mortgage_box">
                                    <div class="head text-center">
                                        Ипотека по объекту
                                    </div>
                                    <span class="desc text-center">10 минут на предварительное решение по ипотеке</span>
                                    <strong>Ставки от 5,75%</strong>
                                    <button class="button middle">Оформить ипотеку</button>
                                </div>
                                @if(count($news))
                                <div class="news_promotions">
                                    <div class="head">
                                        Акционные предложения
                                    </div>
                                    <ul>
                                        @foreach($news as $new)
                                        <li>
                                            <a href="{{ route('new.show', ['alias' => $new->alias]) }}">{{ $new->name }}</a>
                                            <span>{{ $new->created_at }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="similar_objects">
                            <div class="head">
                                Похожие объекты в продаже:
                            </div>
                            <div class="list">
                                <div class="obj">
                                    <a href="#">
                                        <img src="{{ asset('app/images/catalog/gal1.jpg') }}" alt="" />
                                        <span>3-х комнатная квартира в Симферополе</span>
                                    </a>
                                </div>
                                <div class="obj">
                                    <a href="#">
                                        <img src="{{ asset('app/images/catalog/gal2.jpg') }}" alt="" />
                                        <span>Частный дом в коттеджном посёлке</span>
                                    </a>
                                </div>
                                <div class="obj">
                                    <a href="#">
                                        <img src="{{ asset('app/images/catalog/gal3.jpg') }}" alt="" />
                                        <span>Частный дом в коттеджном посёлке</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=2c7dfd64-dd0a-4736-9189-cfd109a61260&lang=ru_RU" type="text/javascript"></script>
@endsection

@push('scripts')
    <script src="{{ asset('app/js/fslightbox.js') }}"></script>
@endpush
