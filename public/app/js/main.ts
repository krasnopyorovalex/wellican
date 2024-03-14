let isChooseEstateType: boolean = null;

// Разукрашиваем элемент в заголовке типов недвижимсоти
function initFillColorForTypeTitle(): void {
    const estateTypeTitleList: NodeList =
        document.querySelectorAll(".estate_type_title");

    if (estateTypeTitleList.length) {
        const firstEl = estateTypeTitleList[0] as HTMLElement;

        let slitText: string[] = firstEl.innerText.trim().split(" ");

        const lastWord = slitText[slitText.length - 1];

        const res = slitText.slice(0, -1);

        firstEl.innerHTML =
            res.join(" ") +
            (slitText.length > 0
                ? " <i class='highlight'>" + lastWord + "</i>"
                : lastWord);
    }
}

function initReviewsCarousel() {
    let items = document.querySelectorAll(".carousel .carousel-item");
    const reviews_container = document.getElementById("reviews");

    if (items.length && reviews_container) {
        items.forEach((el) => {
            const minPerSlide = 3;
            let next: Element = el.nextElementSibling;
            for (let i = 1; i < minPerSlide; i++) {
                if (!next) {
                    // wrap carousel by using first child
                    next = items[0];
                }
                let cloneChild = next.cloneNode(true) as HTMLDivElement;
                el.appendChild(cloneChild.children[0]);
                next = next.nextElementSibling;
            }
        });
    }
}

function initGallForList(): void {
    const cat_objects_container: HTMLElement =
        document.getElementById("cat_objects");

    if (cat_objects_container) {
        const windowRef = window as any;

        const bootstrap = windowRef.bootstrap;

        const objects_list: NodeList = document.querySelectorAll(".object");

        objects_list.forEach((item, index) => {
            const it = item as HTMLElement;
            const carouselEl = it.firstElementChild.firstElementChild;
            carouselEl.id = "carouselExampleFade" + index;

            const carouselItemDivEl = carouselEl.firstElementChild;

            const carouselElPrevBt = carouselEl.getElementsByClassName(
                "carousel-control-prev",
            )[0] as Node;

            const carouselElNextBt = carouselEl.getElementsByClassName(
                "carousel-control-next",
            )[0] as Node;

            const myCarousel = document.querySelector(
                "#carouselExampleFade" + index,
            );

            const carousel = new bootstrap.Carousel(myCarousel, {
                window: false,
                ride: false,
            }) as any;

            carouselElPrevBt.addEventListener("click", () => {
                carousel.prev();
            });
            carouselElNextBt.addEventListener("click", () => {
                carousel.next();
            });
            carouselItemDivEl.addEventListener("click", () => {
                carousel.next();
            });
        });
    }
}

function addFavorite(): void {
    console.log("addFavorite");
}

function initObjectViewScripts() {
    const object_view_container: HTMLElement =
        document.getElementById("object_view");
    if (object_view_container) {
        const initObjectGallCarousel = () => {
            const windowRef = window as any;

            const bootstrap = windowRef.bootstrap;

            const myCarousel = document.querySelector("#carouselObjectView");

            if (myCarousel?.children?.length) {
                const carIndicators = myCarousel.children[0];
                const carInner = myCarousel.children[1];

                carInner.children[0].classList.add("active");
                carIndicators.children[0].classList.add("active");
            }

            new bootstrap.Carousel(myCarousel, {
                window: false,
                ride: false,
            });
        };

        initObjectGallCarousel();

        // @ts-ignore
        async function initMap() {
            const windowRef = window as any;
            const ymaps = windowRef.ymaps;
            await ymaps.ready();

            const mapSelector: HTMLElement = document.querySelector("#map");

            const { latitude, longitude } = mapSelector.dataset;

            const current_obj_coords = [latitude, longitude];

            const myMap = new ymaps.Map("map", {
                // Координаты центра карты.
                // Порядок по умолчанию: «широта, долгота».
                // Чтобы не определять координаты центра карты вручную,
                // воспользуйтесь инструментом Определение координат.
                center: current_obj_coords,
                // Уровень масштабирования. Допустимые значения:
                // от 0 (весь мир) до 19.
                zoom: 10,
            });

            myMap.geoObjects.add(new ymaps.Placemark(current_obj_coords));
        }

        initMap();
    }
}

