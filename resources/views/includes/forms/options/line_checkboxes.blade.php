<div class="col col-md-3">
    <label for="f-{{ $filter->id }}">{{ $filter->name }}</label>
    <div class="flats_types_box">
        @foreach($filter->options as $option)
            <div class="form-check">
                <label class="form-check-label">
                    <input
                        name="options[{{ $filter->id }}][]"
                        class="form-check-input"
                        type="checkbox"
                        value="{{ $option->id }}"
                        {{ (isset(request()->get('options')[$filter->id]) && in_array($option->id, request()->get('options')[$filter->id])) ? 'checked' : '' }}
                    />
                    {{ $option->value }}
                </label>
            </div>
        @endforeach
    </div>
</div>
