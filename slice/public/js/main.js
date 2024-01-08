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
function initCarousel() {
    let items = document.querySelectorAll(".carousel .carousel-item");
    if (items.length) {
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
(() => {
    initCarousel();
    initFillColorForTypeTitle();
})();
