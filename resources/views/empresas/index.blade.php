@extends('layouts.app')

@section('title', 'Empresas')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Empresas registradas</h3>
        <p class="text-sm text-slate-500">Datos cargados desde la API de proponentes.</p>
    </div>

    <a href="/empresas/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Nueva empresa
    </a>
</div>

<div id="loading" class="bg-white border rounded-xl p-6 text-slate-500">
    Cargando empresas...
</div>

<div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-xl p-5">
    No se pudieron cargar las empresas.
</div>

<div id="tablaContainer" class="hidden bg-white rounded-xl shadow-sm border overflow-hidden">
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
        <tbody id="empresasBody"></tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const tablaContainer = document.getElementById('tablaContainer');
    const empresasBody = document.getElementById('empresasBody');

    try {
        const response = await fetch('/api/proponentes');
        const data = await response.json();
        const empresas = Array.isArray(data) ? data : data.data ?? [];

        loading.classList.add('hidden');

        if (empresas.length === 0) {
            tablaContainer.classList.remove('hidden');
            empresasBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-5 py-6 text-center text-slate-500">
                        No hay empresas registradas.
                    </td>
                </tr>
            `;
            return;
        }

        tablaContainer.classList.remove('hidden');

        empresasBody.innerHTML = empresas.map(empresa => `
            <tr class="border-t">
                <td class="px-5 py-3 font-medium">${empresa.razon_social ?? '-'}</td>
                <td class="px-5 py-3">${empresa.nit ?? '-'}</td>
                <td class="px-5 py-3">${empresa.ciudad ?? '-'}</td>
                <td class="px-5 py-3">${empresa.telefono ?? '-'}</td>
                <td class="px-5 py-3">${empresa.correo ?? '-'}</td>
                <td class="px-5 py-3 space-x-2">
                    <a href="#" class="text-blue-600 hover:underline">Editar</a>
                    <a href="#" class="text-slate-600 hover:underline">Ver</a>
                </td>
            </tr>
        `).join('');

    } catch (e) {
        loading.classList.add('hidden');
        error.classList.remove('hidden');
        console.error(e);
    }
});
</script>
@endsection