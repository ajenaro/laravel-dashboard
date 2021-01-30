<tr>
    <td>{{ $tag->name }}</td>
    <td>
        <a href="{{ route('admin.tags.edit', $tag) }}"
           class="btn btn-info btn-xs">
            <i class="fas fa-pencil-alt">
            </i>
        </a>
        <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}" style="display: inline">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger btn-xs"
                    onclick="return confirm('¿Are you sure?')">
                <i class="fas fa-trash">
                </i>
            </button>
        </form>
    </td>
</tr>
