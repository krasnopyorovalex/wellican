@extends('layouts.admin')

@section('pageName', 'Список объектов')

@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Список объектов</li>
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Цена</th>
                                    <th>Площадь</th>
                                    <th>Тип покупки</th>
                                    <th>Создан</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objects as $object)
                                    <tr>
                                        <td class="text-bold-500">
                                            {{ $object->name }}
                                            <p class="text-muted text-sm mb-0">
                                                <a href="{{ route('admin.object-types.edit', $object->type) }}" target="_blank">
                                                    {{ $object->type->name }}
                                                </a>
                                            </p>
                                        </td>
                                        <td class="text-bold-500">{{ $object->price }} {{ config('app.currency_icon') }}</td>
                                        <td>{{ $object->square }} м<sup>2</sup></td>
                                        <td>{{ __(sprintf('entities.%s', $object->type_purchase)) }}</td>
                                        <td>
                                            {{ $object->created_at }}
                                            <p class="text-muted text-sm">Обновлён: {{ $object->updated_at->diffForHumans() }}</p>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="{{ route('admin.objects.edit', $object) }}" type="button" class="btn btn-outline-info">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-info">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                            <form method="post" action="{{ route('admin.objects.destroy', $object) }}" class="hiding form-delete">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
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
