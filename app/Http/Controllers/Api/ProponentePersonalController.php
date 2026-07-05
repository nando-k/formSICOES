<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProponentePersonal;
use Illuminate\Http\Request;

class ProponentePersonalController extends Controller
{
    public function index()
    {
        return ProponentePersonal::with('proponente', 'persona', 'cargo')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_proponente' => 'required|exists:contratacion.proponentes,id_proponente', // ← CAMBIAR
            'id_persona' => 'required|exists:persona.personas,id_persona',               // ← CAMBIAR
            'id_cargo' => 'required|exists:contratacion.cargos,id_cargo',                 // ← CAMBIAR
            'es_firmante' => 'nullable|boolean',
            'orden_firma' => 'nullable|integer',
            'activo' => 'nullable|boolean',
        ]);

        return ProponentePersonal::create($validated);
    }

    public function show(ProponentePersonal $proponentePersonal)
    {
        return $proponentePersonal->load('proponente', 'persona', 'cargo');
    }

    public function update(Request $request, ProponentePersonal $proponentePersonal)
    {
        $validated = $request->validate([
            'id_proponente' => 'sometimes|exists:contratacion.proponentes,id_proponente', // ← CAMBIAR
            'id_persona' => 'sometimes|exists:persona.personas,id_persona',               // ← CAMBIAR
            'id_cargo' => 'sometimes|exists:contratacion.cargos,id_cargo',                 // ← CAMBIAR
            'es_firmante' => 'nullable|boolean',
            'orden_firma' => 'nullable|integer',
            'activo' => 'nullable|boolean',
        ]);

        $proponentePersonal->update($validated);
        return $proponentePersonal;
    }

    public function destroy(ProponentePersonal $proponentePersonal)
    {
        $proponentePersonal->delete();
        return response()->noContent();
    }
}