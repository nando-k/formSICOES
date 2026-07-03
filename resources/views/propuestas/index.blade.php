@extends('layouts.app')

@section('title', 'Propuestas')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Listado de propuestas</h3>
        <p class="text-sm text-slate-500">Administre las propuestas registradas.</p>
    </div>

    <a href="/propuestas/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Nueva propuesta
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500">
            <tr>
                <th class="text-left px-5 py-3">Empresa</th>
                <th class="text-left px-5 py-3">Convocatoria</th>
                <th class="text-left px-5 py-3">Monto</th>
                <th class="text-left px-5 py-3">Estado</th>
                <th class="text-left px-5 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t">
                <td class="px-5 py-3">CIDSAF S.R.L.</td>
                <td class="px-5 py-3">CH LP - 085/2023</td>
                <td class="px-5 py-3">Bs. 41.500</td>
                <td class="px-5 py-3">
                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                        Borrador
                    </span>
                </td>
                <td class="px-5 py-3">
                    <a href="/propuestas/generar" class="text-green-600 hover:underline">
                        Generar documentos
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
