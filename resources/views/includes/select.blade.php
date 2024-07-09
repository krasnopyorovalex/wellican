<fieldset class="form-group">
    <label for="{{ $name }}">{{ $label }}:</label>
    <select class="form-select choices" id="{{ $name }}" name="{{ $name }}">
        @foreach($items as $value)
            <option value="{{ $value->id }}" @if (isset($entity) && old($name, $entity->{$name}) === $value->id) selected @endif>{{ $value->name }}</option>
        @endforeach
    </select>
</fieldset>
