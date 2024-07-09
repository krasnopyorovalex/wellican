$(function () {
    const pathname = window.location.pathname.split('/');
    const objectId = pathname[3];

// Filepond: Multiple Files
    const pond = FilePond.create(document.querySelector('.multiple-files-filepond'), {
        credits: null,
        allowImagePreview: false,
        allowMultiple: true,
        allowFileEncode: false,
        allowRemove: false,
        allowRevert: false,
        required: false,
        storeAsFile: true,
        acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg", "image/webp"],
        labelIdle: 'Перетащите изображения или <span class="filepond--label-action">Выберите на компьютере</span>',
        labelFileProcessing: 'Загрузка',
        labelFileProcessingComplete: 'Загружено успешно',
        labelTapToUndo: '_______________',
        labelTapToCancel: '................',
        name: 'image',
        onprocessfiles: () => {
            pond.getFiles().forEach((file) => setTimeout(() => pond.removeFile(file), 200));
            return buildGalleryBox(fetchAllImages('/_root/object-images/' + objectId));
        },
        server: {
            process: (fieldName, file, metadata, load, error, progress) => {
                // We ignore the metadata property and only send the file
                const formData = new FormData();
                formData.append(fieldName, file, file.name);

                const request = new XMLHttpRequest();
                request.open(
                    "POST",
                    "/_root/object-images/" + objectId
                );
                request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

                request.upload.onprogress = (e) => {
                    progress(e.lengthComputable, e.loaded, e.total)
                };

                request.onload = function () {
                    if (request.status >= 200 && request.status < 300) {
                        load(request.responseText)
                    } else {
                        error("oh no")
                    }
                };

                request.onreadystatechange = function () {
                    if (this.readyState === 4) {
                        if (this.status !== 201) {
                            Toastify({
                                text: "Failed uploading to server! see console f12",
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#ff0000",
                            }).showToast()
                        }
                    }
                };

                request.send(formData);
            },
            fetch: null,
            revert: null
        }
    });

    sortImages();
});

const fetchAllImages = (url) => {
    return fetch(url)
        .then(response => response.json())
        .then(images => {
            return images['data'];
        });
};

const buildGalleryBox = (promise) => {
    promise.then((images) => {
        let html = '';
        images.forEach((img) => {
            html += `
                <div class="col-6 col-sm-4 col-lg-2 mt-2 mb-2 position-relative single-image">
                    <a href="${img.url}" data-gallery="example-gallery" data-toggle="lightbox">
                        <img class="w-100 rounded" src="${img.thumb}" data-id="${img.id}" alt="${img.alt}" title="${img.title}" />
                    </a>
                    <div class="position-absolute z-1 end-0 bottom-0 me-3 mb-1">
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-info btn-image-move">
                                <i class="bi-arrows-move"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-image-edit" data-bs-toggle="modal" data-bs-target="#image-edit">
                                <i class="bi-pencil-fill"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-image-destroy" data-href="/_root/object-images/${img.id}">
                                <i class="bi-trash-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });

        document.getElementById('gallery-box').innerHTML = `<div class="row" id="sortable-grid">${html}</div><hr>`;
        document.querySelectorAll('#gallery-box a').forEach(el => el.addEventListener('click', Lightbox.initialize));
        sortImages();
    });
};

function sortImages() {
    const sortableGrid = document.getElementById('sortable-grid');
    let mapImages = buildMapImages(sortableGrid.querySelectorAll('img'));

    new Sortable(sortableGrid, {
        animation: 150,
        ghostClass: 'blue-background-class',
        handle: '.btn-image-move',
        onEnd: function () {
            const images = sortableGrid.querySelectorAll('img');
            const sortedMapImages = buildMapImages(images);

            images.forEach((image, position) => {
                const id = parseInt(image.getAttribute('data-id'));

                if (mapImages[position] === sortedMapImages[position]) {
                    return;
                }

                const payload = {
                    'position': position + 1,
                    '_method': 'put'
                };

                fetch(`/_root/object-images/${id}`, {
                    method: 'post',
                    body: JSON.stringify(payload),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                }).then(response => response.json());
            });

            mapImages = sortedMapImages;
        }
    });
}

function buildMapImages(images, map = []) {
    images.forEach( (image, position) => {
        map.push(`${parseInt(image.getAttribute('data-id'))}_${position}`);
    });

    return map;
}
