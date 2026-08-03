<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Convocatoria;
use App\Models\ConvocatoriaPersonal;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ConvocatoriaPersonalController extends Controller
{
    public function index()
    {
        return ConvocatoriaPersonal::with('convocatoria', 'persona', 'cargo')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_convocatoria' => 'required|integer',
            'id_persona' => 'required|integer',
            'id_cargo' => 'nullable|integer',
            'es_firmante' => 'nullable|boolean',
            'orden_firma' => 'nullable|integer',
            'activo' => 'nullable|boolean',
        ]);

        $this->validarRelaciones($validated);

        $existeAsignacion = ConvocatoriaPersonal::where('id_convocatoria', $validated['id_convocatoria'])
            ->where('id_persona', $validated['id_persona'])
            ->exists();

        if ($existeAsignacion) {
            throw ValidationException::withMessages([
                'id_persona' => ['Esta persona ya está asignada a esta convocatoria.'],
            ]);
        }

        return ConvocatoriaPersonal::create($validated)->load('persona', 'cargo');
    }

    public function show(ConvocatoriaPersonal $convocatoriaPersonal)
    {
        return $convocatoriaPersonal->load('convocatoria', 'persona', 'cargo');
    }

    public function update(Request $request, ConvocatoriaPersonal $convocatoriaPersonal)
    {
        $validated = $request->validate([
            'id_convocatoria' => 'sometimes|integer',
            'id_persona' => 'sometimes|integer',
            'id_cargo' => 'nullable|integer',
            'es_firmante' => 'nullable|boolean',
            'orden_firma' => 'nullable|integer',
            'activo' => 'nullable|boolean',
        ]);

        $datosCompletos = array_merge(
            $convocatoriaPersonal->toArray(),
            $validated
        );

        $this->validarRelaciones($datosCompletos);

        $convocatoriaPersonal->update($validated);

        return $convocatoriaPersonal->load('persona', 'cargo');
    }

    public function destroy(ConvocatoriaPersonal $convocatoriaPersonal)
    {
        $convocatoriaPersonal->delete();

        return response()->noContent();
    }

    private function validarRelaciones(array $datos): void
    {
        if (!Convocatoria::where('id_convocatoria', $datos['id_convocatoria'])->exists()) {
            throw ValidationException::withMessages([
                'id_convocatoria' => ['La convocatoria seleccionada no existe.'],
            ]);
        }

        if (!Persona::where('id_persona', $datos['id_persona'])->exists()) {
            throw ValidationException::withMessages([
                'id_persona' => ['La persona seleccionada no existe.'],
            ]);
        }

        if (!empty($datos['id_cargo']) && !Cargo::where('id_cargo', $datos['id_cargo'])->exists()) {
            throw ValidationException::withMessages([
                'id_cargo' => ['El cargo seleccionado no existe.'],
            ]);
        }
    }
}