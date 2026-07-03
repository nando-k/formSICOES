@extends('layouts.app')

@section('title', 'Nueva propuesta')

@section('content')
<div class="bg-white rounded-xl shadow-sm border p-6 max-w-5xl">
    <h3 class="text-lg font-semibold mb-1">Datos de la propuesta</h3>
    <p class="text-sm text-slate-500 mb-6">Seleccione la empresa, convocatoria y personal asociado.</p>

    <form class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium mb-1">Empresa</label>
            <select class="w-full border rounded-lg px-3 py-2">
                <option>CIDSAF S.R.L.</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Convocatoria</label>
            <select class="w-full border rounded-lg px-3 py-2">
                <option>CH LP - 085/2023 - Caja Nacional de Salud</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Representante legal</label>
            <select class="w-full border rounded-lg px-3 py-2">
                <option>Sandra Irene Rodríguez Callisaya</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Fecha de presentación</label>
            <input type="date" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Monto Bs.</label>
            <input type="number" class="w-full border rounded-lg px-3 py-2" placeholder="41500">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Monto en letras</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Cuarenta y un mil quinientos 00/100 bolivianos">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Estado</label>
            <select class="w-full border rounded-lg px-3 py-2">
                <option>Borrador</option>
                <option>En revisión</option>
                <option>Finalizada</option>
            </select>
        </div>

        <div class="md:col-span-2 mt-4">
            <div class="flex justify-between items-center mb-3">
                <h4 class="font-semibold">Personal asignado</h4>
                <button type="button" class="px-3 py-2 rounded-lg bg-slate-800 text-white text-sm">
                    Agregar personal
                </button>
            </div>

            <div class="border rounded-lg overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th class="text-left px-4 py-3">Nombre</th>
                            <th class="text-left px-4 py-3">CI</th>
                            <th class="text-left px-4 py-3">Cargo en propuesta</th>
                            <th class="text-left px-4 py-3">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-4 py-3">Sandra Irene Rodríguez Callisaya</td>
                            <td class="px-4 py-3">4791992 LP</td>
                            <td class="px-4 py-3">Representante Legal</td>
                            <td class="px-4 py-3">
                                <a href="#" class="text-red-600 hover:underline">Quitar</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="md:col-span-2 flex justify-end gap-3 pt-4">
            <a href="/propuestas" class="px-4 py-2 rounded-lg border">
                Cancelar
            </a>
            <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Guardar propuesta
            </button>
            <a href="/propuestas/generar" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Generar documentos
            </a>
        </div>
    </form>
</div>
@endsection