@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Editar mueble</h2>

    <form action="{{ route('muebles.update', $mueble) }}" method="POST">
        @csrf
        @method('PUT')
        @include('muebles._form')
        <button class="btn btn-success mt-3">Actualizar</button>
        <a href="{{ route('muebles.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
@endsection