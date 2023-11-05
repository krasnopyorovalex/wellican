@extends('layouts.admin')

@section('pageName', 'Добавление роли')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.roles.index') }}">Роли</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Добавление роли</li>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @include('includes.errors.list')
                            <form class="form" method="post" action="{{ route('admin.roles.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        @input(['name' => 'name', 'label' => 'Название'])
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <fieldset class="form-group">
                                            <label for="permissions">Разрешени:</label>
                                            <select class="form-select choices multiple-remove" id="permissions" name="permissions[]" multiple>
                                                <optgroup label="Список разрешений">
                                                    @foreach($permissions as $permission)
                                                        <option value="{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('admin.roles.index') }}" class="btn btn-light-secondary me-1 mb-1">
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
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/choices.js/public/assets/styles/choices.css') }}"/>
@endpush
