@extends('layouts.admin')

@section('pageName', 'Разрешения')

@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Роли</li>
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12 mb-2">
                <a href="{{ route('admin.permissions.create') }}" class="btn icon icon-left btn-primary">
                    Добавить
                </a>
            </div>
            @if(session()->has('message'))
                <div class="col-12">
                    <div class="alert alert-secondary alert-dismissible show fade mb-3">
                        {{ session()->get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
                    </div>
                </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Название</th>
                                    <th>Guard name</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{ request('page') > 1 ? request('page') * config('database.per_page_admin') - config('database.per_page_admin') + $loop->iteration : $loop->iteration }}</td>
                                        <td class="text-bold-500">
                                            {{ $permission->name }}
                                        </td>
                                        <td class="text-bold-500">
                                            <span class="badge bg-light-secondary">{{ $permission->guard_name }}</span>
                                        </td>

                                        <td>
                                            <div class="btn-group btn-group-sm" permission="group">
                                                <a href="{{ route('admin.permissions.edit', $permission) }}" type="button"
                                                   class="btn btn-outline-info">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-info btn-destroy">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                            <form method="post" action="{{ route('admin.permissions.destroy', $permission) }}"
                                                  class="hiding form-destroy">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <input type="hidden" value="{{ request('page') }}" name="redirect"/>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
