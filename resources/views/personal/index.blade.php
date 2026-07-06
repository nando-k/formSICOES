@extends('layouts.app')

@section('title', 'Personal')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Personal registrado</h3>
        <p class="text-sm text-slate-500">
            Administre representantes legales, socios, auditores y especialistas.
        </p>
    </div>

    <a href="/personal/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Nuevo personal
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500">
            <tr>
                <th class="text-left px-5 py-3">Nombre completo</th>
                <th class="text-left px-5 py-3">CI</th>
                <th class="text-left px-5 py-3">Cargo</th>
                <th class="text-left px-5 py-3">Teléfono</th>
                <th class="text-left px-5 py-3">Correo</th>
                <th class="text-left px-5 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t">
                <td class="px-5 py-3 font-medium">Sandra Irene Rodríguez Callisaya</td>
                <td class="px-5 py-3">4791992 LP</td>
                <td class="px-5 py-3">Representante Legal</td>
                <td class="px-5 py-3">73008644</td>
                <td class="px-5 py-3">-</td>
                <td class="px-5 py-3 space-x-2">
                    <a href="#" class="text-blue-600 hover:underline">Editar</a>
                    <a href="#" class="text-slate-600 hover:underline">Ver</a>
                </td>
            </tr>

            <tr class="border-t">
                <td class="px-5 py-3 font-medium">Susy Janet Mollericona Choque</td>
                <td class="px-5 py-3">9981466 LP</td>
                <td class="px-5 py-3">Socia de la firma</td>
                <td class="px-5 py-3">-</td>
                <td class="px-5 py-3">-</td>
                <td class="px-5 py-3 space-x-2">
                    <a href="#" class="text-blue-600 hover:underline">Editar</a>
                    <a href="#" class="text-slate-600 hover:underline">Ver</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection