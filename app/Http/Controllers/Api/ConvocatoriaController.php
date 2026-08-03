<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Convocatoria;
use Illuminate\Http\Request;

class ConvocatoriaController extends Controller
{
    public function index()
    {
        return Convocatoria::with('entidad', 'proponente')->get();
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

        $validated = $this->normalizarDatos($validated);

        return Convocatoria::create($validated);
    }

    public function show(Convocatoria $convocatoria)
    {
        return $convocatoria->load(
            'entidad',
            'proponente',
            'proponente.personal',
            'personas',
            'documentosGenerados'
        );
    }

    public function update(Request $request, Convocatoria $convocatoria)
    {
        $validated = $request->validate([
            'id_entidad' => 'required|integer',
            'id_proponente' => 'required|integer',
            'cite' => 'nullable|string|max:100',
            'numero_convocatoria' => 'sometimes|string|max:150',
            'cuce' => 'nullable|string|max:100',
            'objeto' => 'sometimes|string',
            'lugar_entrega' => 'nullable|string',
            'fecha_presentacion' => 'nullable|date',
            'hora_apertura' => 'nullable',
            'fecha_apertura' => 'nullable|date',
            'monto' => 'nullable|numeric',
            'monto_literal' => 'nullable|string|max:255',
            'plazo_propuesta_dias' => 'nullable|integer',
            'estado' => 'nullable|string|max:50',
        ]);

        $validated = $this->normalizarDatos($validated);

        $convocatoria->update($validated);

        return $convocatoria;
    }

    public function destroy(Convocatoria $convocatoria)
    {
        $convocatoria->delete();

        return response()->noContent();
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