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
            'id_entidad' => 'required|exists:contratacion.entidades,id_entidad',       // ← CAMBIAR
            'id_proponente' => 'required|exists:contratacion.proponentes,id_proponente', // ← CAMBIAR
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

        return Convocatoria::create($validated);
    }

    public function show(Convocatoria $convocatoria)
    {
        return $convocatoria->load('entidad', 'proponente', 'documentosGenerados');
    }

    public function update(Request $request, Convocatoria $convocatoria)
    {
        $validated = $request->validate([
            'id_entidad' => 'sometimes|exists:contratacion.entidades,id_entidad',       // ← CAMBIAR
            'id_proponente' => 'sometimes|exists:contratacion.proponentes,id_proponente', // ← CAMBIAR
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

        $convocatoria->update($validated);
        return $convocatoria;
    }

    public function destroy(Convocatoria $convocatoria)
    {
        $convocatoria->delete();
        return response()->noContent();
    }
}