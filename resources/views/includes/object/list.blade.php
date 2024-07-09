<div class="container text-center filters_box">
    <div class="row gx-2">
        <div class="col-xl-12">
            <div class="form_box">
                @include('includes.forms.search', ['selectedObjectType' => $selectedObjectType ?? false, 'showAdditionalFilters' => $showAdditionalFilters ?? false])
            </div>
            <div class="sort_box">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="sort_button" data-bs-toggle="dropdown" aria-expanded="false">
                    Сортировать объекты
                </button>
                <ul class="dropdown-menu" aria-labelledby="sort_button">
                    <li>
                        <a class="dropdown-item" href="#">По умолчанию</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">По дате</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@if(count($objects))
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div id="cat_objects" class="objects_list">
                    @foreach($objects as $object)
                        <div class="object">
                            <div class="gallery">
                                @if(count($object->images))
                                    <div class="carousel slide carousel-fade" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($object->images as $image)
                                                <div class="@if($loop->index === 0)active @endif carousel-item">
                                                    <img src="{{ $image->thumb }}" class="d-block w-100" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Предыдущее фото объекта</span>
                                        </button>
                                        <button class="carousel-control-next" type="button">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Следующее фото объекта</span>
                                        </button>
                                    </div>
                                @endif
                                @if($object->is_premium === \Domain\Entities\Object\Enums\IsPremium::Yes->value)
                                    <div class="is_wellican_chose"></div>
                                @endif
                            </div>
                            <div class="description">
                                <div class="head">
                                    <h3>
                                        <a href="{{ route('object.show', ['alias' => $object->alias]) }}">{{ $object->name }}</a>
                                    </h3>
                                    <div class="indicators">
                                        <button class="compare"></button>
                                        <button class="favorite"></button>
                                    </div>
                                </div>
                                <div class="obj_data">
                                    <div class="area">
                                        Площадь: <strong>{{ $object->square }} м<sup>2</sup></strong>
                                    </div>
                                    <div class="location">
                                        {{ $object->location->name }}
                                    </div>
                                </div>
                                <div class="text">{!! $object->description !!}</div>
                                <a class="more" href="{{ route('object.show', ['alias' => $object->alias]) }}">Узнать подробнее об объекте</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $objects->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endif
