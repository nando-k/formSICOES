<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entidad;
use Illuminate\Http\Request;

class EntidadController extends Controller
{
    public function index()
    {
        return Entidad::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_entidad' => 'required|string|max:255',
            'direccion' => 'nullable|string',
            'ciudad' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:100',
            'correo' => 'nullable|email|max:150',
            'contacto' => 'nullable|string|max:150',
            'cargo_contacto' => 'nullable|string|max:150',
        ]);

        return Entidad::create($validated);
    }

    public function show(Entidad $entidad)
    {
        return $entidad->load('convocatorias');
    }

    public function update(Request $request, Entidad $entidad)
    {
        $validated = $request->validate([
            'nombre_entidad' => 'sometimes|string|max:255',
            'direccion' => 'nullable|string',
            'ciudad' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:100',
            'correo' => 'nullable|email|max:150',
            'contacto' => 'nullable|string|max:150',
            'cargo_contacto' => 'nullable|string|max:150',
        ]);

        $entidad->update($validated);
        return $entidad;
    }

    public function destroy(Entidad $entidad)
    {
        $entidad->delete();
        return response()->noContent();
    }
}