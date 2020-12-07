<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name"
           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
           value="{{ old('name', $skill->name) }}"
           placeholder="Name">
    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
</div>

<button class="btn btn-primary">{{ $btnText }}</button>
<a href="{{ url('/admin/skills'.$_COOKIE['pageurl']) }}" class="btn btn-secondary">Volver</a>
