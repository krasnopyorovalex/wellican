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
                <div class="col-md-2">
                    <label for="">Тип квартир</label>
                    <select id="input_flat_type" class="form-select" name="flat_type">
                        <option disabled selected>Все</option>
                        <option value="Вторичка">Вторичка</option>
                        <option value="Новостройки">Новостройки</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Комнатность</label>
                    <div class="flats_types_box">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="Студия" >
                                Студия
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="1">
                                1
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="2" >
                                2
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="3" >
                                3
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="4" >
                                4+
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Стоимость, ₽</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" placeholder="От">
                        <input type="text" class="form-control" placeholder="До">
                    </div>
                </div>

                <div class="col-md-2">
                    <label>Тип приобритения</label>
                    <div class="multi_selected_box">
                        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="В ипотеку">
                                    В ипотеку
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="За наличный расчет">
                                    За наличный расчет
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Расрочка">
                                    Расрочка
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Безналичный расчет">
                                    Безналичный расчет
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <label>Площадь, м<sup>2</sup></label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" placeholder="От">
                        <input type="text" class="form-control" placeholder="До">
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-3">
                    <label>Этаж</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" placeholder="От">
                        <input type="text" class="form-control" placeholder="До">
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Этажей в доме</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" placeholder="От">
                        <input type="text" class="form-control" placeholder="До">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Высота потолков</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" placeholder="От">
                        <input type="text" class="form-control" placeholder="До">
                    </div>
                </div>
                <div class="col-md-2 testMy">
                    <label>Балкон</label>
                    <div class="multi_selected_box">
                        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Балкон">
                                    Балкон
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Лоджия">
                                    Лоджия
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 testMy">
                    <label>Отделка</label>
                    <div class="multi_selected_box">
                        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="С ремонтом">
                                    С ремонтом
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Лоджия">
                                    Без ремонта
                                </label>
                            </div>
                        </div>
                    </div>
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


