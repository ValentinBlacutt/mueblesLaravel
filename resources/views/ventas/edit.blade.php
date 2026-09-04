@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Editar venta</h2>

    <form action="{{ route('ventas.update', $venta) }}" method="POST">
        @csrf
        @method('PUT')
        @include('ventas._form')
        <button class="btn btn-success mt-3">Actualizar</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
@endsection