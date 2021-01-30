<tr>
    <td>{{ optional($post->published_at)->format('d/m/Y') }}</td>
    <td>{{ $post->title }}</td>
    <td>{{ $post->excerpt_resume }}</td>
    <td>
        <a href="#"
           class="btn btn-primary btn-xs">
            <i class="far fa-eye"></i>
        </a>
        <a href="{{ route('admin.posts.edit', $post) }}"
           class="btn btn-info btn-xs">
            <i class="fas fa-pencil-alt">
            </i>
        </a>
        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" style="display: inline">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger btn-xs"
                    onclick="return confirm('¿Estás seguro/a?')">
                <i class="fas fa-trash">
                </i>
            </button>
        </form>
    </td>
</tr>
