@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Nuevo mueble</h2>

    <form action="{{ route('muebles.store') }}" method="POST">
        @csrf
        @include('muebles._form')
        <button class="btn btn-success mt-3">Guardar</button>
        <a href="{{ route('muebles.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
@endsection