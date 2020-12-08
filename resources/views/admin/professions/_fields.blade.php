<div class="form-group">
    <label for="title">Name</label>
    <input type="text" name="title"
           class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
           value="{{ old('title', $profession->title) }}"
           placeholder="Name">
    {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
</div>

<button class="btn btn-primary">{{ $btnText }}</button>
@if(isset($_COOKIE['pageurl']))
    <a href="{{ url('/admin/skills'.$_COOKIE['pageurl']) }}" class="btn btn-secondary">Volver</a>
@endif

