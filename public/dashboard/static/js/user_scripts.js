$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*
     |-----------------------------------------------------------
     |   left navigation
     |-----------------------------------------------------------
     */
    const sidebarLi = $('.sidebar-menu li > a');
    let pathname = window.location.pathname.replace('menu-items', 'menus').split('/');
    const module = pathname[pathname.length - 1];
    pathname = pathname[1] + '/' + pathname[2];

    sidebarLi.each(function () {
        if ($(this).attr('href').indexOf(module) !== -1) {
            $(this).closest('li').addClass('active')
        }

        if ($(this).attr('href').indexOf(pathname) !== -1) {
            return $(this).closest('ul').addClass('submenu-open') && $(this).closest('.sidebar-item').addClass('active');
        }
    });

    /*
    |-----------------------------------------------------------
    |   Удаление элемента из списка
    |-----------------------------------------------------------
    */
    const table = $('.table-responsive table td');
    table.on('click', '.btn-destroy', function (e) {
        e.preventDefault();
        const _this = $(this),
            alias = _this.data('data-alias') ? _this.data('data-alias') : '';
        return sendDestroyRequest(_this, alias);
    });

    /*
    |-----------------------------------------------------------
    |   image actions
    |-----------------------------------------------------------
    */
    $('.nav.navbar-nav').on('click', '#logout-btn', function (e) {
        e.preventDefault();
        return $(this).closest('li').find('form').trigger('submit');
    });

    const modalInfo = $('#image-edit'),
        imageBox = $('#gallery-box');
    modalInfo.on('submit', 'form', function (e) {
        e.preventDefault();
        const _this = jQuery(this);
        const id = _this.attr('action').replace(/\D/g, "");
        const findImage = imageBox.find(`img[data-id=${id}]`);
        const alt = _this.find('input[name=alt]').val();
        const title = _this.find('input[name=title]').val();

        if (alt === findImage.attr('alt') && title === findImage.attr('title')) {
            return modalInfo.modal('hide');
        }

        return jQuery.ajax({
            url: _this.attr('action'),
            type: "POST",
            dataType: "json",
            data: _this.serialize(),
            success: function ({data}) {
                findImage.attr('alt', alt);
                findImage.attr('title', title);

                return Toastify({
                    text: data.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#28ab55",
                }).showToast() && modalInfo.modal('hide');
            }
        });
    });

    imageBox.on('click', '.btn-image-edit', function () {
        const img = $(this).closest('.single-image').find('img');
        const alt = img.attr('alt');
        const title = img.attr('title');

        return modalInfo.find('input[name=alt]').val(alt)
            && modalInfo.find('input[name=title]').val(title)
            && modalInfo.find('form').attr('action', `/_root/object-images/${img.attr('data-id')}`);
    });

    const singleImageEditPopup = $('#single-image-edit');
    const entityImage = $('#entity-image');
    singleImageEditPopup.on('submit', 'form', function (e) {
        e.preventDefault();
        const _this = jQuery(this);
        const action = _this.attr('action');
        const alt = _this.find('input[name=alt]').val();
        const title = _this.find('input[name=title]').val();
        const image = entityImage.find('img');

        if (alt === image.attr('alt') && title === image.attr('title')) {
            return singleImageEditPopup.modal('hide');
        }

        return jQuery.ajax({
            url: action,
            type: "put",
            dataType: "json",
            data: _this.serialize(),
            success: function ({data}) {
                image.attr('alt', _this.find('input[name=alt]').val());
                image.attr('title', _this.find('input[name=title]').val());

                return Toastify({
                    text: data.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#28ab55",
                }).showToast() && singleImageEditPopup.modal('hide');
            }
        });
    });

    imageBox.on('click', '.btn-image-destroy', destroyImage);
    entityImage.on('click', '.btn-image-destroy', destroyImage);
});

function sendDestroyRequest(_this, alias = '') {
    return confirm('Вы уверены, что хотите удалить?') && alias !== 'index'
        ? _this.closest('td').find('.form-destroy').trigger('submit')
        : false;
}

function destroyImage() {
    if (confirm('Вы уверены, что хотите удалить изображение?')) {
        const _this = jQuery(this);
        return $.ajax({
            url: _this.attr('data-href'),
            type: "POST",
            data: {'_method': 'delete'},
            success: function ({data}) {
                return Toastify({
                    text: data.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#28ab55",
                }).showToast() && _this.closest('.single-image').remove();
            }
        });
    }
}

document.addEventListener(
    "DOMContentLoaded",
    function () {
        const tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    },
    false
);
