@extends('layouts.admin')

@section('pageName', 'Список типов недвижимости')

@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Список типов недвижимости</li>
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12 mb-2">
                <a href="{{ route('admin.object-types.create') }}" class="btn icon icon-left btn-primary">
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
                                    <th>alias</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objectTypes as $objectType)
                                    <tr>
                                        <td>{{ request('page') > 1 ? request('page') * config('database.per_page_admin') - config('database.per_page_admin') + $loop->iteration : $loop->iteration }}</td>
                                        <td class="text-bold-500">
                                            {{ $objectType->name }}
                                        </td>
                                        <td class="text-bold-500">
                                            <span class="badge bg-light-secondary">{{ $objectType->alias }}</span>
                                        </td>

                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.object-types.edit', $objectType) }}"
                                                   type="button" class="btn btn-outline-info">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <a href="{{ route('admin.filters.index', $objectType) }}"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Список фильтров"
                                                   type="button" class="btn btn-outline-info">
                                                    <i class="bi bi-list"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-info btn-destroy">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                            <form method="post"
                                                  action="{{ route('admin.object-types.destroy', $objectType) }}"
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
                        {{ $objectTypes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
