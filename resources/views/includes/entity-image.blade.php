<div id="entity-image">
    <div class="single-image position-relative">
        <p class="form-label font-bold">Изображение</p>
        <img src="{{ asset($image->url) }}" alt="{{ $image->alt }}" title="{{ $image->title }}" class="w-100 rounded" />

        <div class="position-absolute z-1 end-0 bottom-0 me-1 mb-1">
            <div class="btn-group btn-group">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#image" data-bs-dismiss="modal">
                    <i class="bi-pencil-fill"></i>
                </button>
                <button type="button" class="btn btn-info btn-image-destroy" data-href="{{ route('admin.images.destroy', $image) }}">
                    <i class="bi-trash-fill"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@include('includes/popup', ['image' => $image])
