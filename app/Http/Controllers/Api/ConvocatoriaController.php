<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Convocatoria;
use App\Models\Entidad;
use App\Models\Proponente;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ConvocatoriaController extends Controller
{
    public function index()
    {
        return Convocatoria::with('entidad', 'proponente')
            ->orderBy('id_convocatoria')
            ->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_entidad' => 'required|integer',
            'id_proponente' => 'required|integer',
            'cite' => 'nullable|string|max:100',
            'numero_convocatoria' => 'required|string|max:150',
            'cuce' => 'nullable|string|max:100',
            'objeto' => 'required|string',
            'lugar_entrega' => 'nullable|string',
            'fecha_presentacion' => 'nullable|date',
            'hora_apertura' => 'nullable',
            'fecha_apertura' => 'nullable|date',
            'monto' => 'nullable|numeric',
            'monto_literal' => 'nullable|string|max:255',
            'plazo_propuesta_dias' => 'nullable|integer',
            'estado' => 'nullable|string|max:50',
        ]);

        $this->validarRelaciones($validated);

        $validated = $this->normalizarDatos($validated);

        return Convocatoria::create($validated)->load('entidad', 'proponente');
    }

    public function show($id)
    {
        $convocatoria = Convocatoria::where('id_convocatoria', $id)->firstOrFail();

        return $convocatoria->load(
            'entidad',
            'proponente',
            'proponente.personal',
            'personas',
            'documentosGenerados'
        );
    }

    public function update(Request $request, $id)
    {
        $convocatoria = Convocatoria::where('id_convocatoria', $id)->firstOrFail();

        $validated = $request->validate([
            'id_entidad' => 'required|integer',
            'id_proponente' => 'required|integer',
            'cite' => 'nullable|string|max:100',
            'numero_convocatoria' => 'required|string|max:150',
            'cuce' => 'nullable|string|max:100',
            'objeto' => 'required|string',
            'lugar_entrega' => 'nullable|string',
            'fecha_presentacion' => 'nullable|date',
            'hora_apertura' => 'nullable',
            'fecha_apertura' => 'nullable|date',
            'monto' => 'nullable|numeric',
            'monto_literal' => 'nullable|string|max:255',
            'plazo_propuesta_dias' => 'nullable|integer',
            'estado' => 'nullable|string|max:50',
        ]);

        $this->validarRelaciones($validated);

        $validated = $this->normalizarDatos($validated);

        $convocatoria->update($validated);

        return $convocatoria->load('entidad', 'proponente');
    }

    public function destroy($id)
    {
        $convocatoria = Convocatoria::where('id_convocatoria', $id)->firstOrFail();

        $convocatoria->delete();

        return response()->noContent();
    }

    private function validarRelaciones(array $datos): void
    {
        if (!Entidad::where('id_entidad', $datos['id_entidad'])->exists()) {
            throw ValidationException::withMessages([
                'id_entidad' => ['La entidad seleccionada no existe.'],
            ]);
        }

        if (!Proponente::where('id_proponente', $datos['id_proponente'])->exists()) {
            throw ValidationException::withMessages([
                'id_proponente' => ['La empresa seleccionada no existe.'],
            ]);
        }
    }

    private function normalizarDatos(array $datos): array
    {
        $camposMayusculas = [
            'cite',
            'numero_convocatoria',
            'cuce',
            'objeto',
            'lugar_entrega',
            'monto_literal',
            'estado',
        ];

        foreach ($camposMayusculas as $campo) {
            if (array_key_exists($campo, $datos) && $datos[$campo] !== null) {
                $datos[$campo] = mb_strtoupper(trim($datos[$campo]), 'UTF-8');
            }
        }

        return $datos;
    }
}