@extends('layouts.app', ['headerClass' => 'top_main', 'title' => $page->title, 'description' => $page->description, 'keywords' => $page->keywords])

@section('slogan')

<div id="headerSlider">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('app/images/slider/slide1.jpg') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('app/images/slider/slide2.jpg') }}" class="d-block w-100" alt="...">
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="slogan">
            <p>Найди дом своей мечты с нами</p>
            <span>Наши специалисты помогут вам сделать покупку жилья легко и быстро</span>
            <div class="call_box">
                <a data-bs-toggle="modal" data-bs-target="#amoForm" class="button middle" href="">СВЯЗАТЬСЯ С НАМИ</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="filter_on_main">
                <div class="form_box">
                    <div class="container">
                        @include('includes.forms.search', ['selectedObjectType' => false, 'showAdditionalFilters' => false, 'url' => route('page.show', ['alias' => 'catalog'])])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="section white general_types">
        <div class="container-fluid">
            <div class="row">
                <div class="section_head">
                    <h2>Типы недвижимости, которые мы предлагаем</h2>
                    <span>Наши специалисты помогут вам сделать покупку жилья легко и быстро</span>
                </div>
            </div>
        </div>
        @if(count($objectTypes))
            <div class="container text-center estate_types">
                <div class="row justify-content-between gx-2">
                    <div class="estate_box">
                        <a href="{{ route('catalog.show') }}?is_premium={{ \Domain\Entities\Object\Enums\IsPremium::Yes }}" class="figure">
                            <img src="{{ asset('app/images/estate-types/type1.jpg') }}" alt="" />
                            <strong class="estate_type_title">недвижимость от wellican</strong>
                        </a>
                    </div>
                    @foreach($objectTypes as $objectType)
                        <div class="estate_box">
                            <a href="{{ route('object_type.show', ['alias' => $objectType->alias]) }}" class="figure">
                                @if($objectType->image)
                                    <img src="{{ $objectType->image->url }}" alt="{{ $objectType->image->alt }}" title="{{ $objectType->image->title }}" />
                                @endif
                                <strong class="estate_type_title">{{ $objectType->name }}</strong>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(count($premiumObjects))
            <div class="container-fluid">
                <div class="row">
                    <div class="section_head">
                        <h2>Лучшие предложения от Wellican</h2>
                        <span>Мы подобрали для вас самые выгодные варианты на рынке недвижимости</span>
                    </div>
                </div>
            </div>
            <div class="container best_propose">
                <div class="row">
                    <div class="col">
                        <div class="objects">
                            @foreach($premiumObjects as $premiumObject)
                                <div class="object">
                                    <a href="{{ route('object.show', $premiumObject->alias) }}" class="figure">
                                        @if(isset($premiumObject->images[0]))
                                            <img src="{{ asset($premiumObject->images[0]->url) }}" alt="{{ $premiumObject->images[0]->alt }}" />
                                        @endif
                                        <strong class="desc">
                                            <span>{{ $premiumObject->name }}</span>
                                            <label>{{ $premiumObject->label->name }}</label>
                                        </strong>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="section blue">
        <div class="container-fluid">
            <div class="row">
                <div class="section_head white_text">
                    <h2>25 ваших выгод от сотрудничества именно с нами:</h2>
                </div>
            </div>
        </div>

        <!--    Accordion        -->
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button
                                    class="accordion-button"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne"
                                    aria-expanded="true"
                                    aria-controls="collapseOne"
                                >
                                    C нами вы можете быть уверены в
                                    надежности договоренностей и полной
                                    прозрачности всех сделок.
                                </button>
                            </h2>
                            <div
                                id="collapseOne"
                                class="accordion-collapse collapse show"
                                aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample"
                            >
                                <div class="accordion-body">
                                    <ol>
                                        <li>
                                            Конфиденциальность. Мы не при
                                            каких обстоятельствах не
                                            разглашаем данные наших
                                            клиентов. Наши клиенты уверены в
                                            своей безопасности.
                                        </li>
                                        <li>
                                            Юридическая чистота сделок. Все
                                            сделки купли-продажи мы
                                            заключаем только в присутствии
                                            чешского адвоката или нотариуса.
                                            Наши клиенты уверены в
                                            юридической чистоте сделки и в
                                            сохранности своих денег.
                                        </li>
                                        <li>
                                            Профессиональные переводы
                                            документов. Мы делаем судебные
                                            переводы всех договоров на любой
                                            язык. Наши клиенты точно знают
                                            содержание каждого договора,
                                            который подписывают.
                                        </li>
                                        <li>
                                            Правовая поддержка. По всем
                                            вопросам иммиграции и покупки
                                            недвижимости наших клиентов
                                            консультирует русскоговорящий
                                            адвокат, действительный член
                                            Чешской коллегии адвокатов. Для
                                            наших клиентов не остается
                                            неясностей в чешских законах.
                                        </li>
                                        <li>
                                            Мы играем на стороне клиента.
                                            Если клиентам необходимо сдать
                                            недвижимость в аренду – им не
                                            нужно искать специальное
                                            агентство. Мы находим выгодных
                                            арендаторов и сами следим, чтобы
                                            с квартирой все было в порядке!
                                            Клиенты снимают с себя эти
                                            вопросы.
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo"
                                    aria-expanded="false"
                                    aria-controls="collapseTwo"
                                >
                                    Мы бережем ваше время
                                </button>
                            </h2>
                            <div
                                id="collapseTwo"
                                class="accordion-collapse collapse"
                                aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample"
                            >
                                <div class="accordion-body">
                                    <ol>
                                        <li>
                                            Четкие алгоритмы работы и
                                            бизнес-процессы. Благодаря
                                            грамотно построенной
                                            предварительной работе нашим
                                            клиентам не приходится надолго
                                            отрываться от своих текущих дел.
                                            Для выбора и покупки
                                            недвижимости, включая подписание
                                            всех документов, им требуется не
                                            более 2-3 рабочих дней. Мы ценим
                                            время наших клиентов.
                                        </li>
                                        <li>
                                            Одна из самых больших баз
                                            недвижимости. На нашем сайте
                                            представлена одна из самых
                                            больших баз недвижимости в
                                            Чехии. Клиенты легко находят
                                            объект, наиболее полно
                                            отвечающий их пожеланиям. При
                                            подборе жилья наши специалисты
                                            учитывают все требования клиента
                                            к покупаемой недвижимости. Наши
                                            клиенты всегда в курсе всего
                                            происходящего в Крыму!
                                        </li>
                                        <li>
                                            Недвижимость для всех и в любом
                                            городе Крыма. Мы предлагаем
                                            недвижимость не только в
                                            Симфирополе или Ялте. В нашей
                                            базе есть объекты в любом городе
                                            Крыма и по любой цене. Наши
                                            клиенты не ограничены в выборе
                                            жилья.
                                        </li>
                                        <li>
                                            Высокая компетентность. Все наши
                                            сотрудники являются
                                            профессионалами в своей области.
                                            У нас индивидуальный подход к
                                            каждому клиенту. Наши клиенты
                                            получают четкие ответы на свои
                                            вопросы и быстрое решение своих
                                            задач.
                                        </li>
                                        <li>
                                            Поддержка бизнеса в Крыму. Мы
                                            оказываем услуги по
                                            бухгалтерскому сопровождению
                                            бизнеса клиента и улаживаем
                                            формальности для физических лиц
                                            в Чехии. Ставим фирму клиента,
                                            её директоров и работников на
                                            учёт в налоговом, социальном и
                                            медицинском управлении. У наших
                                            клиентов решены все вопросы с
                                            Чешской налоговой инспекцией или
                                            пенсионным фондом.
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree"
                                    aria-expanded="false"
                                    aria-controls="collapseThree"
                                >
                                    С нами вы получуте бльше финансовых
                                    выгод, чем без нас
                                </button>
                            </h2>
                            <div
                                id="collapseThree"
                                class="accordion-collapse collapse"
                                aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample"
                            >
                                <div class="accordion-body">
                                    <ol>
                                        <li>
                                            Недвижимость по ценам
                                            застройщика. Мы являемся
                                            официальными представителями
                                            нескольких чешских строительных
                                            компаний и поэтому продаем их
                                            недвижимость по ценам
                                            застройщика, без комиссионных.
                                            На сумму комиссионных наши
                                            клиенты покупают новую мебель
                                            для своей квартиры!
                                        </li>
                                        <li>
                                            Беспроцентная рассрочка. При
                                            покупке новостройки, наши
                                            клиенты получают от застройщика
                                            беспроцентную рассрочку платежей
                                            до полугода. Они не платят всю
                                            сумму сразу!
                                        </li>
                                        <li>
                                            Бесплатное оформление
                                            недвижимости. При продаже наших
                                            эксклюзивных объектов, мы
                                            оказываем бесплатно весь
                                            комплекс услуг по оформлению
                                            недвижимости в собственность
                                            покупателя. Наши клиенты
                                            экономят сумму, равную 3% от
                                            цены недвижимости.
                                        </li>
                                        <li>
                                            Сбор пакета документов на ВНЖ
                                            (для одного человека) бесплатно.
                                            Если вы покупаете недвижимость в
                                            нашей фирме, мы готовим пакет
                                            документов для одного члена
                                            вашей семьи БЕСПЛАТНО. Вы
                                            экономите 595 евро. Наши клиенты
                                            получают эту услугу бесплатно
                                            (для одного человека) и экономят
                                            595 евро!
                                        </li>
                                        <li>
                                            Помощь в получении ипотеки под
                                            2,89% годовых. Мы гарантируем
                                            получение ипотечного кредита на
                                            выбранную вами недвижимость по
                                            ставке около 2,89% годовых на
                                            любую сумму! Наши клиенты могут
                                            позволить себе лучшую
                                            недвижимость!
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour"
                                    aria-expanded="false"
                                    aria-controls="collapseFour"
                                >
                                    С нами легко и комфортно работать
                                </button>
                            </h2>
                            <div
                                id="collapseFour"
                                class="accordion-collapse collapse"
                                aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample"
                            >
                                <div class="accordion-body">
                                    <ol>
                                        <li>
                                            Работа с банками. Мы бесплатно
                                            открываем фирменные и личные
                                            счёта в любых банках в Чехии. В
                                            том числе и с обслуживанием на
                                            русском языке. Наши клиенты
                                            знают, как лучше перевести
                                            деньги в Чехию и с каким банком
                                            удобнее работать и не тратят
                                            дополнительных усилий!
                                        </li>
                                        <li>
                                            Легкость контакта. С нами легко
                                            поддерживать связь благодаря
                                            бесплатным телефонам,
                                            интернет-консультанту и
                                            возможности заказать бесплатный
                                            обратный звонок. Наши клиенты не
                                            тратят деньги на международные
                                            разговоры.
                                        </li>
                                        <li>
                                            Комфорт. Мы встречаем и
                                            доставляем наших клиентов на
                                            просмотры только на автомобилях
                                            представительского класса:
                                            Mercedes-Benz S-klasse или Volvo
                                            S80. Наши клиенты не изменяют
                                            привычному для себя комфорту,
                                            оставаясь довольными наши
                                            сервисом.
                                        </li>
                                        <li>
                                            Работа в нескольких часовых
                                            поясах. Мы работаем с гражданами
                                            разных стран. Наши клиенты
                                            получают высококлассное
                                            обслуживание вне зависимости от
                                            часового пояса их страны.
                                        </li>
                                        <li>
                                            Гибкие формы оплаты. Мы
                                            принимаем оплату за наши услуги
                                            любым удобным для клиента
                                            способом. Наши клиенты не думают
                                            о размере чемодана, в котором им
                                            надо везти деньги.
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive"
                                    aria-expanded="false"
                                    aria-controls="collapseFive"
                                >
                                    Мы помогаем вам после покупки жилья
                                </button>
                            </h2>
                            <div
                                id="collapseFive"
                                class="accordion-collapse collapse"
                                aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample"
                            >
                                <div class="accordion-body">
                                    <ol>
                                        <li>
                                            Поддержка в получении ПМЖ и
                                            гражданства. После получения
                                            Вида на жительство в Чехии, для
                                            наших клиентов разработана
                                            специальная программа,
                                            позволяющая без проблем продлить
                                            ВНЖ. В дальнейшем наши клиенты
                                            легко получают ПМЖ и гражданство
                                            Чехии.
                                        </li>
                                        <li>
                                            Скидки на услуги дизайнера. Мы
                                            оказываем помощь клиентам и в
                                            оформлении интерьера их нового
                                            жилья. Для наших клиентов скидка
                                            на услуги профессионального
                                            дизайнера – 50%.
                                        </li>
                                        <li>
                                            Поддержка в обустройстве на
                                            новом месте жительства. Мы
                                            оказываем помощь и в выборе
                                            мебели и доставке ее в вашу
                                            новую квартиру. После покупки
                                            недвижимости, наши клиенты не
                                            остаются один на один с
                                            вопросами обстановки своего
                                            нового жилья.
                                        </li>
                                        <li>
                                            Помощь в строительстве и
                                            ремонте. При покупке вами дома в
                                            стадии строительства или участка
                                            земли под застройку, мы помогаем
                                            клиентам выбрать строительную
                                            компанию с лучшими
                                            рекомендациями. А затем -
                                            контролируем процесс
                                            строительства или ремонта. Наши
                                            клиенты остаются довольны
                                            качеством выполненных работ.
                                        </li>
                                        <li>
                                            Помощь на этапе социализации. Мы
                                            консультируем наших клиентов по
                                            всем аспектам жизни в Чехии. А
                                            также помогаем зарегистрировать
                                            автомобиль, выбрать врача,
                                            устроить ребенка в бесплатную
                                            школу или детский сад т.д. Наши
                                            клиенты не чувствуют себя чужими
                                            в Чехии.
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container services">
            <div class="row">
                <div class="col-6">
                    <img src="{{ asset('app/images/services.png') }}" alt="" />
                </div>

                <div class="col-6">
                    <div class="box_right">
                        <div class="head">
                            Услуги, которые мы предоставляем
                        </div>
                        <strong class="label"
                        >Наши специалисты помогут вам сделать покупку
                            жилья легко и быстро</strong
                        >
                        <ul class="list">
                            <li class="list_item">
                                <a href="#"
                                >Купля/продажа/аренда недвижимости</a
                                >
                            </li>
                            <li class="list_item">
                                <a href="#">Консалтинг</a>
                            </li>
                            <li class="list_item">
                                <a href="#"
                                >Формирование инвестиционного
                                    портфеля</a
                                >
                            </li>
                            <li class="list_item">
                                <a href="#"> Кадастровые услуги</a>
                            </li>
                            <li class="list_item">
                                <a href="#">Юридическое сопровождение</a>
                            </li>

                            <li class="list_item">
                                <a href="#"> Ремонт</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section white">
        <div class="container-fluid">
            <div class="row">
                <div class="section_head">
                    <h2>Предложения по ипотеке</h2>
                    <span>Мы подобрали для вас самые выгодные варианты на рынке недвижимости</span>
                </div>
            </div>
        </div>
        <div class="container banks">
            <div class="row">
                <div class="col">
                    <div class="bank">
                        <div class="logo">
                            <img src="{{ asset('app/images/banks/rnkb.svg') }}" />
                        </div>
                        <div class="desc">
                            <span class="name">РНКБ Банк</span>
                            <span class="from">от 28 029₽ / мес.</span>
                            <span class="standart">Субсидирование по Стандартной ипотеке</span>
                        </div>

                        <div class="bid">от 0,01%</div>
                        <div class="from_years">до 30 лет</div>
                        <div class="bt_box">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#amoForm" class="button middle">
                                Оставить заявку
                            </a>
                        </div>
                    </div>
                    <div class="bank">
                        <div class="logo">
                            <img src="{{ asset('app/images/banks/genbank.svg') }}" />
                        </div>
                        <div class="desc">
                            <span class="name">Генбанк </span>
                            <span class="from">от 28 029₽ / мес.</span>
                            <span class="standart">Субсидирование по Стандартной ипотеке</span>
                        </div>

                        <div class="bid">от 0,01%</div>
                        <div class="from_years">до 30 лет</div>
                        <div class="bt_box">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#amoForm" class="button middle">
                                Оставить заявку
                            </a>
                        </div>
                    </div>

                    <div class="bank">
                        <div class="logo">
                            <img src="{{ asset('app/images/banks/russia.svg') }}" />
                        </div>
                        <div class="desc">
                            <span class="name">Банк России </span>
                            <span class="from">от 28 029₽ / мес.</span>
                            <span class="standart"
                            >Субсидирование по Стандартной ипотеке</span
                            >
                        </div>

                        <div class="bid">от 0,01%</div>
                        <div class="from_years">до 30 лет</div>
                        <div class="bt_box">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#amoForm" class="button middle">
                                Оставить заявку
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   end ipoteka     -->

