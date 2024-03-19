$(function () {
    const sortableGrid = document.getElementById('sortable-table');

    new Sortable(sortableGrid, {
        animation: 150,
        ghostClass: 'blue-background-class',
        handle: '.btn-move',
        onEnd: function () {
            const gridItems = sortableGrid.querySelectorAll('.grid-item');
            const data = [];

            gridItems.forEach((row, position) => {
                data[position] = parseInt(row.getAttribute('data-id'));
            });

            fetch(sortableGrid.getAttribute('data-url'), {
                method: 'post',
                body: JSON.stringify({'data': data}),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            }).then(response => response.json())
                .then(data => {
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        close: true,
                        gravity: 'top',
                        position: 'right',
                        backgroundColor: '#ff0000',
                    }).showToast()
                });
        }
    });
});
