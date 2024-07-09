@extends('layouts.admin')

@section('pageName', 'Добавление метки')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.object-labels.index') }}">Список меток</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Добавление метки</li>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @include('includes.errors.list')
                            <form class="form" method="post" action="{{ route('admin.object-labels.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        @input(['name' => 'name', 'label' => 'Название'])
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('admin.object-labels.index') }}" class="btn btn-light-secondary me-1 mb-1">
                                            Назад
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
