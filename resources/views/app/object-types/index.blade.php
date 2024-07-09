@extends('layouts.app', ['title' => $objectType->name])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumbs_box">
                    <ul>
                        <li><a href="{{ route('home') }}">Главная</a></li>
                        <li>
                            <a href="{{ route('page.show', ['alias' => 'catalog']) }}">Каталог недвижимости</a>
                        </li>
                        <li class="active">{{ $objectType->name }}</li>
                    </ul>
                </div>
                <div class="head_title_box">
                    <h1 class="head_title">{{ $objectType->name }}</h1>
                </div>
            </div>
        </div>
    </div>
    @include('includes.object.list', ['objects' => $objects, 'selectedObjectType' => $objectType, 'showAdditionalFilters' => true])
@endsection
