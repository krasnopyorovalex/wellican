<div class="col col-md-3">
    <label>{{ $filter->name }}</label>
    <div class="input-group mb-2">
        <input
            type="number"
            name="between[{{ $filter->id }}][from]"
            class="form-control"
            placeholder="От"
            value="{{ request()->has('between') ? request()->get('between')[$filter->id]['from'] : '' }}"
        />
        <input
            type="number"
            name="between[{{ $filter->id }}][to]"
            class="form-control"
            placeholder="До"
            value="{{ request()->has('between') ? request()->get('between')[$filter->id]['to'] : '' }}"
        />
    </div>
</div>
