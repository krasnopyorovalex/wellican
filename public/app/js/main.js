var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (g && (g = 0, op[0] && (_ = 0)), _) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
var isChooseEstateType = null;
// Разукрашиваем элемент в заголовке типов недвижимсоти
function initFillColorForTypeTitle() {
    var estateTypeTitleList = document.querySelectorAll(".estate_type_title");
    if (estateTypeTitleList.length) {
        var firstEl = estateTypeTitleList[0];
        var slitText = firstEl.innerText.trim().split(" ");
        var lastWord = slitText[slitText.length - 1];
        var res = slitText.slice(0, -1);
        firstEl.innerHTML =
            res.join(" ") +
                (slitText.length > 0
                    ? " <i class='highlight'>" + lastWord + "</i>"
                    : lastWord);
    }
}
function initReviewsCarousel() {
    var items = document.querySelectorAll(".carousel .carousel-item");
    var reviews_container = document.getElementById("reviews");
    if (items.length && reviews_container) {
        items.forEach(function (el) {
            var minPerSlide = 3;
            var next = el.nextElementSibling;
            for (var i = 1; i < minPerSlide; i++) {
                if (!next) {
                    // wrap carousel by using first child
                    next = items[0];
                }
                var cloneChild = next.cloneNode(true);
                el.appendChild(cloneChild.children[0]);
                next = next.nextElementSibling;
            }
        });
    }
}
function initGallForList() {
    var cat_objects_container = document.getElementById("cat_objects");
    if (cat_objects_container) {
        var windowRef = window;
        var bootstrap_1 = windowRef.bootstrap;
        var objects_list = document.querySelectorAll(".object");
        objects_list.forEach(function (item, index) {
            var it = item;
            var carouselEl = it.firstElementChild.firstElementChild;
            carouselEl.id = "carouselExampleFade" + index;
            var carouselItemDivEl = carouselEl.firstElementChild;
            var carouselElPrevBt = carouselEl.getElementsByClassName("carousel-control-prev")[0];
            var carouselElNextBt = carouselEl.getElementsByClassName("carousel-control-next")[0];
            var myCarousel = document.querySelector("#carouselExampleFade" + index);
            var carousel = new bootstrap_1.Carousel(myCarousel, {
                window: false,
                ride: false,
            });
            carouselElPrevBt.addEventListener("click", function () {
                carousel.prev();
            });
            carouselElNextBt.addEventListener("click", function () {
                carousel.next();
            });
            carouselItemDivEl.addEventListener("click", function () {
                carousel.next();
            });
        });
    }
}
function addFavorite() {
    console.log("addFavorite");
}
function initObjectViewScripts() {
    var object_view_container = document.getElementById("object_view");
    if (object_view_container) {
        var initObjectGallCarousel = function () {
            var _a;
            var windowRef = window;
            var bootstrap = windowRef.bootstrap;
            var myCarousel = document.querySelector("#carouselObjectView");
            if ((_a = myCarousel === null || myCarousel === void 0 ? void 0 : myCarousel.children) === null || _a === void 0 ? void 0 : _a.length) {
                var carIndicators = myCarousel.children[0];
                var carInner = myCarousel.children[1];
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
        function initMap() {
            return __awaiter(this, void 0, void 0, function () {
                var windowRef, ymaps, mapSelector, _a, latitude, longitude, current_obj_coords, myMap;
                return __generator(this, function (_b) {
                    switch (_b.label) {
                        case 0:
                            windowRef = window;
                            ymaps = windowRef.ymaps;
                            return [4 /*yield*/, ymaps.ready()];
                        case 1:
                            _b.sent();
                            mapSelector = document.querySelector("#map");
                            _a = mapSelector.dataset, latitude = _a.latitude, longitude = _a.longitude;
                            current_obj_coords = [latitude, longitude];
                            myMap = new ymaps.Map("map", {
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
                            return [2 /*return*/];
                    }
                });
            });
        }
        initMap();
    }
}
function addListenerToAdditionalFilters() {
    var additional_filters_button = document.querySelector("#additional_filters_button");
    additional_filters_button.addEventListener("click", toggleButton, false);
    function toggleButton(event) {
        event.preventDefault();
        if (!isChooseEstateType) {
            alert("Уточните тип недвижимости");
            return;
        }
        var additional_filters = document.querySelector(".additional_filters");
        additional_filters_button.innerHTML = !additional_filters.hidden ? 'Показать рассширенный поиск' : 'Скрыть рассширенный поиск';
        additional_filters.hidden = !additional_filters.hidden;
    }
}
function initFiltersBox() {
    var filters_box = document.querySelector(".filters_box");
    var additional_filters = document.querySelector(".additional_filters");
    if (additional_filters) {
        additional_filters.hidden = true;
    }
    if (filters_box) {
        var selectElement = document.querySelector("#input_property_type");
        var flats_filters_1 = filters_box.querySelector("#flats_filters");
        var cottagesHouses_filters_1 = filters_box.querySelector("#cottagesHouses_filters");
        var land_filters_1 = filters_box.querySelector("#land_filters");
        var commercial_filters_1 = filters_box.querySelector("#commercial_filters");
        var resetBoxes_1 = function () {
            var box_list = filters_box.querySelectorAll(".box");
            box_list.forEach(function (it) {
                it.hidden = true;
            });
        };
        resetBoxes_1();
        var propertyTypeValue = Number(selectElement.value);
        if (isNaN(propertyTypeValue)) {
            isChooseEstateType = null;
        }
        else {
            isChooseEstateType = !!propertyTypeValue;
            switchFilters(selectElement.value);
        }
        selectElement.addEventListener("change", function (event) {
            var elTarget = event.target;
            isChooseEstateType = !!elTarget;
            resetBoxes_1();
            switchFilters(elTarget.value);
        });
        function switchFilters(type) {
            switch (type) {
                case "1":
                    flats_filters_1.hidden = false;
                    break;
                case "4":
                    cottagesHouses_filters_1.hidden = false;
                    break;
                case "5":
                    land_filters_1.hidden = false;
                    break;
                case "6":
                    commercial_filters_1.hidden = false;
                    break;
                default:
                    resetBoxes_1();
            }
        }
        initMultiSelectedScript();
    }
}
function initMultiSelectedScript() {
    var multi_selected_box_list = document.querySelectorAll(".multi_selected_box");
    if (multi_selected_box_list.length) {
        multi_selected_box_list.forEach(function (multi_selected_box) {
            var allCheckboxesLabels = multi_selected_box.querySelectorAll(".form-check-label");
            var selected_area = multi_selected_box.querySelector(".selected_area");
            var checksValues = [];
            allCheckboxesLabels.forEach(function (label) {
                var inputCheckbox = label.firstElementChild;
                inputCheckbox.addEventListener("change", function (ev) {
                    var elTarget = ev.target;
                    var isExistEl = checksValues.indexOf(elTarget.value) === -1;
                    if (!isExistEl) {
                        checksValues = checksValues.filter(function (item) {
                            return item !== elTarget.value;
                        });
                    }
                    else {
                        checksValues.push(elTarget.value);
                    }
                    if (checksValues.length) {
                        selected_area.innerHTML = "\u0412\u044B\u0431\u0440\u0430\u043D\u043E: ".concat(checksValues.length);
                    }
                    else {
                        selected_area.innerHTML = "\u0412\u044B\u0431\u0440\u0430\u0442\u044C";
                    }
                });
            });
        });
    }
}
(function () {
    initReviewsCarousel();
    initFillColorForTypeTitle();
    initGallForList();
    initObjectViewScripts();
    initFiltersBox();
    addListenerToAdditionalFilters();
})();
