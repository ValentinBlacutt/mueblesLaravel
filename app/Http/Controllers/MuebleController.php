<?php

namespace App\Http\Controllers;

use App\Models\Mueble;
use App\Http\Requests\MuebleRequest;
use Illuminate\Http\Request;

class MuebleController extends Controller
{
    public function index(Request $request)
    {
        $query = Mueble::query();

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $orden = $request->get('orden', 'nombre');
        $dir = $request->get('dir', 'asc');
        $query->orderBy($orden, $dir);

        $muebles = $query->paginate(10)->withQueryString();

        return view('muebles.index', compact('muebles'));
    }

    public function create()
    {
        return view('muebles.create');
    }

    public function store(MuebleRequest $request)
    {
        Mueble::create($request->validated());

        return redirect()->route('muebles.index')->with('success', 'Mueble creado correctamente.');
    }

    public function show(Mueble $mueble)
    {
        return view('muebles.show', compact('mueble'));
    }

    public function edit(Mueble $mueble)
    {
        return view('muebles.edit', compact('mueble'));
    }

    public function update(MuebleRequest $request, Mueble $mueble)
    {
        $mueble->update($request->validated());

        return redirect()->route('muebles.index')->with('success', 'Mueble actualizado correctamente.');
    }

    public function destroy(Mueble $mueble)
    {
        $mueble->delete();

        return redirect()->route('muebles.index')->with('success', 'Mueble eliminado correctamente.');
    }
}