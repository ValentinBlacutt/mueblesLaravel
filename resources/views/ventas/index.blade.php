@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Ventas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <form method="GET" class="d-flex" style="gap: 0.5rem;">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por cliente"
                   value="{{ request('buscar') }}">
            <button class="btn btn-primary">Buscar</button>
        </form>
        <a href="{{ route('ventas.create') }}" class="btn btn-success">+ Nueva venta</a>
    </div>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Mueble</th>
                <th>Cliente</th>
                <th>Cantidad</th>
                <th>
                    <a class="text-white text-decoration-none"
                       href="{{ request()->fullUrlWithQuery(['orden' => 'fecha_venta', 'dir' => request('dir') == 'asc' ? 'desc' : 'asc']) }}">
                        Fecha {!! request('orden', 'fecha_venta') == 'fecha_venta' ? (request('dir') == 'asc' ? '▲' : '▼') : '' !!}
                    </a>
                </th>
                <th>Total</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($ventas as $venta)
            <tr>
                <td>{{ $venta->mueble->nombre }}</td>
                <td>{{ $venta->cliente }}</td>
                <td>{{ $venta->cantidad }}</td>
                <td>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }}</td>
                <td>${{ number_format($venta->total, 2) }}</td>
                <td class="text-end">
                    <a href="{{ route('ventas.edit', $venta) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('ventas.destroy', $venta) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Eliminar esta venta?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center">No hay ventas registradas.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $ventas->links() }}
@endsection