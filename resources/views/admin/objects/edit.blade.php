@extends('layouts.admin')

@section('pageName', $object->name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.objects.index') }}">Объекты</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ $object->name }}</li>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        @input(['name' => 'name', 'label' => 'Название', 'entity' => $object])
                                    </div>

                                    <div class="col-md-6 col-12">
                                        @select(['name' => 'type_id', 'label' => 'Тип недвижимости', 'items' => $objectTypes, 'entity' => $object])
                                    </div>
                                    <div class="col-md-6 col-12">
                                        @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $object])
                                    </div>
                                    <div class="col-md-6 col-12">
                                        @select(['name' => 'location_id', 'label' => 'Населённый пункт', 'items' => $locations, 'entity' => $object])
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col-md-4 col-12">
                                                @input(['name' => 'price', 'label' => 'Цена', 'entity' => $object])
                                            </div>
                                            <div class="col-md-4 col-12">
                                                @input(['name' => 'square', 'label' => 'Площадь', 'entity' => $object])
                                            </div>
                                            <div class="col-md-4 col-12 pt-4">
                                                <div class="d-flex justify-content-end">
                                                    <input type="radio" value="Buy" class="btn-check" name="type_purchase" id="buy-option" autocomplete="off" checked />
                                                    <label class="btn btn-outline-info me-1" for="buy-option">Купить</label>
                                                    <input type="radio" value="Rent" class="btn-check" name="type_purchase" id="rent-option" autocomplete="off" />
                                                    <label class="btn btn-outline-info" for="rent-option">Снять</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col-md-4 col-12"></div>
                                            <div class="col-md-8 col-12">
                                                <fieldset class="mt-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Координаты</span>
                                                        </div>
                                                        <input type="text" name="latitude" value="{{ old('latitude', $object->latitude) }}" class="form-control" placeholder="Широта">
                                                        <input type="text" name="longitude" value="{{ old('latitude', $object->longitude) }}" class="form-control" placeholder="Долгота">
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label for="editor">Описание</label>
                                            <div id="summernote">
                                                <p>{!! $object->description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('admin.objects.index') }}" class="btn btn-light-secondary me-1 mb-1">
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

@push('scripts')
    <script src="{{ asset('dashboard/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('dashboard/static/js/pages/form-element-select.js') }}"></script>
    <script src="{{ asset('dashboard/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('dashboard/static/js/pages/summernote-ru-RU.js') }}"></script>
    <script src="{{ asset('dashboard/static/js/pages/summernote.js') }}"></script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/choices.js/public/assets/styles/choices.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/summernote/summernote-lite.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/compiled/css/form-editor-summernote.css') }}" />
@endpush
