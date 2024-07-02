@extends('layouts.admin')

@section('pageName', $user->name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.users.index') }}">Пользователи</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @include('includes.errors.list')
                            <form action="{{ route('admin.users.update', $user) }}" class="form" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-9">
                                                <div class="col-12">
                                                    @input(['name' => 'name', 'label' => 'Название', 'entity' => $user])
                                                </div>
                                                <div class="col-12">
                                                    @input(['name' => 'email', 'label' => 'Email', 'entity' => $user])
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="password">Пароль</label>
                                                                <input type="password" id="password" class="form-control" name="password" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <fieldset class="form-group">
                                                                <label for="role">Роль</label>
                                                                <select class="form-select choices" name="role" id="role">
                                                                    @foreach($roles as $role)
                                                                        <option value="{{ $role->id }}" @if(in_array($role->id, $user->roles->pluck('id')->toArray(), true)) selected @endif>{{ $role->name }}</option>
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
                                                            <fieldset class="form-group">
                                                                <label for="permissions">Дополнительные разрешения</label>
                                                                <select class="form-select choices multiple-remove" id="permissions" name="permissions[]" multiple>
                                                                    <optgroup label="Список разрешений">
                                                                        @foreach($permissions->whereNotIn('id', $user->getPermissionsViaRoles()->pluck('id')) as $permission)
                                                                            <option value="{{ $permission->name }}" @if (in_array($permission->id, $user->permissions->pluck('id')->toArray(), true)) selected @endif>
                                                                                {{ $permission->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                @if($user->image)
                                                    @include('includes.image.entity', ['image' => $user->image])
                                                @endif
                                                <div class="col-12 mt-4">
                                                    <label for="new-image">Изображение</label>
                                                    <input class="form-control" name="image" type="file"
                                                           id="new-image"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Сохранить
                                        </button>
                                        <a href="{{ route('admin.users.index') }}"
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
    @if($user->image)
        @include('includes.image.popup', ['image' => $user->image])
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('dashboard/static/js/pages/form-element-select.js') }}"></script>
    <script src="{{ asset('dashboard/extensions/toastify-js/src/toastify.js') }}"></script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/toastify-js/src/toastify.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dashboard/extensions/choices.js/public/assets/styles/choices.css') }}"/>
@endpush
