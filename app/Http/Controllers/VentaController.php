<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Mueble;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $query = Venta::with('mueble');

        if ($request->filled('buscar')) {
            $query->where('cliente', 'like', '%' . $request->buscar . '%');
        }

        $orden = $request->get('orden', 'fecha_venta');
        $dir = $request->get('dir', 'desc');
        $query->orderBy($orden, $dir);

        $ventas = $query->paginate(10)->withQueryString();

        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $muebles = Mueble::orderBy('nombre')->get();

        return view('ventas.create', compact('muebles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mueble_id'   => 'required|exists:muebles,id',
            'cliente'     => 'required|string|max:255',
            'cantidad'    => 'required|integer|min:1',
            'fecha_venta' => 'required|date',
            'total'       => 'required|numeric|min:0',
        ]);

        Venta::create($validated);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }

    public function show(Venta $venta)
    {
        return view('ventas.show', compact('venta'));
    }

    public function edit(Venta $venta)
    {
        $muebles = Mueble::orderBy('nombre')->get();

        return view('ventas.edit', compact('venta', 'muebles'));
    }

    public function update(Request $request, Venta $venta)
    {
        $validated = $request->validate([
            'mueble_id'   => 'required|exists:muebles,id',
            'cliente'     => 'required|string|max:255',
            'cantidad'    => 'required|integer|min:1',
            'fecha_venta' => 'required|date',
            'total'       => 'required|numeric|min:0',
        ]);

        $venta->update($validated);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy(Venta $venta)
    {
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
}