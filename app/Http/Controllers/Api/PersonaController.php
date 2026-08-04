<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PersonaController extends Controller
{
    public function index()
    {
        return Persona::orderBy('id_persona')->get();
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

        $this->validarCiDuplicado($validated['ci'] ?? null);

        return Persona::create($validated);
    }

    public function importarCsv(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:csv,txt|max:4096',
        ]);

        $archivo = $request->file('archivo');
        $ruta = $archivo->getRealPath();

        $handle = fopen($ruta, 'r');

        if (!$handle) {
            throw ValidationException::withMessages([
                'archivo' => ['No se pudo leer el archivo.'],
            ]);
        }

        $primeraLinea = fgets($handle);

        if (!$primeraLinea) {
            fclose($handle);

            throw ValidationException::withMessages([
                'archivo' => ['El archivo está vacío o no tiene encabezados.'],
            ]);
        }

        $primeraLinea = preg_replace('/^\xEF\xBB\xBF/', '', $primeraLinea);
        $primeraLinea = str_replace("\u{FEFF}", '', $primeraLinea);

        $separadores = [
            ';' => substr_count($primeraLinea, ';'),
            ',' => substr_count($primeraLinea, ','),
            "\t" => substr_count($primeraLinea, "\t"),
        ];

        arsort($separadores);

        $separador = array_key_first($separadores);

        if ($separadores[$separador] === 0) {
            fclose($handle);

            throw ValidationException::withMessages([
                'archivo' => ['No se pudo detectar el separador del archivo. Use CSV separado por punto y coma.'],
            ]);
        }

        $encabezados = str_getcsv($primeraLinea, $separador);

        $encabezados = array_map(function ($valor) {
            $valor = trim((string) $valor);
            $valor = preg_replace('/^\xEF\xBB\xBF/', '', $valor);
            $valor = str_replace("\u{FEFF}", '', $valor);
            $valor = trim($valor, "\"' ");

            return mb_strtolower($valor, 'UTF-8');
        }, $encabezados);

        $columnasRequeridas = [
            'nombres',
            'ci',
        ];

        foreach ($columnasRequeridas as $columna) {
            if (!in_array($columna, $encabezados)) {
                fclose($handle);

                throw ValidationException::withMessages([
                    'archivo' => [
                        "Falta la columna obligatoria: {$columna}. Encabezados detectados: " . implode(' | ', $encabezados),
                    ],
                ]);
            }
        }

        $creados = 0;
        $omitidos = 0;
        $errores = [];
        $filaNumero = 1;

        while (($linea = fgets($handle)) !== false) {
            $filaNumero++;

            $fila = str_getcsv($linea, $separador);

            if ($this->filaVacia($fila)) {
                continue;
            }

            $datosFila = [];

            foreach ($encabezados as $index => $encabezado) {
                $datosFila[$encabezado] = $fila[$index] ?? null;
            }

            $datos = [
                'nombres' => $datosFila['nombres'] ?? null,
                'apellido_paterno' => $datosFila['apellido_paterno'] ?? null,
                'apellido_materno' => $datosFila['apellido_materno'] ?? null,
                'ci' => $datosFila['ci'] ?? null,
                'ci_expedido' => $datosFila['ci_expedido'] ?? ($datosFila['expedido'] ?? null),
                'direccion' => $datosFila['direccion'] ?? null,
                'telefono' => $datosFila['telefono'] ?? null,
                'correo' => $datosFila['correo'] ?? null,
                'profesion' => $datosFila['profesion'] ?? null,
                'fecha_nacimiento' => $datosFila['fecha_nacimiento'] ?? null,
            ];

            $datos = $this->limpiarDatos($datos);

            if (empty($datos['nombres']) || empty($datos['ci'])) {
                $omitidos++;
                $errores[] = "Fila {$filaNumero}: faltan nombres o CI.";
                continue;
            }

            $datos = $this->normalizarDatos($datos);

            if (Persona::where('ci', $datos['ci'])->exists()) {
                $omitidos++;
                $errores[] = "Fila {$filaNumero}: CI {$datos['ci']} ya existe.";
                continue;
            }

            try {
                Persona::create($datos);
                $creados++;
            } catch (\Throwable $e) {
                $omitidos++;
                $errores[] = "Fila {$filaNumero}: no se pudo importar. " . $e->getMessage();
            }
        }

        fclose($handle);

        return response()->json([
            'message' => 'Importación finalizada.',
            'creados' => $creados,
            'omitidos' => $omitidos,
            'errores' => $errores,
        ]);
    }

    public function show($id)
    {
        $persona = Persona::where('id_persona', $id)->firstOrFail();

        return $persona->load('proponentesRepresentados', 'proponentes');
    }

    public function update(Request $request, $id)
    {
        $persona = Persona::where('id_persona', $id)->firstOrFail();

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

        $this->validarCiDuplicado(
            $validated['ci'] ?? null,
            $persona->id_persona
        );

        $persona->update($validated);

        return $persona;
    }

    public function destroy($id)
    {
        $persona = Persona::where('id_persona', $id)->firstOrFail();

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

    private function validarCiDuplicado(?string $ci, ?int $idPersonaActual = null): void
    {
        if (empty($ci)) {
            return;
        }

        $query = Persona::where('ci', mb_strtoupper(trim($ci), 'UTF-8'));

        if ($idPersonaActual !== null) {
            $query->where('id_persona', '!=', $idPersonaActual);
        }

        if ($query->exists()) {
            throw ValidationException::withMessages([
                'ci' => ['El CI ya está registrado en otra persona.'],
            ]);
        }
    }

    private function limpiarDatos(array $datos): array
    {
        foreach ($datos as $campo => $valor) {
            if ($valor === null) {
                continue;
            }

            $valor = trim($valor);

            $datos[$campo] = $valor === '' ? null : $valor;
        }

        return $datos;
    }

    private function filaVacia(array $fila): bool
    {
        foreach ($fila as $valor) {
            if (trim((string) $valor) !== '') {
                return false;
            }
        }

        return true;
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