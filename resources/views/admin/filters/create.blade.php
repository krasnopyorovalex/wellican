@extends('layouts.admin')

@section('pageName', 'Список фильтров')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.object-types.index') }}">Типы недвижимости</a></li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.filters.index', $parentId) }}">Список фильтров</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Добавление фильтра</li>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @include('includes.errors.list')
                            <form class="form" method="post" action="{{ route('admin.filters.store', $parentId) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        @input(['name' => 'name', 'label' => 'Название'])
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <fieldset class="form-group">
                                            <label for="tpl">Шаблон страницы:</label>
                                            <select class="form-select choices" name="tpl" id="tpl">
                                                @foreach(\App\Domain\Entities\Filter\Enums\Template::cases() as $tpl)
                                                    <option value="{{ $tpl }}">
                                                        {{ __(sprintf('entities.filters.tpl.%s', $tpl->value)) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('admin.filters.index', $parentId) }}"
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
@endsection
