@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-5 rounded-xl shadow-sm border">
        <p class="text-sm text-slate-500">Empresas</p>
        <h3 class="text-2xl font-bold">1</h3>
    </div>

    <div class="bg-white p-5 rounded-xl shadow-sm border">
        <p class="text-sm text-slate-500">Convocatorias</p>
        <h3 class="text-2xl font-bold">4</h3>
    </div>

    <div class="bg-white p-5 rounded-xl shadow-sm border">
        <p class="text-sm text-slate-500">Propuestas</p>
        <h3 class="text-2xl font-bold">3</h3>
    </div>

    <div class="bg-white p-5 rounded-xl shadow-sm border">
        <p class="text-sm text-slate-500">Documentos generados</p>
        <h3 class="text-2xl font-bold">12</h3>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border">
    <div class="px-5 py-4 border-b">
        <h3 class="font-semibold">Últimas propuestas</h3>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500">
            <tr>
                <th class="text-left px-5 py-3">Convocatoria</th>
                <th class="text-left px-5 py-3">Empresa</th>
                <th class="text-left px-5 py-3">Estado</th>
                <th class="text-left px-5 py-3">Fecha</th>
                <th class="text-left px-5 py-3">Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t">
                <td class="px-5 py-3">CH LP - 085/2023</td>
                <td class="px-5 py-3">CIDSAF S.R.L.</td>
                <td class="px-5 py-3">
                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                        Borrador
                    </span>
                </td>
                <td class="px-5 py-3">30/06/2023</td>
                <td class="px-5 py-3">
                    <a href="/propuestas/generar" class="text-blue-600 hover:underline">
                        Generar
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection