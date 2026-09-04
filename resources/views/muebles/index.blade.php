@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Muebles</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <form method="GET" class="d-flex" style="gap: 0.5rem;">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre"
                   value="{{ request('buscar') }}">
            <button class="btn btn-primary">Buscar</button>
            @if(request('buscar'))
                <a href="{{ route('muebles.index') }}" class="btn btn-outline-secondary">Limpiar</a>
            @endif
        </form>
        <a href="{{ route('muebles.create') }}" class="btn btn-success">+ Nuevo mueble</a>
    </div>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>
                    <a class="text-white text-decoration-none"
                       href="{{ request()->fullUrlWithQuery(['orden' => 'nombre', 'dir' => request('dir') == 'asc' ? 'desc' : 'asc']) }}">
                        Nombre {!! request('orden', 'nombre') == 'nombre' ? (request('dir') == 'asc' ? '▲' : '▼') : '' !!}
                    </a>
                </th>
                <th>Categoría</th>
                <th>
                    <a class="text-white text-decoration-none"
                       href="{{ request()->fullUrlWithQuery(['orden' => 'precio', 'dir' => request('dir') == 'asc' ? 'desc' : 'asc']) }}">
                        Precio {!! request('orden') == 'precio' ? (request('dir') == 'asc' ? '▲' : '▼') : '' !!}
                    </a>
                </th>
                <th>Stock</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($muebles as $mueble)
            <tr>
                <td>{{ $mueble->nombre }}</td>
                <td>{{ $mueble->categoria ?? '—' }}</td>
                <td>${{ number_format($mueble->precio, 2) }}</td>
                <td>{{ $mueble->stock }}</td>
                <td class="text-end">
                    <a href="{{ route('muebles.edit', $mueble) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('muebles.destroy', $mueble) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Eliminar este mueble?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center">No hay muebles cargados.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $muebles->links() }}
@endsection