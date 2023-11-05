@extends('layouts.admin')

@section('pageName', sprintf('Добавление значения фильтра «%s»', $filter->name))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.filters.index', $filter->parent_id) }}">Список фильтров</a></li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.filter-options.index', $filter->id) }}">Список значений фильтра «{{ $filter->name }}»</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Добавление значения фильтра</li>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @include('includes.errors.list')
                            <form class="form" method="post" action="{{ route('admin.filter-options.store', $filter->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        @input(['name' => 'name', 'label' => 'Название'])
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('admin.filter-options.index', $filter->id) }}" class="btn btn-light-secondary me-1 mb-1">
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
