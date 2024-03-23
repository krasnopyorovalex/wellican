<form class="row g-3 gx-4" action="{{ $url ?? '' }}" method="get">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <input type="hidden" name="sort" value="created_at"/>
    <div class="col-md-3">
        <select id="input_city" class="form-select" name="location_id">
            <option disabled selected>Населенный пункт</option>
            @foreach($locations as $location)
                <option value="{{ $location->id }}" @if(request('location_id') == $location->id)selected @endif>
                    {{ $location->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select id="input_property_type" class="form-select" name="type_id">
            <option disabled selected>
                Тип недвижимости
            </option>
            @foreach($objectTypes as $objectType)
                <option data-alias="{{$objectType->alias}}" value="{{ $objectType->id }}"
                        @if(request('type_id') == $objectType->id || ($selectedObjectType && $selectedObjectType->id === $objectType->id))selected @endif>
                    {{ $objectType->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select id="input_purchase_type" class="form-select" name="type_purchase">
            <option disabled selected>Тип приобретения</option>
            @foreach(\Domain\Entities\Object\Enums\TypePurchase::cases() as $typePurchase)
                <option value="{{ $typePurchase }}"
                        @if(request('type_purchase') == $typePurchase->value)selected @endif>
                    {{ __(sprintf('entities.%s', $typePurchase->value)) }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 text-lg-start">
        <button type="submit" class="btn">Найти</button>
        <button class="btn">Сбросить</button>
    </div>

    <div class="row pt-3">
        <div class="col-md-12">
            <button id="additional_filters_button">Показать расширенный поиск</button>
        </div>
    </div>

    <div class="additional_filters">
        {{--        <div class="box">--}}
        {{--            <div class="row">--}}
        {{--                <div class="col-md-3">--}}
        {{--                    <label>Стоимость, ₽</label>--}}
        {{--                    <div class="input-group mb-2">--}}
        {{--                        <input type="number" name="price_from" class="form-control" placeholder="От" value="{{ request('price_from') }}">--}}
        {{--                        <input type="number" name="price_to" class="form-control" placeholder="До" value="{{ request('price_to') }}">--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="col-md-2">--}}
        {{--                    <label>Площадь, м<sup>2</sup></label>--}}
        {{--                    <div class="input-group mb-2">--}}
        {{--                        <input type="number" name="square_from" class="form-control" placeholder="От" value="{{ request('square_from') }}">--}}
        {{--                        <input type="number" name="square_to" class="form-control" placeholder="До" value="{{ request('square_to') }}">--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        @foreach($objectTypes as $objectType)
            <div class="box" id="{{ $objectType->alias }}">
                <div class="row">

                    @if($loop->index === 0)
                        <div class="col-md-3">
                            <label>Стоимость, ₽</label>
                            <div class="input-group mb-2">
                                <input type="number" name="price_from" class="form-control" placeholder="От"
                                       value="{{ request('price_from') }}">
                                <input type="number" name="price_to" class="form-control" placeholder="До"
                                       value="{{ request('price_to') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>Площадь, м<sup>2</sup></label>
                            <div class="input-group mb-2">
                                <input type="number" name="square_from" class="form-control" placeholder="От"
                                       value="{{ request('square_from') }}">
                                <input type="number" name="square_to" class="form-control" placeholder="До"
                                       value="{{ request('square_to') }}">
                            </div>
                        </div>
                    @endif

                    @if($objectType->filters)
                        @foreach($objectType->filters as $filter)
                            @includeWhen(count($filter->options), sprintf('includes.forms.options.%s', $filter->tpl), ['filter' => $filter])
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</form>


