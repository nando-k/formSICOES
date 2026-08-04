<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\Proponente;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProponenteController extends Controller
{
    public function index()
    {
        return Proponente::with('representanteLegal')->orderBy('id_proponente')->get();
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

        $this->validarRepresentanteLegal($validated['representante_legal_id'] ?? null);
        $this->validarNitDuplicado($validated['nit'] ?? null);

        return Proponente::create($validated);
    }

    public function show($id)
    {
        $proponente = Proponente::where('id_proponente', $id)->firstOrFail();

        return $proponente->load('representanteLegal', 'personal', 'convocatorias');
    }

    public function update(Request $request, $id)
    {
        $proponente = Proponente::where('id_proponente', $id)->firstOrFail();

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

        $this->validarRepresentanteLegal($validated['representante_legal_id'] ?? null);

        $this->validarNitDuplicado(
            $validated['nit'] ?? null,
            $proponente->id_proponente
        );

        $proponente->update($validated);

        return $proponente->load('representanteLegal');
    }

    public function destroy($id)
    {
        $proponente = Proponente::where('id_proponente', $id)->firstOrFail();

        $proponente->delete();

        return response()->noContent();
    }

    private function validarRepresentanteLegal(?int $idPersona): void
    {
        if ($idPersona === null) {
            return;
        }

        if (!Persona::where('id_persona', $idPersona)->exists()) {
            throw ValidationException::withMessages([
                'representante_legal_id' => ['El representante legal seleccionado no existe.'],
            ]);
        }
    }

    private function validarNitDuplicado(?string $nit, ?int $idProponenteActual = null): void
    {
        if (empty($nit)) {
            return;
        }

        $query = Proponente::where('nit', $nit);

        if ($idProponenteActual !== null) {
            $query->where('id_proponente', '!=', $idProponenteActual);
        }

        if ($query->exists()) {
            throw ValidationException::withMessages([
                'nit' => ['El NIT ya está registrado en otra empresa.'],
            ]);
        }
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