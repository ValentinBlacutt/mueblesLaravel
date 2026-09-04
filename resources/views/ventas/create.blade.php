@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Nueva venta</h2>

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        @include('ventas._form')
        <button class="btn btn-success mt-3">Guardar</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
@endsection