@extends('layouts.admin')

@section('pageName', 'Список фильтров')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.object-types.index') }}">Типы недвижимости</a></li>
    <li class="breadcrumb-item active" aria-current="page">Список фильтров</li>
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12 mb-2">
                <a href="{{ route('admin.filters.create', $parentId) }}" class="btn icon icon-left btn-primary">
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
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($filters as $filter)
                                    <tr>
                                        <td>{{ request('page') > 1 ? request('page') * config('database.per_page_admin') - config('database.per_page_admin') + $loop->iteration : $loop->iteration }}</td>
                                        <td class="text-bold-500">
                                            {{ $filter->name }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.filters.edit', ['parentId' => $parentId, 'id' => $filter->id]) }}"
                                                   type="button" class="btn btn-outline-info">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <a href="{{ route('admin.filter-options.index', ['filterId' => $filter->id]) }}"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Список занчений фильтра {{ $filter->name }}"
                                                   type="button" class="btn btn-outline-info">
                                                    <i class="bi bi-list"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-info btn-destroy">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                            <form method="post"
                                                  action="{{ route('admin.filters.destroy', ['parentId' => $parentId, 'id' => $filter->id]) }}"
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
                        {{ $filters->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
