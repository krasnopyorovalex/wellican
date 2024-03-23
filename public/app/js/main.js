var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
let isChooseEstateType = null;
// Разукрашиваем элемент в заголовке типов недвижимсоти
function initFillColorForTypeTitle() {
    const estateTypeTitleList = document.querySelectorAll(".estate_type_title");
    if (estateTypeTitleList.length) {
        const firstEl = estateTypeTitleList[0];
        let slitText = firstEl.innerText.trim().split(" ");
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
            let next = el.nextElementSibling;
            for (let i = 1; i < minPerSlide; i++) {
                if (!next) {
                    // wrap carousel by using first child
                    next = items[0];
                }
                let cloneChild = next.cloneNode(true);
                el.appendChild(cloneChild.children[0]);
                next = next.nextElementSibling;
            }
        });
    }
}
function initGallForList() {
    const cat_objects_container = document.getElementById("cat_objects");
    if (cat_objects_container) {
        const windowRef = window;
        const bootstrap = windowRef.bootstrap;
        const objects_list = document.querySelectorAll(".object");
        if (objects_list.length) {
            objects_list.forEach((item, index) => {
                const it = item;
                const carouselEl = it.firstElementChild.firstElementChild;
                if (carouselEl) {
                    carouselEl.id = "carouselExampleFade" + index;
                    const carouselItemDivEl = carouselEl.firstElementChild;
                    const carouselElPrevBt = carouselEl.getElementsByClassName("carousel-control-prev")[0];
                    const carouselElNextBt = carouselEl.getElementsByClassName("carousel-control-next")[0];
                    const myCarousel = document.querySelector("#carouselExampleFade" + index);
                    const carousel = new bootstrap.Carousel(myCarousel, {
                        window: false,
                        ride: false,
                    });
                    carouselElPrevBt.addEventListener("click", () => {
                        carousel.prev();
                    });
                    carouselElNextBt.addEventListener("click", () => {
                        carousel.next();
                    });
                    carouselItemDivEl.addEventListener("click", () => {
                        carousel.next();
                    });
                }
            });
        }
    }
}
function addFavorite() {
    console.log("addFavorite");
}
function initObjectViewScripts() {
    const object_view_container = document.getElementById("object_view");
    if (object_view_container) {
        const initObjectGallCarousel = () => {
            var _a;
            const windowRef = window;
            const bootstrap = windowRef.bootstrap;
            const myCarousel = document.querySelector("#carouselObjectView");
            if (myCarousel) {
                if ((_a = myCarousel === null || myCarousel === void 0 ? void 0 : myCarousel.children) === null || _a === void 0 ? void 0 : _a.length) {
                    const carIndicators = myCarousel.children[0];
                    const carInner = myCarousel.children[1];
                    carInner.children[0].classList.add("active");
                    carIndicators.children[0].classList.add("active");
                }
                new bootstrap.Carousel(myCarousel, {
                    window: false,
                    ride: false,
                });
            }
        };
        initObjectGallCarousel();
        // @ts-ignore
        function initMap() {
            return __awaiter(this, void 0, void 0, function* () {
                const windowRef = window;
                const ymaps = windowRef.ymaps;
                yield ymaps.ready();
                const mapSelector = document.querySelector("#map");
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
            });
        }
        initMap();
    }
}
function addListenerToAdditionalFilters() {
    const additional_filters_button = document.querySelector("#additional_filters_button");
    if (additional_filters_button) {
        additional_filters_button.addEventListener("click", toggleButton, false);
    }
    function toggleButton(event) {
        event.preventDefault();
        if (!isChooseEstateType) {
            alert("Уточните тип недвижимости");
            return;
        }
        const additional_filters = document.querySelector(".additional_filters");
        additional_filters_button.innerHTML = !additional_filters.hidden
            ? "Показать рассширенный поиск"
            : "Скрыть рассширенный поиск";
        additional_filters.hidden = !additional_filters.hidden;
    }
}
function initFiltersBox() {
    const filters_box = document.querySelector(".filters_box");
    const additional_filters = document.querySelector(".additional_filters");
    if (additional_filters) {
        additional_filters.hidden = true;
    }
    if (filters_box) {
        const selectElement = document.querySelector("#input_property_type");
        const changeVisibleFilterBox = (alias) => {
            resetBoxes();
            const optionsList = [...selectElement.children].filter((it, index) => index);
            optionsList.forEach((option) => {
                var _a, _b;
                if (alias === ((_a = option.dataset) === null || _a === void 0 ? void 0 : _a.alias)) {
                    const filterBoxEl = filters_box.querySelector(`#${(_b = option.dataset) === null || _b === void 0 ? void 0 : _b.alias}`);
                    filterBoxEl.hidden = false;
                }
            });
        };
        const resetBoxes = () => {
            const box_list = filters_box.querySelectorAll(".box");
            box_list.forEach((it) => {
                it.hidden = true;
            });
        };
        resetBoxes();
        const propertyTypeValue = Number(selectElement.value);
        if (isNaN(propertyTypeValue)) {
            isChooseEstateType = null;
        }
        else {
            isChooseEstateType = !!propertyTypeValue;
            //  switchFilters(selectElement.value);
        }
        selectElement.addEventListener("change", (event) => {
            var _a;
            const elTarget = event.target;
            const alias = (_a = elTarget === null || elTarget === void 0 ? void 0 : elTarget.options[elTarget.selectedIndex].dataset) === null || _a === void 0 ? void 0 : _a.alias;
            changeVisibleFilterBox(alias);
            isChooseEstateType = !!elTarget;
        });
        initMultiSelectedScript();
    }
}
function initMultiSelectedScript() {
    const multi_selected_box_list = document.querySelectorAll(".multi_selected_box");
    if (multi_selected_box_list.length) {
        multi_selected_box_list.forEach((multi_selected_box) => {
            const allCheckboxesLabels = multi_selected_box.querySelectorAll(".form-check-label");
            const selected_area = multi_selected_box.querySelector(".selected_area");
            let checksValues = [];
            allCheckboxesLabels.forEach((label) => {
                const inputCheckbox = label.firstElementChild;
                inputCheckbox.addEventListener("change", (ev) => {
                    const elTarget = ev.target;
                    const isExistEl = checksValues.indexOf(elTarget.value) === -1;
                    if (!isExistEl) {
                        checksValues = checksValues.filter((item) => {
                            return item !== elTarget.value;
                        });
                    }
                    else {
                        checksValues.push(elTarget.value);
                    }
                    if (checksValues.length) {
                        selected_area.innerHTML = `Выбрано: ${checksValues.length}`;
                    }
                    else {
                        selected_area.innerHTML = `Выбрать`;
                    }
                });
            });
        });
    }
}
function initSlideshowsOnMain() {
    const myCarousel = document.querySelector("#headerSlider");
    if (myCarousel) {
        const windowRef = window;
        const bootstrap = windowRef.bootstrap;
        new bootstrap.Carousel(myCarousel, {
            interval: 10000,
            ride: "carousel",
        });
    }
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
