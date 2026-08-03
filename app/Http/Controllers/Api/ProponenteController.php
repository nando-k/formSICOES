<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proponente;
use Illuminate\Http\Request;

class ProponenteController extends Controller
{
    public function index()
    {
        return Proponente::with('representanteLegal')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'razon_social' => 'nullable|string|max:255',
            'nombre_comercial' => 'nullable|string|max:255',
            'nit' => 'nullable|string|max:30',
            'matricula_comercio' => 'nullable|string|max:50',
            'direccion' => 'nullable|string',
            'ciudad' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:100',
            'correo' => 'nullable|email|max:150',
            'tipo_organizacion' => 'nullable|string|max:100',
            'representante_legal_id' => 'nullable|integer',
            'activo' => 'nullable|boolean',
        ]);

        $validated = $this->normalizarDatos($validated);

        return Proponente::create($validated);
    }

    public function show(Proponente $proponente)
    {
        return $proponente->load('representanteLegal', 'personal', 'convocatorias');
    }

    public function update(Request $request, Proponente $proponente)
    {
        $validated = $request->validate([
            'razon_social' => 'nullable|string|max:255',
            'nombre_comercial' => 'nullable|string|max:255',
            'nit' => 'nullable|string|max:30',
            'matricula_comercio' => 'nullable|string|max:50',
            'direccion' => 'nullable|string',
            'ciudad' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:100',
            'correo' => 'nullable|email|max:150',
            'tipo_organizacion' => 'nullable|string|max:100',
            'representante_legal_id' => 'nullable|integer',
            'activo' => 'nullable|boolean',
        ]);

        $validated = $this->normalizarDatos($validated);

        $proponente->update($validated);

        return $proponente;
    }

    public function destroy(Proponente $proponente)
    {
        $proponente->delete();

        return response()->noContent();
    }

    private function normalizarDatos(array $datos): array
    {
        $camposMayusculas = [
            'razon_social',
            'nombre_comercial',
            'nit',
            'matricula_comercio',
            'direccion',
            'ciudad',
            'pais',
            'telefono',
            'tipo_organizacion',
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