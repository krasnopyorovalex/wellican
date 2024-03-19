@extends('layouts.admin')

@section('pageName', 'Список объектов')

@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Список объектов</li>
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12 mb-2">
                <a href="{{ route('admin.objects.create') }}" class="btn icon icon-left btn-primary">
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
                                    <th>Цена</th>
                                    <th>Артикул</th>
                                    <th>Площадь</th>
                                    <th>Тип покупки</th>
                                    <th>Создан</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objects as $object)
                                    <tr>
                                        <td>{{ request('page') > 1 ? request('page') * config('database.per_page_admin') - config('database.per_page_admin') + $loop->iteration : $loop->iteration }}</td>
                                        <td class="text-bold-500">
                                            {{ $object->name }}
                                            <div>
                                                <a href="{{ route('admin.object-types.edit', $object->type) }}" target="_blank" class="text-muted text-sm">
                                                    {{ $object->type->name }}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-bold-500">
                                            <span class="badge bg-light-secondary">{{ $object->price }}</span>
                                        </td>
                                        <td class="text-bold-500">
                                            <span class="badge bg-light-secondary">{{ $object->articul }}</span>
                                        </td>
                                        <td><span class="badge bg-light-secondary">{{ $object->square }} м<sup>2</sup></span></td>
                                        <td>{{ __(sprintf('entities.%s', $object->type_purchase)) }}</td>
                                        <td>
                                            <div>{{ $object->created_at }}</div>
                                            <div class="text-muted text-sm">Обновлён: {{ $object->updated_at->diffForHumans() }}</div>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.objects.edit', $object) }}" type="button" class="btn btn-outline-info">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-info btn-destroy">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                            <form method="post" action="{{ route('admin.objects.destroy', $object) }}" class="hiding form-destroy">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <input type="hidden" value="{{ request('page') }}" name="redirect" />
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $objects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
