@extends('layouts.admin')

@section('pageName', 'Добавление пользователя')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.users.index') }}">Пользователи</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Добавление пользователя</li>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @include('includes.errors.list')
                            <form class="form" method="post" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        @input(['name' => 'name', 'label' => 'Название'])
                                    </div>

                                    <div class="col-md-6 col-12">
                                        @input(['name' => 'email', 'label' => 'Email'])
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password">Пароль</label>
                                            <input type="password" id="password" class="form-control" name="password" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <fieldset class="form-group">
                                            <label for="role"></label>
                                            <select class="form-select choices" name="role" id="role">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password_confirmation">Повторить пароль</label>
                                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="new-image">Изображение</label>
                                        <input class="form-control" name="image" type="file" id="new-image"/>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-light-secondary me-1 mb-1">
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
