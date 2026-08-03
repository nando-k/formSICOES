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

        $validated = $this->normalizarDatos($validated);

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

        $validated = $this->normalizarDatos($validated);

        $entidad->update($validated);

        return $entidad;
    }

    public function destroy(Entidad $entidad)
    {
        $entidad->delete();

        return response()->noContent();
    }

    private function normalizarDatos(array $datos): array
    {
        $camposMayusculas = [
            'nombre_entidad',
            'direccion',
            'ciudad',
            'telefono',
            'contacto',
            'cargo_contacto',
        ];

        foreach ($camposMayusculas as $campo) {
            if (array_key_exists($campo, $datos) && $datos[$campo] !== null) {
                $datos[$campo] = mb_strtoupper(trim($datos[$campo]), 'UTF-8');
            }
        }

        if (array_key_exists('correo', $datos) && $datos['correo'] !== null) {
            $datos['correo'] = mb_strtolower(trim($datos['correo']), 'UTF-8');
        }

        return $datos;
    }
}