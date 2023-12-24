// Разукрашиваем элемент в заголовке типов недвижимсоти
function initFillColorForTypeTitle(): void {
    const estateTypeTitleList: NodeList =
        document.querySelectorAll(".estate_type_title");

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

initFillColorForTypeTitle();
