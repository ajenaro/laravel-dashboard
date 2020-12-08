<tr>
    <td>{{ $user->created_at->format('d/m/Y') }}</td>
    <td>{{ $user->team->name }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->profile->profession->title }}</td>
    <td>
        <div class="icheck-primary d-inline">
            <input type="checkbox"
                   class="status_check"
                   id="status_{{ $user->id }}" {{ $user->state ? 'checked' : '' }}
                   disabled>
            <label for="status_{{ $user->id }}"></label>
        </div>
    </td>
    <td>
        <a href="{{ route('admin.users.show', $user) }}"
           class="btn btn-primary btn-xs">
            <i class="far fa-eye"></i>
        </a>
        <a href="{{ route('admin.users.edit', $user) }}"
           class="btn btn-info btn-xs">
            <i class="fas fa-pencil-alt">
            </i>
        </a>
        @if($user->id != auth()->user()->id)
        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display: inline">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger btn-xs"
                    onclick="return confirm('¿Are you sure?')">
                <i class="fas fa-trash">
                </i>
            </button>
        </form>
        @endif
    </td>
</tr>
