@extends('layouts.app')

@section('title', 'Empresas')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-950 via-slate-900 to-cyan-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-cyan-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-cyan-300 text-sm font-medium mb-2">
                    Proponentes registrados
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Empresas
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Administre los datos de las empresas o proponentes que participarán en las convocatorias.
                </p>
            </div>

            <a href="/empresas/create" class="bg-cyan-500 text-white px-5 py-3 rounded-2xl hover:bg-cyan-400 shadow-lg shadow-cyan-950/30 font-semibold text-center">
                Nueva empresa
            </a>
        </div>
    </div>

    <div id="loading" class="bg-white border border-slate-200 rounded-3xl p-6 text-slate-500 shadow-sm">
        Cargando empresas...
    </div>

    <div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5">
        No se pudieron cargar las empresas.
    </div>

    <div id="tablaContainer" class="hidden bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h4 class="font-bold text-slate-900">Listado de empresas</h4>
                <p class="text-sm text-slate-500">Datos cargados desde la API de proponentes.</p>
            </div>

            <span id="totalEmpresas" class="text-sm bg-blue-50 text-blue-700 px-3 py-1 rounded-full font-medium">
                0 registros
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="text-left px-6 py-4">Empresa</th>
                        <th class="text-left px-6 py-4">NIT</th>
                        <th class="text-left px-6 py-4">Ciudad</th>
                        <th class="text-left px-6 py-4">Representante legal</th>
                        <th class="text-left px-6 py-4">Teléfono</th>
                        <th class="text-left px-6 py-4">Correo</th>
                    </tr>
                </thead>

                <tbody id="empresasBody"></tbody>
            </table>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const tablaContainer = document.getElementById('tablaContainer');
    const empresasBody = document.getElementById('empresasBody');
    const totalEmpresas = document.getElementById('totalEmpresas');

    try {
        const response = await fetch('/api/proponentes');
        const data = await response.json();

        if (!response.ok) {
            console.error(data);
            throw new Error(data.message || 'No se pudieron cargar las empresas.');
        }

        const empresas = Array.isArray(data) ? data : data.data ?? [];

        loading.classList.add('hidden');
        tablaContainer.classList.remove('hidden');

        totalEmpresas.textContent = `${empresas.length} registro${empresas.length === 1 ? '' : 's'}`;

        if (empresas.length === 0) {
            empresasBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                        No hay empresas registradas todavía.
                    </td>
                </tr>
            `;
            return;
        }

        empresasBody.innerHTML = empresas.map(empresa => {
            const nombre = empresa.razon_social ?? empresa.nombre_comercial ?? 'Empresa sin nombre';
            const inicial = nombre.trim().charAt(0).toUpperCase();

            const representanteLegal = empresa.representante_legal
                ? [
                    empresa.representante_legal.nombres,
                    empresa.representante_legal.apellido_paterno,
                    empresa.representante_legal.apellido_materno
                ].filter(Boolean).join(' ')
                : 'Sin representante';

            return `
                <tr class="border-t border-slate-100 hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center font-bold">
                                ${inicial}
                            </div>

                            <div>
                                <p class="font-semibold text-slate-900">
                                    ${nombre}
                                </p>

                                <p class="text-xs text-slate-500">
                                    ${empresa.nombre_comercial ?? 'Sin nombre comercial'}
                                </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        ${empresa.nit ?? '-'}
                    </td>

                    <td class="px-6 py-4">
                        ${empresa.ciudad ?? '-'}
                    </td>

                    <td class="px-6 py-4">
                        ${representanteLegal}
                    </td>

                    <td class="px-6 py-4">
                        ${empresa.telefono ?? '-'}
                    </td>

                    <td class="px-6 py-4">
                        ${empresa.correo ?? '-'}
                    </td>
                </tr>
            `;
        }).join('');

    } catch (e) {
        loading.classList.add('hidden');
        error.classList.remove('hidden');
        console.error(e);
    }
});
</script>
@endsection