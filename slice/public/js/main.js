// Разукрашиваем элемент в заголовке типов недвижимсоти
function initFillColorForTypeTitle() {
    var estateTypeTitleList = document.querySelectorAll(".estate_type_title");
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
function initCarousel() {
    var items = document.querySelectorAll(".carousel .carousel-item");
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
initFillColorForTypeTitle();
window.addEventListener("load", function () {
    console.log("All assets are loaded");
    initCarousel();
});
