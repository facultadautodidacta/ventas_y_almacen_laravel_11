@foreach ($items as $item)
    <tr class="text-center">
    <td>{{ $item->email }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->rol }}</td>
    <td>
        <a href="" class="btn btn-secondary">
        <i class="fa-solid fa-user-lock"></i>
        </a>
    </td>
    <td class="text-center">
        <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="activo{{ $item->id }}" 
        {{ $item->activo ? 'checked' : '' }} >
        </div>
    </td>
    <td>
        <a href="{{ route("usuarios.edit", $item->id) }}" class="btn btn-warning">
        <i class="fa-solid fa-user-pen"></i>
        </a>
        
    </td>
    </tr>
@endforeach