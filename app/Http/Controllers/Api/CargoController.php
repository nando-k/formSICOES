<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index()
    {
        return Cargo::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_cargo' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
        ]);

        return Cargo::create($validated);
    }

    public function show(Cargo $cargo)
    {
        return $cargo;
    }

    public function update(Request $request, Cargo $cargo)
    {
        $validated = $request->validate([
            'nombre_cargo' => 'sometimes|string|max:150',
            'descripcion' => 'nullable|string',
        ]);

        $cargo->update($validated);
        return $cargo;
    }

    public function destroy(Cargo $cargo)
    {
        $cargo->delete();
        return response()->noContent();
    }
}