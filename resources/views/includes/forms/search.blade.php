<form  action="{{ $url ?? '' }}" method="get">
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
    <div class="row justify-content-center pt-4">
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
                    <option
                        data-alias="{{$objectType->alias}}"
                        value="{{ $objectType->id }}"
                        @if(request('type_id') == $objectType->id || ($selectedObjectType && $selectedObjectType->id === $objectType->id))selected @endif
                        @if($selectedObjectType)disabled @endif
                    >
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

    </div>

    <div class="row justify-content-center pt-3">
            <div class="col-md-3">
                <label>Стоимость, ₽</label>
                <div class="input-group mb-2">
                    <input type="number"  min="1" name="price_from" class="form-control" placeholder="От" value="{{ request('price_from') }}">
                    <input type="number" min="1" name="price_to" class="form-control" placeholder="До" value="{{ request('price_to') }}">
                </div>
            </div>
            <div class="col-md-3">
                <label>Площадь, м<sup>2</sup></label>
                <div class="input-group mb-2">
                    <input type="number" min="1" name="square_from" class="form-control" placeholder="От" value="{{ request('square_from') }}">
                    <input  type="number" min="1" name="square_to" class="form-control" placeholder="До" value="{{ request('square_to') }}">
                </div>
            </div>
            <div class="col-md-3 d-flex justify-content-between form_buttons">
                <button type="submit" class="btn">Найти</button>
                <button id="reset_button" class="btn">Сбросить</button>
            </div>
    </div>

    @if($showAdditionalFilters)
        <div id="additional_filters_button_box" class="row pt-3">
            <div class="col-md-12">
                <button id="additional_filters_button">Показать расширенный поиск</button>
            </div>
        </div>

        <div class="additional_filters">
            @foreach($objectTypes as $objectType)
                <div class="box" id="{{ $objectType->alias }}">
                    <div class="row">
                        @if($objectType->filters)
                            @foreach($objectType->filters as $filter)
                                @includeWhen(count($filter->options), sprintf('includes.forms.options.%s', $filter->tpl), ['filter' => $filter])
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</form>


