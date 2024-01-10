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

function initGallForObject(): void {
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

            const carouselElPrevBt = carouselEl.getElementsByClassName(
                "carousel-control-prev"
            )[0] as Node;

            const carouselElNextBt = carouselEl.getElementsByClassName(
                "carousel-control-next"
            )[0] as Node;

            const myCarousel = document.querySelector(
                "#carouselExampleFade" + index
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
        });
    }
}

(() => {
    initReviewsCarousel();
    initFillColorForTypeTitle();
    initGallForObject();
})();
