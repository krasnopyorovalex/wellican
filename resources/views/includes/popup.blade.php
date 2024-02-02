<div class="modal fade text-left" id="image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">
                    SEO для изображения
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('admin.images.update', $image) }}" method="post">
                @csrf
                @method('put')
                <div class="modal-body">
                    <label for="image-title">Title: </label>
                    <div class="form-group">
                        <input id="image-title" type="text" name="title" value="{{ $image->title }}" class="form-control"/>
                    </div>
                    <label for="image-alt">Alt: </label>
                    <div class="form-group">
                        <input id="image-alt" type="text" name="alt" value="{{ $image->alt }}" class="form-control"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Закрыть</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Сохранить</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
