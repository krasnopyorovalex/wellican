@extends('layouts.admin')

@section('pageName', $location->name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.locations.index') }}">Населённые пункты</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ $location->name }}</li>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.locations.update', $location) }}" class="form" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        @input(['name' => 'name', 'label' => 'Населённый пункт', 'entity' => $location])
                                    </div>
                                    <div class="col-md-6 col-12">
                                        @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $location])
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label for="summernote">Описание</label>
                                            <textarea id="summernote" name="description">{!! old('description', $location->description) !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('admin.locations.index') }}" class="btn btn-light-secondary me-1 mb-1">
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
    <script src="{{ asset('dashboard/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('dashboard/static/js/pages/summernote-ru-RU.js') }}"></script>
    <script src="{{ asset('dashboard/static/js/pages/summernote.js') }}"></script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/choices.js/public/assets/styles/choices.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/summernote/summernote-lite.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/compiled/css/form-editor-summernote.css') }}" />
@endpush
