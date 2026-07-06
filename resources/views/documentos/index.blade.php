@extends('layouts.app')

@section('title', 'Documentos generados')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Historial de documentos generados</h3>
        <p class="text-sm text-slate-500">
            Consulte los documentos generados por propuesta, entidad o fecha.
        </p>
    </div>

    <a href="/propuestas/generar" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
        Generar nuevo
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border p-5 mb-5">
    <h4 class="font-semibold mb-4">Filtros de búsqueda</h4>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Entidad</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Caja Nacional de Salud">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Convocatoria</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="CH LP - 085/2023">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Tipo de documento</label>
            <select class="w-full border rounded-lg px-3 py-2">
                <option>Todos</option>
                <option>Carta de presentación</option>
                <option>Declaración jurada</option>
                <option>Propuesta económica</option>
            </select>
        </div>

        <div class="flex items-end">
            <button class="w-full bg-slate-900 text-white px-4 py-2 rounded-lg hover:bg-slate-800">
                Buscar
            </button>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500">
            <tr>
                <th class="text-left px-5 py-3">Documento</th>
                <th class="text-left px-5 py-3">Propuesta</th>
                <th class="text-left px-5 py-3">Entidad</th>
                <th class="text-left px-5 py-3">Fecha generación</th>
                <th class="text-left px-5 py-3">Formato</th>
                <th class="text-left px-5 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t">
                <td class="px-5 py-3 font-medium">
                    Carta de presentación técnica
                </td>
                <td class="px-5 py-3">CH LP - 085/2023</td>
                <td class="px-5 py-3">Caja Nacional de Salud</td>
                <td class="px-5 py-3">30/06/2023 10:35</td>
                <td class="px-5 py-3">
                    <span class="px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                        DOCX
                    </span>
                </td>
                <td class="px-5 py-3 space-x-2">
                    <a href="/documentos/1" class="text-blue-600 hover:underline">Ver</a>
                    <a href="#" class="text-green-600 hover:underline">Descargar</a>
                </td>
            </tr>

            <tr class="border-t">
                <td class="px-5 py-3 font-medium">
                    Declaración jurada
                </td>
                <td class="px-5 py-3">CH LP - 085/2023</td>
                <td class="px-5 py-3">Caja Nacional de Salud</td>
                <td class="px-5 py-3">30/06/2023 10:36</td>
                <td class="px-5 py-3">
                    <span class="px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                        DOCX
                    </span>
                </td>
                <td class="px-5 py-3 space-x-2">
                    <a href="/documentos/1" class="text-blue-600 hover:underline">Ver</a>
                    <a href="#" class="text-green-600 hover:underline">Descargar</a>
                </td>
            </tr>

            <tr class="border-t">
                <td class="px-5 py-3 font-medium">
                    Carta de presentación económica
                </td>
                <td class="px-5 py-3">CH LP - 085/2023</td>
                <td class="px-5 py-3">Caja Nacional de Salud</td>
                <td class="px-5 py-3">30/06/2023 10:38</td>
                <td class="px-5 py-3">
                    <span class="px-2 py-1 rounded-full text-xs bg-red-100 text-red-700">
                        PDF
                    </span>
                </td>
                <td class="px-5 py-3 space-x-2">
                    <a href="/documentos/1" class="text-blue-600 hover:underline">Ver</a>
                    <a href="#" class="text-green-600 hover:underline">Descargar</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection