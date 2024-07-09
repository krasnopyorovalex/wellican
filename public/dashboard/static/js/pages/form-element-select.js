let choices = document.querySelectorAll(".choices")
let initChoice
for (let i = 0; i < choices.length; i++) {
    if (choices[i].classList.contains("multiple-remove")) {
        initChoice = new Choices(choices[i], {
            delimiter: ",",
            editItems: true,
            maxItemCount: -1,
            removeItemButton: true,
            loadingText: 'Загрузка...',
            noResultsText: 'Не найдено',
            noChoicesText: 'Нет выбора, из которого можно было бы выбирать',
            itemSelectText: 'Нажмите для выбора',
            uniqueItemText: 'Могут быть добавлены только уникальные значения',
            customAddItemText: 'Могут быть добавлены только значения, соответствующие определенным условиям',
        })
    } else {
        initChoice = new Choices(choices[i])
    }
}
