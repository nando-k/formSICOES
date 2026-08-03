<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Persona;
use App\Models\Proponente;
use App\Models\ProponentePersonal;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProponentePersonalController extends Controller
{
    public function index()
    {
        return ProponentePersonal::with('proponente', 'persona', 'cargo')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_proponente' => 'required|integer',
            'id_persona' => 'required|integer',
            'id_cargo' => 'required|integer',
            'es_firmante' => 'nullable|boolean',
            'orden_firma' => 'nullable|integer',
            'activo' => 'nullable|boolean',
        ]);

        $this->validarRelaciones($validated);

        $existeAsignacion = ProponentePersonal::where('id_proponente', $validated['id_proponente'])
            ->where('id_persona', $validated['id_persona'])
            ->exists();

        if ($existeAsignacion) {
            throw ValidationException::withMessages([
                'id_persona' => ['Esta persona ya está asignada a esta empresa.'],
            ]);
        }

        return ProponentePersonal::create($validated);
    }

    public function show(ProponentePersonal $proponentePersonal)
    {
        return $proponentePersonal->load('proponente', 'persona', 'cargo');
    }

    public function update(Request $request, ProponentePersonal $proponentePersonal)
    {
        $validated = $request->validate([
            'id_proponente' => 'sometimes|integer',
            'id_persona' => 'sometimes|integer',
            'id_cargo' => 'sometimes|integer',
            'es_firmante' => 'nullable|boolean',
            'orden_firma' => 'nullable|integer',
            'activo' => 'nullable|boolean',
        ]);

        $datosCompletos = array_merge(
            $proponentePersonal->toArray(),
            $validated
        );

        $this->validarRelaciones($datosCompletos);

        if (isset($validated['id_proponente']) || isset($validated['id_persona'])) {
            $existeAsignacion = ProponentePersonal::where('id_proponente', $datosCompletos['id_proponente'])
                ->where('id_persona', $datosCompletos['id_persona'])
                ->where('id_proponente_personal', '!=', $proponentePersonal->id_proponente_personal)
                ->exists();

            if ($existeAsignacion) {
                throw ValidationException::withMessages([
                    'id_persona' => ['Esta persona ya está asignada a esta empresa.'],
                ]);
            }
        }

        $proponentePersonal->update($validated);

        return $proponentePersonal;
    }

    public function destroy(ProponentePersonal $proponentePersonal)
    {
        $proponentePersonal->delete();

        return response()->noContent();
    }

    private function validarRelaciones(array $datos): void
    {
        if (!Proponente::where('id_proponente', $datos['id_proponente'])->exists()) {
            throw ValidationException::withMessages([
                'id_proponente' => ['La empresa seleccionada no existe.'],
            ]);
        }

        if (!Persona::where('id_persona', $datos['id_persona'])->exists()) {
            throw ValidationException::withMessages([
                'id_persona' => ['La persona seleccionada no existe.'],
            ]);
        }

        if (!Cargo::where('id_cargo', $datos['id_cargo'])->exists()) {
            throw ValidationException::withMessages([
                'id_cargo' => ['El cargo seleccionado no existe.'],
            ]);
        }
    }
}