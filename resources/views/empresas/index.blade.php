@extends('layouts.app')

@section('title', 'Empresas')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Empresas registradas</h3>
        <p class="text-sm text-slate-500">Administre los datos de los proponentes o empresas auditoras.</p>
    </div>

    <a href="/empresas/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Nueva empresa
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500">
            <tr>
                <th class="text-left px-5 py-3">Razón social</th>
                <th class="text-left px-5 py-3">NIT</th>
                <th class="text-left px-5 py-3">Ciudad</th>
                <th class="text-left px-5 py-3">Teléfono</th>
                <th class="text-left px-5 py-3">Correo</th>
                <th class="text-left px-5 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t">
                <td class="px-5 py-3 font-medium">
                    CIDSAF S.R.L.
                </td>
                <td class="px-5 py-3">406312025</td>
                <td class="px-5 py-3">La Paz</td>
                <td class="px-5 py-3">2243214 - 73008644</td>
                <td class="px-5 py-3">cidsaf.srl@gmail.com</td>
                <td class="px-5 py-3 space-x-2">
                    <a href="#" class="text-blue-600 hover:underline">Editar</a>
                    <a href="#" class="text-slate-600 hover:underline">Ver</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection