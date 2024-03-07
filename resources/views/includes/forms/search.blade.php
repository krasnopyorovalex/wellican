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

    <div class="row pt-3">
        <div class="col-md-12">
            <button id="additional_filters_button">Показать рассширенный поиск</button>
        </div>
    </div>


    <div class="additional_filters">
        <div class="box" id="flats_filters">
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
                        <input type="number" class="form-control" placeholder="От">
                        <input type="number" class="form-control" placeholder="До">
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
                        <input type="number" class="form-control" placeholder="От">
                        <input type="number" class="form-control" placeholder="До">
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-3">
                    <label>Этаж</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" placeholder="От">
                        <input type="number" class="form-control" placeholder="До">
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Этажей в доме</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" placeholder="От">
                        <input type="number" class="form-control" placeholder="До">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Высота потолков</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" placeholder="От">
                        <input type="number" class="form-control" placeholder="До">
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
        <!--   КВАРТИРЫ     -->



<!--   ДОМА, КОТЕДЖИ, ТАУНХАУСЫ     -->
        <div class="box" id="cottagesHouses_filters">

            <div class="row">
                <div class="col-md-2 testMy">
                    <label>Вид объекта</label>
                    <div class="multi_selected_box">
                        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Дом">
                                    Дом
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Дачи">
                                    Дачи
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Котеджи">
                                    Котеджи
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Таунхаусы">
                                    Таунхаусы
                                </label>
                            </div>
                        </div>
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
                <div class="col-md-3">
                    <label>Стоимость, ₽</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" placeholder="От">
                        <input type="number" class="form-control" placeholder="До">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Общая площадь м<sup>2</sup></label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" placeholder="От">
                        <input type="number" class="form-control" placeholder="До">
                    </div>
                </div>
                <div class="col-md-1">
                    <label>Комнат</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" placeholder="Кол-во">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Категория земли</label>
                    <div class="multi_selected_box">
                        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="ИЖС">
                                    ИЖС
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="СНТ">
                                    СНТ
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="ДНП">
                                    ДНП
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-2">
                    <label>Коммуникации</label>
                    <div class="multi_selected_box">
                        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Электричество">
                                    Электричество
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Газ">
                                    Газ
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Канализация">
                                    Канализация
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Этажей в доме</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" placeholder="Этажей">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Материал стен</label>
                    <div class="multi_selected_box">
                        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type1">
                                    Ракушечник
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type2">
                                    Брус
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type3">
                                    Газоблок
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type4">
                                    Бревно
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type5">
                                    Сендвич панель
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type6">
                                    Экспепремпентальные материалы
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Ремонт</label>
                    <div class="multi_selected_box">
                        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type1">
                                    Предчистовая отделка
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type2">
                                    Без отделки
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type3">
                                    Косметический
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type4">
                                    Евро
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type5">
                                    Дизайнерский
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type6">
                                    Ремонт с мебелью
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type7">
                                    Бытовая техника
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Комплектация</label>
                    <div class="multi_selected_box">
                        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type1">
                                    Баня
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type2">
                                    Сауна
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type3">
                                    Хамам
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type4">
                                    Спортзал
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type5">
                                    Бассейн
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type6">
                                    Беседки
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type7">
                                    Зона барбекю
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type8">
                                    Газоны
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Транспортная развязка</label>
                    <div class="multi_selected_box">
                        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type1">
                                    Асфальтированная дорога
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type2">
                                    Остановка общ. трансторта
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type3">
                                    Магазины
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type4">
                                    Аптеки
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type5">
                                    Школа
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type6">
                                    Десткий сад
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--   ДОМА, КОТЕДЖИ, ТАУНХАУСЫ     -->

        <!--   Участки     -->
        <div class="box" id="land_filters">
            <div class="row">
                <div class="col-md-3">
                    <label>Стоимость, ₽</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" placeholder="От">
                        <input type="number" class="form-control" placeholder="До">
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Площадь участка, сот.</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" placeholder="От">
                        <input type="number" class="form-control" placeholder="До">
                    </div>
                </div>
                <div class="col-md-3">
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
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type5">
                                    Обмен
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Категория земли</label>
                    <div class="multi_selected_box">
                        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type1">
                                    ИЖС
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type2">
                                    СНТ
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type3">
                                    ДНП
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type4">
                                    Пром нразначение
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type5">
                                    Комерция
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--   Участки     -->

        <!--   КОМЕРЧЕСКАЯ НЕДВИЖИМОСТЬ     -->
        <div class="box" id="commercial_filters">
            <div class="row">
                <div class="col-md-3">
                    <label>Вид объекта</label>
                    <div class="multi_selected_box">
                        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type1">
                                    Офис
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type2">
                                    Торговая площадь
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type3">
                                    Склады
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type4">
                                    Гостиницы
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type5">
                                    Общепит
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type6">
                                    Автосервис-мойки
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type7">
                                    Здания целиком
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Стоимость, ₽</label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" placeholder="От">
                        <input type="number" class="form-control" placeholder="До">
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Площадь, м<sup>2</sup></label>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control" placeholder="От">
                        <input type="number" class="form-control" placeholder="До">
                    </div>
                </div>
                <div class="col-md-3">
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
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="type5">
                                    Обмен
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--   КОМЕРЧЕСКАЯ НЕДВИЖИМОСТЬ     -->
    </div>
</form>


