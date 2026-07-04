<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlantillaCampo;
use Illuminate\Http\Request;

class PlantillaCampoController extends Controller
{
    public function index()
    {
        return PlantillaCampo::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_campo' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'tabla_origen' => 'required|string|max:100',
            'campo_origen' => 'required|string|max:100',
        ]);

        return PlantillaCampo::create($validated);
    }

    public function show(PlantillaCampo $plantillaCampo)
    {
        return $plantillaCampo;
    }

    public function update(Request $request, PlantillaCampo $plantillaCampo)
    {
        $validated = $request->validate([
            'nombre_campo' => 'sometimes|string|max:100',
            'descripcion' => 'nullable|string',
            'tabla_origen' => 'sometimes|string|max:100',
            'campo_origen' => 'sometimes|string|max:100',
        ]);

        $plantillaCampo->update($validated);
        return $plantillaCampo;
    }

    public function destroy(PlantillaCampo $plantillaCampo)
    {
        $plantillaCampo->delete();
        return response()->noContent();
    }
}