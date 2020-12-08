<tr>
    <td>{{ $profession->title }}</td>
    <td>
        <a href="{{ route('admin.professions.edit', $profession) }}"
           class="btn btn-info btn-xs">
            <i class="fas fa-pencil-alt">
            </i>
        </a>
        <form method="POST" action="{{ route('admin.professions.destroy', $profession) }}" style="display: inline">
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
