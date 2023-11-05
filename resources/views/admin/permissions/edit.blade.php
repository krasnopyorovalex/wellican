@extends('layouts.admin')

@section('pageName', $permission->name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.permissions.index') }}">Роли</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ $permission->name }}</li>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.permissions.update', $permission) }}" class="form" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        @input(['name' => 'name', 'label' => 'Название', 'entity' => $permission])
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('admin.permissions.index') }}"
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
