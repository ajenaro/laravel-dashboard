<div class="form-group">
    <label for="published_at">Published at</label>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
            </span>
        </div>
        <input type="text"
               name="published_at"
               value="{{ old('published_at', $post->published_at ? $post->published_at->format('d/m/Y') : '') }}"
               class="form-control"
               id="published_at">
    </div>
</div>

<div class="form-group">
    <label for="category_id">Categories</label>
    <select name="category_id" class="form-control select2bs4 {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
        <option value="">Select</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="tags">Tags</label>

</div>

<div class="form-group">
    <label for="excerpt">Excerpt</label>
    <textarea name="excerpt"
              class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}"
              placeholder="Post excerpt">{{ old('excerpt', $post->excerpt) }}</textarea>
    {!! $errors->first('excerpt', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <div class="dropzone"></div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $btnText }}</button>
    @if(isset($_COOKIE['pageurl']))
        <a href="{{ url('/admin/posts'.$_COOKIE['pageurl']) }}" class="btn btn-secondary">Volver</a>
    @endif
</div>
