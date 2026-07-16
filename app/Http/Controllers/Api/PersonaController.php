<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index()
    {
        return Persona::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombres' => 'required|string|max:150',
            'apellido_paterno' => 'nullable|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'ci' => 'required|string|max:30',
            'ci_expedido' => 'nullable|string|max:10',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:100',
            'correo' => 'nullable|email|max:150',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        return Persona::create($validated);
    }

    public function show(Persona $persona)
    {
        return $persona->load('proponentesRepresentados');
    }

    public function update(Request $request, Persona $persona)
    {
        $validated = $request->validate([
            'nombres' => 'sometimes|string|max:150',
            'apellido_paterno' => 'nullable|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'ci' => 'sometimes|string|max:30',
            'ci_expedido' => 'nullable|string|max:10',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:100',
            'correo' => 'nullable|email|max:150',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $persona->update($validated);
        return $persona;
    }

    public function destroy(Persona $persona)
    {
        $persona->delete(); 
        return response()->noContent();
    }
}