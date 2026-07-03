@extends('layouts.app')

@section('title', 'Convocatorias')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Listado de convocatorias</h3>
        <p class="text-sm text-slate-500">Registre y administre las convocatorias disponibles.</p>
    </div>

    <a href="/convocatorias/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Nueva convocatoria
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500">
            <tr>
                <th class="text-left px-5 py-3">Entidad</th>
                <th class="text-left px-5 py-3">Nro. Convocatoria</th>
                <th class="text-left px-5 py-3">CUCE</th>
                <th class="text-left px-5 py-3">Fecha apertura</th>
                <th class="text-left px-5 py-3">Plazo</th>
                <th class="text-left px-5 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t">
                <td class="px-5 py-3">Caja Nacional de Salud</td>
                <td class="px-5 py-3">CH LP - 085/2023</td>
                <td class="px-5 py-3">23-1404-00-1345364-1-1</td>
                <td class="px-5 py-3">11/07/2023</td>
                <td class="px-5 py-3">60 días</td>
                <td class="px-5 py-3 space-x-2">
                    <a href="#" class="text-blue-600 hover:underline">Editar</a>
                    <a href="/propuestas/create" class="text-green-600 hover:underline">Crear propuesta</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection