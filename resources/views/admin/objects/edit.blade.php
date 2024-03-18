@php use Domain\Entities\Object\Enums\IsPremium;use Domain\Entities\Object\Enums\TypePurchase; @endphp
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
                            @include('includes.errors.list')
                            <form action="{{ route('admin.objects.update', $object) }}" class="form" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general"
                                           role="tab" aria-controls="general" aria-selected="false"
                                           tabindex="-1">Общее</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="gallery-tab" data-bs-toggle="tab" href="#gallery"
                                           role="tab" aria-controls="gallery" aria-selected="false" tabindex="-1">Галерея</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="filters-tab" data-bs-toggle="tab" href="#filters"
                                           role="tab" aria-controls="filters" aria-selected="true">Фильтры</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="general" role="tabpanel"
                                         aria-labelledby="general-tab">
                                        <div class="row mt-3">
                                            <div class="col-md-9 col-12">
                                                @input(['name' => 'address', 'label' => 'Адрес', 'entity' => $object])
                                            </div>

                                            <div class="col-md-3 col-12">
                                                @input(['name' => 'articul', 'label' => 'Артикул', 'entity' => $object])
                                            </div>

                                            <div class="col-md-6 col-12">
                                                @input(['name' => 'name', 'label' => 'Название', 'entity' => $object])
                                            </div>

                                            <div class="col-md-6 col-12">
                                                @select(['name' => 'type_id', 'label' => 'Тип недвижимости', 'items' =>
                                                $objectTypes, 'entity' => $object])
                                            </div>
                                            <div class="col-md-6 col-12">
                                                @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $object])
                                            </div>
                                            <div class="col-md-6 col-12">
                                                @select(['name' => 'location_id', 'label' => 'Населённый пункт', 'items'
                                                =>
                                                $locations, 'entity' => $object])
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="row">
                                                    <div class="col-md-4 col-12">
                                                        @input(['name' => 'price', 'label' => 'Цена', 'entity' =>
                                                        $object])
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        @input(['name' => 'square', 'label' => 'Площадь', 'entity' =>
                                                        $object])
                                                    </div>
                                                    <div class="col-md-4 col-12 pt-4">
                                                        <div class="d-flex justify-content-end">
                                                            <input type="radio" value="{{ TypePurchase::Buy }}" class="btn-check"
                                                                   name="type_purchase" id="buy-option"
                                                                   autocomplete="off"{{ old('type_purchase', $object->type_purchase) !== TypePurchase::Rent->value ? ' checked' : '' }} />
                                                            <label class="btn btn-outline-info me-1" for="buy-option">Купить</label>
                                                            <input type="radio" value="{{ TypePurchase::Rent }}" class="btn-check"
                                                                   name="type_purchase" id="rent-option"
                                                                   autocomplete="off"{{ old('type_purchase', $object->type_purchase) === TypePurchase::Rent->value ? ' checked' : '' }} />
                                                            <label class="btn btn-outline-info"
                                                                   for="rent-option">Снять</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="row">
                                                    <div class="col-md-8 col-12">
                                                        <fieldset class="mt-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Координаты</span>
                                                                </div>
                                                                <input type="text" name="latitude"
                                                                       value="{{ old('latitude', $object->latitude) }}"
                                                                       class="form-control" placeholder="Широта">
                                                                <input type="text" name="longitude"
                                                                       value="{{ old('latitude', $object->longitude) }}"
                                                                       class="form-control" placeholder="Долгота">
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-check mt-4 d-flex justify-content-end pt-1">
                                                            <div class="checkbox">
                                                                <input type="checkbox" name="is_premium" id="is_premium"
                                                                       value="yes"
                                                                       class="form-check-input"{{ old('is_premium', $object->is_premium) === IsPremium::Yes->value ? ' checked' : '' }} />
                                                                <label for="is_premium">Премиум?</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="summernote">Описание</label>
                                                    <textarea id="summernote"
                                                              name="description">{!! old('description', $object->description) !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="gallery" role="tabpanel"
                                         aria-labelledby="gallery-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="divider divider-left">
                                                    <div class="divider-text">Изображения</div>
                                                </div>
                                                <!-- File uploader with multiple files upload -->
                                                <input type="file" class="multiple-files-filepond" multiple/>
                                            </div>
                                            @if($object->images)
                                                <div class="col-12" id="gallery-box">
                                                    <div class="row" id="sortable-grid">
                                                        @foreach($object->images as $image)
                                                            <div
                                                                class="col-6 col-sm-4 col-lg-2 mt-2 mb-2 position-relative single-image"
                                                                style="display: table-cell">
                                                                <a href="{{ asset($image->url) }}"
                                                                   data-gallery="example-gallery"
                                                                   data-toggle="lightbox">
                                                                    <img class="w-100 rounded"
                                                                         src="{{ asset($image->thumb) }}"
                                                                         alt="{{ $image->alt }}"
                                                                         title="{{ $image->title }}"
                                                                         data-id="{{ $image->id }}"/>
                                                                </a>
                                                                <div
                                                                    class="position-absolute z-1 end-0 bottom-0 me-3 mb-1">
                                                                    <div class="btn-group btn-group-sm">
                                                                        <button type="button"
                                                                                class="btn btn-info btn-image-move">
                                                                            <i class="bi-arrows-move"></i>
                                                                        </button>
                                                                        <button type="button"
                                                                                class="btn btn-info btn-image-edit"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#image-edit">
                                                                            <i class="bi-pencil-fill"></i>
                                                                        </button>
                                                                        <button type="button"
                                                                                class="btn btn-info btn-image-destroy"
                                                                                data-href="{{ route('admin.object-images.destroy', $image) }}">
                                                                            <i class="bi-trash-fill"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <hr>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="filters" role="tabpanel" aria-labelledby="filters-tab">
                                        <div class="row mt-3">
                                            @foreach($object->type->filters as $filter)
                                            <div class="col-md-3 mb-4">
                                                <h6>{{ $filter->name }}</h6>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="filters[{{ $filter->id }}]">
                                                        <option value="">Не выбрано</option>
                                                        @foreach($filter->options as $option)
                                                            <option value="{{ $option->id }}" @if($object->filterOptions->firstWhere('id', $option->id)) selected @endif>
                                                                {{ $option->value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('admin.objects.index') }}"
                                           class="btn btn-light-secondary me-1 mb-1">
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

    <div class="modal fade text-left" id="image-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        SEO для изображения
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <label for="image-title">Title: </label>
                        <div class="form-group">
                            <input id="image-title" type="text" name="title" placeholder="title" class="form-control"/>
                        </div>
                        <label for="image-alt">Alt: </label>
                        <div class="form-group">
                            <input id="image-alt" type="text" name="alt" placeholder="alt" class="form-control"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Закрыть</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Сохранить</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('dashboard/static/js/pages/form-element-select.js') }}"></script>
    <script src="{{ asset('dashboard/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('dashboard/static/js/pages/summernote-ru-RU.js') }}"></script>
    <script src="{{ asset('dashboard/static/js/pages/summernote.js') }}"></script>
    <script src="{{ asset('dashboard/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('dashboard/extensions/filepond/filepond.js') }}"></script>
    <script src="{{ asset('dashboard/extensions/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('dashboard/static/js/pages/filepond-multiple.js') }}"></script>
    <script src="{{ asset('dashboard/extensions/lightbox/lightbox.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/extensions/sortable/sortable.js') }}"></script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/choices.js/public/assets/styles/choices.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/summernote/summernote-lite.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dashboard/compiled/css/form-editor-summernote.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/filepond/filepond.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/toastify-js/src/toastify.css') }}"/>
@endpush
