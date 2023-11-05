@extends('layouts.admin')

@section('pageName', $objectType->name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.object-types.index') }}">Населённые пункты</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ $objectType->name }}</li>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.object-types.update', $objectType) }}" class="form" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        @input(['name' => 'name', 'label' => 'Населённый пункт', 'entity' => $objectType])
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $objectType])
                                                    </div>

                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="summernote">Описание</label>
                                                        <textarea id="summernote" name="description">{!! old('description', $objectType->description) !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                @if($objectType->image)
                                                    @include('includes.image.entity', ['image' => $objectType->image])
                                                @endif
                                                <div class="col-12">
                                                    <label for="new-image">Изображение</label>
                                                    <input class="form-control" name="image" type="file" id="new-image"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('admin.object-types.index') }}" class="btn btn-light-secondary me-1 mb-1">
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
    @if($objectType->image)
        @include('includes.image.popup', ['image' => $objectType->image])
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('dashboard/static/js/pages/summernote-ru-RU.js') }}"></script>
    <script src="{{ asset('dashboard/static/js/pages/summernote.js') }}"></script>
    <script src="{{ asset('dashboard/extensions/toastify-js/src/toastify.js') }}"></script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/choices.js/public/assets/styles/choices.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/summernote/summernote-lite.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/compiled/css/form-editor-summernote.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/toastify-js/src/toastify.css') }}"/>
@endpush
