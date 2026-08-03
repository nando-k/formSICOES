<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index()
    {
        return Persona::all();
    }

    public function store(Request $request)
    {
        $this->mapearExpedido($request);

        $validated = $request->validate([
            'nombres' => 'required|string|max:150',
            'apellido_paterno' => 'nullable|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'ci' => 'required|string|max:30',
            'ci_expedido' => 'nullable|string|max:10',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:100',
            'correo' => 'nullable|email|max:150',
            'profesion' => 'nullable|string|max:150',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $validated = $this->normalizarDatos($validated);

        return Persona::create($validated);
    }

    public function show(Persona $persona)
    {
        return $persona->load('proponentesRepresentados');
    }

    public function update(Request $request, Persona $persona)
    {
        $this->mapearExpedido($request);

        $validated = $request->validate([
            'nombres' => 'sometimes|string|max:150',
            'apellido_paterno' => 'nullable|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'ci' => 'sometimes|string|max:30',
            'ci_expedido' => 'nullable|string|max:10',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:100',
            'correo' => 'nullable|email|max:150',
            'profesion' => 'nullable|string|max:150',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $validated = $this->normalizarDatos($validated);

        $persona->update($validated);

        return $persona;
    }

    public function destroy(Persona $persona)
    {
        $persona->delete();

        return response()->noContent();
    }

    private function mapearExpedido(Request $request): void
    {
        if ($request->filled('expedido') && !$request->filled('ci_expedido')) {
            $request->merge([
                'ci_expedido' => $request->input('expedido'),
            ]);
        }
    }

    private function normalizarDatos(array $datos): array
    {
        $camposMayusculas = [
            'nombres',
            'apellido_paterno',
            'apellido_materno',
            'ci',
            'ci_expedido',
            'direccion',
            'telefono',
            'profesion',
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