<!--        carousel    -->
    <div id="reviews" class="section blue">
        <div class="container-fluid">
            <div class="row">
                <div class="section_head white_text">
                    <h2>отзывы клиентов</h2>
                </div>
            </div>
        </div>

        <div class="container text-center my-3">
            <div class="row mx-auto my-auto justify-content-center">
                <div
                    id="recipeCarousel"
                    class="carousel slide"
                    data-bs-ride="carousel"
                >
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="review_box">
                                        <div class="user">
                                            <img
                                                src="{{ asset('app/images/reviews/user1.png') }}"
                                                alt=""
                                            />
                                            <div class="user_desc">
                                                    <span class="name"
                                                    >Андрей Астафьев</span
                                                    >
                                                <img
                                                    src="{{ asset('app/images/reviews/starts.svg') }}"
                                                    alt=""
                                                />
                                            </div>
                                        </div>
                                        <div class="desc">
                                            Спасибо Александру с помощью в
                                            поиске дома мечты. Приехали с
                                            Волгограда, не знали местных
                                            застройщиков. Александр быстро
                                            помог найти нас интересующий
                                            дом. Сделка прошла быстро и без
                                            проблем
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="review_box">
                                        <div class="user">
                                            <img
                                                src="{{ asset('app/images/reviews/user2.png') }}"
                                                alt=""
                                            />
                                            <div class="user_desc">
                                                    <span class="name"
                                                    >Артём Жидалёв</span
                                                    >
                                                <img
                                                    src="{{ asset('app/images/reviews/starts.svg') }}"
                                                    alt=""
                                                />
                                            </div>
                                        </div>
                                        <div class="desc">
                                            Спасибо Александру с помощью в
                                            поиске дома мечты. Приехали с
                                            Волгограда, не знали местных
                                            застройщиков. Александр быстро
                                            помог найти нас интересующий
                                            дом. Сделка прошла быстро и без
                                            проблем
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="review_box">
                                        <div class="user">
                                            <img
                                                src="{{ asset('app/images/reviews/user3.png') }}"
                                                alt=""
                                            />
                                            <div class="user_desc">
                                                    <span class="name"
                                                    >Анна Смирнова</span
                                                    >
                                                <img
                                                    src="{{ asset('app/images/reviews/starts.svg') }}"
                                                    alt=""
                                                />
                                            </div>
                                        </div>
                                        <div class="desc">
                                            Спасибо Александру с помощью в
                                            поиске дома мечты. Приехали с
                                            Волгограда, не знали местных
                                            застройщиков. Александр быстро
                                            помог найти нас интересующий
                                            дом. Сделка прошла быстро и без
                                            проблем
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a
                        class="carousel-control-prev bg-transparent w-aut"
                        href="#recipeCarousel"
                        role="button"
                        data-bs-slide="prev"
                        data-bs-target="#recipeCarousel"
                    >
                            <span
                                class="carousel-control-prev-icon"
                                aria-hidden="true"
                            ></span>
                    </a>
                    <a
                        class="carousel-control-next bg-transparent w-aut"
                        href="#recipeCarousel"
                        role="button"
                        data-bs-slide="next"
                        data-bs-target="#recipeCarousel"
                    >
                            <span
                                class="carousel-control-next-icon"
                                aria-hidden="true"
                            ></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="section gray">
        <div class="container-fluid">
            <div class="row">
                <div class="section_head">
                    <h2>Наши партнёры</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="partners_box">
                    <img
                        src="{{ asset('app/images/partners/partner1.png') }}"
                        alt=""
                    />
                    <img
                        src="{{ asset('app/images/partners/partner2.png') }}"
                        alt=""
                    />
                    <img
                        src="{{ asset('app/images/partners/partner3.png') }}"
                        alt=""
                    />
                    <img
                        src="{{ asset('app/images/partners/partner4.png') }}"
                        alt=""
                    />
                    <img
                        src="{{ asset('app/images/partners/partner5.png') }}"
                        alt=""
                    />
                </div>
            </div>
        </div>
    </div>

    <div class="section map p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col p-0">
                    <div class="consultation">
                        <div class="box">
                            <div class="left">
                                <strong class="consultation__had">Ищите дом своей мечты?</strong>
                                <span class="consultation__label">Мы поможем реализовать мечту</span>
                            </div>
                            <div class="right">
                                <a href="#" class="button white">записаться на консультацию</a>
                            </div>
                        </div>
                    </div>
                    <iframe src="https://yandex.ru/map-widget/v1/?ll=37.62,55.75&z=12&um=constructor%3A6df29adfc412c4fc0e3031b9e31cf22aed5cfd97810f5eb4241f36604b43f7bf&amp;source=constructor" width="500" height="400" ></iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="amoForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close_box">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-header">
                    <div class="modal-title" id="exampleModalLabel">Запись на консультацию</div>
                </div>
                <div class="modal-body">
                    <script>!function(a,m,o,c,r,m){a[o+c]=a[o+c]||{setMeta:function(p){this.params=(this.params||[]).concat([p])}},a[o+r]=a[o+r]||function(f){a[o+r].f=(a[o+r].f||[]).concat([f])},a[o+r]({id:"1276170",hash:"7da7f219422578fc1ba4fae62f117a24",locale:"ru"}),a[o+m]=a[o+m]||function(f,k){a[o+m].f=(a[o+m].f||[]).concat([[f,k]])}}(window,0,"amo_forms_","params","load","loaded");</script><script id="amoforms_script_1276170" async="async" charset="utf-8" src="https://forms.amocrm.ru/forms/assets/js/amoforms.js?1706205136"></script>
                </div>
            </div>
        </div>
    </div>
@endsection
