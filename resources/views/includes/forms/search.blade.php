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
    </div>
</form>
