@extends('layouts.admin')

@section('pageName', $objectLabel->name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.object-labels.index') }}">Список меток</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ $objectLabel->name }}</li>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.object-labels.update', $objectLabel) }}" class="form" method="post">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-12">
                                        @input(['name' => 'name', 'label' => 'Населённый пункт', 'entity' => $objectLabel])
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

