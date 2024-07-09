@extends('layouts.app', ['title' => $page->title, 'description' => $page->description, 'keywords' => $page->keywords])

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumbs_box">
                        <ul>
                            <li><a href="{{ route('home') }}">Главная</a></li>
                            <li class="active">{{ $page->name }}</li>
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
                            <h1>{{ $page->name }}</h1>
                        </div>
                        <div class="content__page_view">
                            {!! $page->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
