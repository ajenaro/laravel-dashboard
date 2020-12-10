<div class="form-group">
    <label for="title">Title</label>
    <input type="text"
           name="title"
           value="{{ old('title', $post->title) }}"
           class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
           placeholder="Título de la publicación">
    {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
</div>

@if($showUrl)
<div class="form-group">
    <label for="url">Url</label>
    <input type="text"
           name="url"
           value="{{ $post->url }}"
           class="form-control"
           disabled>
</div>
@endif

<div class="form-group">
    <label for="excerpt">Excerpt</label>
    <textarea name="excerpt"
              class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}"
              placeholder="Post excerpt">{{ old('excerpt', $post->excerpt) }}</textarea>
    {!! $errors->first('excerpt', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="body">Body</label>
    <textarea name="body"
              class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
              placeholder="Contenido de la publicación">{{ old('body', $post->body) }}</textarea>
    {!! $errors->first('body', '<div class="invalid-feedback">:message</div>') !!}
</div>
