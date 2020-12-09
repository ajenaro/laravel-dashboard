<div class="form-group">
    <label for="title">Title</label>
    <input type="text"
           name="title"
           value="{{ old('title', $post->title) }}"
           class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
           placeholder="Título de la publicación">
    {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="body">Body</label>
    <textarea name="body"
              class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
              placeholder="Contenido de la publicación">{{ old('body', $post->body) }}</textarea>
    {!! $errors->first('body', '<div class="invalid-feedback">:message</div>') !!}
</div>
