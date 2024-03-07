<div class="col-md-2">
    <label>{{ $filter->name }}</label>
    <div class="multi_selected_box">
        <button class="selected_area" type="button" data-bs-config='{"delay":0, "autoClose":"outside"}' data-bs-toggle="dropdown" aria-expanded="false">
            Выбрать
        </button>
        <div class="dropdown-menu">
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
</div>
