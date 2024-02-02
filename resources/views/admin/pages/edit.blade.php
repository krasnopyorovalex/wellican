@extends('layouts.admin')

@section('pageName', $page->name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.pages.index') }}">Страницы</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ $page->name }}</li>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @include('includes.errors.list')
                            <form action="{{ route('admin.pages.update', $page) }}" class="form" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        @input(['name' => 'name', 'label' => 'Название', 'entity' => $page])
                                    </div>
                                    <div class="col-md-6 col-12">
                                        @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $page])
                                    </div>
                                    <div class="col-md-6 col-12">
                                        @input(['name' => 'title', 'label' => 'Title', 'entity' => $page])
                                    </div>
                                    <div class="col-md-6 col-12">
                                        @input(['name' => 'description', 'label' => 'Description', 'entity' => $page])
                                    </div>
                                    <div class="col-md-6 col-12">
                                        @input(['name' => 'keywords', 'label' => 'Keywords', 'entity' => $page])
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <fieldset class="form-group">
                                            <label for="tpl">Шаблон страницы:</label>
                                            <select class="form-select choices" name="template" id="tpl">
                                                @foreach(\Domain\Entities\Page\Enums\Template::cases() as $tpl)
                                                    <option value="{{ $tpl }}" @if($tpl->value === $page->template) selected @endif>
                                                        {{ __(sprintf('entities.pages.tpl.%s', $tpl->value)) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label for="summernote">Описание</label>
                                            <textarea id="summernote" name="body">{!! old('body', $page->body) !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('admin.pages.index') }}" class="btn btn-light-secondary me-1 mb-1">
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
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/summernote/summernote-lite.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/compiled/css/form-editor-summernote.css') }}" />
@endpush
