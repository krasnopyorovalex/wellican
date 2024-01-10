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
function initGallForObject() {
    const cat_objects_container = document.getElementById("cat_objects");
    if (cat_objects_container) {
        const windowRef = window;
        const bootstrap = windowRef.bootstrap;
        const objects_list = document.querySelectorAll(".object");
        objects_list.forEach((item, index) => {
            const it = item;
            const carouselEl = it.firstElementChild.firstElementChild;
            carouselEl.id = "carouselExampleFade" + index;
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
        });
    }
}
(() => {
    initReviewsCarousel();
    initFillColorForTypeTitle();
    initGallForObject();
})();
