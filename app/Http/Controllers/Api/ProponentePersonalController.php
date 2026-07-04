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
            'id_proponente' => 'required|exists:proponentes,id_proponente',
            'id_persona' => 'required|exists:personas,id_persona',
            'id_cargo' => 'required|exists:cargos,id_cargo',
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
            'id_proponente' => 'sometimes|exists:proponentes,id_proponente',
            'id_persona' => 'sometimes|exists:personas,id_persona',
            'id_cargo' => 'sometimes|exists:cargos,id_cargo',
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