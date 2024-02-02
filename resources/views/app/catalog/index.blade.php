@extends('layouts.app', ['title' => 'Каталог', 'description' => 'Описание', 'keywords' => ''])

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumbs_box">
                        <ul>
                            <li><a href="{{ route('home') }}">Главная</a></li>
                            <li class="active">Каталог недвижимости</li>
                        </ul>
                    </div>
                    <div class="head_title_box">
                        <h1 class="head_title">Каталог недвижимости</h1>
                    </div>
                </div>
            </div>
        </div>
        @if(count($objectTypes))
        <div class="container text-center estate_types">
            <div class="row gx-2">
                <div class="col-2">
                    <a href="{{ route('catalog.show') }}?is_premium={{ \Domain\Entities\Object\Enums\IsPremium::Yes }}" class="figure">
                        <img src="{{ asset('app/images/estate-types/type1.jpg') }}" alt="" />
                        <strong class="estate_type_title">недвижимость от wellican</strong>
                    </a>
                </div>
                @foreach($objectTypes as $objectType)
                <div class="col-2">
                    <a href="{{ route('object_type.show', ['alias' => $objectType->alias]) }}" class="figure">
                        @if($objectType->image)
                            <img src="{{ $objectType->image->url }}" alt="{{ $objectType->image->alt }}" title="{{ $objectType->image->title }}" />
                        @endif
                        <strong class="estate_type_title">{{ $objectType->name }}</strong>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @include('includes.object.list', ['objects' => $objects])
    </main>
@endsection