function addListenerToAdditionalFilters() {
    const additional_filters_button = document.querySelector(
        "#additional_filters_button",
    );

    additional_filters_button.addEventListener("click", toggleButton, false);

    function toggleButton(event) {
        event.preventDefault();
        if (!isChooseEstateType) {
            alert("Уточните тип недвижимости");
            return;
        }
        const additional_filters: HTMLElement = document.querySelector(
            ".additional_filters",
        );
        additional_filters_button.innerHTML = !additional_filters.hidden ? 'Показать рассширенный поиск' : 'Скрыть рассширенный поиск';
        additional_filters.hidden = !additional_filters.hidden;
    }
}

function initFiltersBox() {
    const filters_box: HTMLElement = document.querySelector(".filters_box");
    const additional_filters: HTMLElement = document.querySelector(
        ".additional_filters",
    );
    if (additional_filters) {
        additional_filters.hidden = true;
    }

    if (filters_box) {
        const selectElement: HTMLFormElement = document.querySelector(
            "#input_property_type",
        );

        const flats_filters: HTMLElement =
            filters_box.querySelector("#flats_filters");
        const cottagesHouses_filters: HTMLElement = filters_box.querySelector(
            "#cottagesHouses_filters",
        );
        const land_filters: HTMLElement =
            filters_box.querySelector("#land_filters");
        const commercial_filters: HTMLElement = filters_box.querySelector(
            "#commercial_filters",
        );

        const resetBoxes = () => {
            const box_list: NodeList = filters_box.querySelectorAll(".box");
            box_list.forEach((it: HTMLElement) => {
                it.hidden = true;
            });
        };

        resetBoxes();

        const propertyTypeValue = Number(selectElement.value);

        if (isNaN(propertyTypeValue)) {
            isChooseEstateType = null;
        } else {
            isChooseEstateType = !!propertyTypeValue;
            switchFilters(selectElement.value);
        }

        selectElement.addEventListener("change", (event) => {
            const elTarget = event.target as HTMLFormElement;

            isChooseEstateType = !!elTarget;

            resetBoxes();

            switchFilters(elTarget.value);
        });

        function switchFilters(type: string) {
            switch (type) {
                case "1":
                    flats_filters.hidden = false;
                    break;
                case "4":
                    cottagesHouses_filters.hidden = false;
                    break;
                case "5":
                    land_filters.hidden = false;
                    break;
                case "6":
                    commercial_filters.hidden = false;
                    break;
                default:
                    resetBoxes();
            }
        }

        initMultiSelectedScript();
    }
}

function initMultiSelectedScript() {
    const multi_selected_box_list = document.querySelectorAll(
        ".multi_selected_box",
    );
    if (multi_selected_box_list.length) {
        multi_selected_box_list.forEach((multi_selected_box) => {
            const allCheckboxesLabels =
                multi_selected_box.querySelectorAll(".form-check-label");
            const selected_area =
                multi_selected_box.querySelector(".selected_area");

            let checksValues: string[] = [];

            allCheckboxesLabels.forEach((label: HTMLElement) => {
                const inputCheckbox = label.firstElementChild;
                inputCheckbox.addEventListener("change", (ev) => {
                    const elTarget = ev.target as HTMLFormElement;

                    const isExistEl =
                        checksValues.indexOf(elTarget.value) === -1;

                    if (!isExistEl) {
                        checksValues = checksValues.filter((item) => {
                            return item !== elTarget.value;
                        });
                    } else {
                        checksValues.push(elTarget.value);
                    }

                    if (checksValues.length) {
                        selected_area.innerHTML = `Выбрано: ${checksValues.length}`;
                    } else {
                        selected_area.innerHTML = `Выбрать`;
                    }
                });
            });
        });
    }
}

function initSlideshowsOnMain() {
    const windowRef = window as any;

    const bootstrap = windowRef.bootstrap;

    const myCarousel = document.querySelector('#headerSlider')
    new bootstrap.Carousel(myCarousel, {
        interval: 10000,
        ride: "carousel",
    });
}

(() => {
    initSlideshowsOnMain();
    initReviewsCarousel();
    initFillColorForTypeTitle();
    initGallForList();
    initObjectViewScripts();
    initFiltersBox();
    addListenerToAdditionalFilters();
})();
