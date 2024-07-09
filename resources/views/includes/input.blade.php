<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type ?? 'text' }}" id="{{ $name }}" class="form-control" placeholder="{{ $label }}" name="{{ $name }}" value="{{ old( $name, isset($entity) ? $entity->{$name} : '') }}" autocomplete="off">
</div>
