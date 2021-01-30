<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name"
           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
           value="{{ old('name', $tag->name) }}"
           placeholder="Name">
    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
</div>

@if($showUrl)
    <div class="form-group">
        <label for="url">Url</label>
        <input type="text"
               name="url"
               value="{{ $tag->url }}"
               class="form-control"
               disabled>
    </div>
@endif

<button class="btn btn-primary">{{ $btnText }}</button>
@if(isset($_COOKIE['pageurl']))
    <a href="{{ url('/admin/tags'.$_COOKIE['pageurl']) }}" class="btn btn-secondary">Volver</a>
@endif

