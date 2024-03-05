<form class="row g-3 gx-4" action="{{ request()->getUri() }}" method="get">
    <input type="hidden" name="sort" value="created_at" />
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
                <option value="{{ $objectType->id }}" @if(request('type_id') == $objectType->id || ($selectedObjectType && $selectedObjectType->id === $objectType->id))selected @endif>
                    {{ $objectType->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select id="input_purchase_type" class="form-select" name="type_purchase">
            <option disabled selected>Тип приобретения</option>
            @foreach(\Domain\Entities\Object\Enums\TypePurchase::cases() as $typePurchase)
                <option value="{{ $typePurchase }}" @if(request('type_purchase') == $typePurchase->value)selected @endif>
                    {{ __(sprintf('entities.%s', $typePurchase->value)) }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 text-lg-start">
        <button type="submit" class="btn">Найти</button>
        <button class="btn">Сбросить</button>
    </div>


    <button id="additional_filters_button">Расширеный поиск</button>

    <div class="additional_filters">
        <div class="box" id="flats_filters">
            <h1>Квартиры</h1>
            <div class="row">
                <div class="col-md-3">
                    <select id="input_flat_type" class="form-select" name="flat_type">
                        <option disabled selected>Все</option>
                        <option value="Вторичка">Вторичка</option>
                        <option value="Новостройки">Новостройки</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="box" id="cottagesHouses_filters">
            <h1>
                ДОМА, КОТЕДЖИ, ТАУНХАУСЫ
            </h1>
        </div>
        <div class="box" id="land_filters">
            <h1>
                Участки
            </h1>
        </div>
        <div class="box" id="commercial_filters">
            <h1>

                КОМЕРЧЕСКАЯ НЕДВИЖИМОСТЬ

            </h1>
        </div>
    </div>
</form>


