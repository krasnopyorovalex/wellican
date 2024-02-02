@extends('layouts.app', ['title' => $info->title, 'description' => $info->description, 'keywords' => $info->keywords)

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumbs_box">
                        <ul>
                            <li><a href="{{ route('page.show') }}">Главная</a></li>
                            <li><a href="{{ route('page.show') }}">Новости</a></li>
                            <li class="active">{{ $info->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div id="page_view">
                        <div class="top__page_view">
                            <h1>{{ $info->name }}</h1>
                        </div>
                        <div class="content__page_view">
                            {!! $info->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
