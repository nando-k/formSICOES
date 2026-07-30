@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-5 rounded-xl shadow-sm border">
        <p class="text-sm text-slate-500">Empresas</p>
        <h3 id="totalEmpresas" class="text-2xl font-bold">...</h3>
    </div>

    <div class="bg-white p-5 rounded-xl shadow-sm border">
        <p class="text-sm text-slate-500">Entidades</p>
        <h3 id="totalEntidades" class="text-2xl font-bold">...</h3>
    </div>

    <div class="bg-white p-5 rounded-xl shadow-sm border">
        <p class="text-sm text-slate-500">Convocatorias</p>
        <h3 id="totalConvocatorias" class="text-2xl font-bold">...</h3>
    </div>

    <div class="bg-white p-5 rounded-xl shadow-sm border">
        <p class="text-sm text-slate-500">Documentos generados</p>
        <h3 id="totalDocumentos" class="text-2xl font-bold">...</h3>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border">
        <div class="px-5 py-4 border-b flex justify-between items-center">
            <div>
                <h3 class="font-semibold">Últimos documentos generados</h3>
                <p class="text-sm text-slate-500">Historial reciente de archivos Word generados.</p>
            </div>

            <a href="/documentos" class="text-sm text-blue-600 hover:underline">
                Ver historial
            </a>
        </div>

        <div id="loadingDocumentos" class="p-5 text-sm text-slate-500">
            Cargando documentos...
        </div>

        <div id="documentosContainer" class="hidden overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="text-left px-5 py-3">Archivo</th>
                        <th class="text-left px-5 py-3">Modelo</th>
                        <th class="text-left px-5 py-3">Convocatoria</th>
                        <th class="text-left px-5 py-3">Fecha</th>
                        <th class="text-left px-5 py-3">Acción</th>
                    </tr>
                </thead>
                <tbody id="documentosBody"></tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-5">
        <h3 class="font-semibold mb-4">Accesos rápidos</h3>

        <div class="space-y-3 text-sm">
            <a href="/empresas/create" class="block border rounded-lg px-4 py-3 hover:bg-slate-50">
                Registrar empresa
            </a>

            <a href="/entidades/create" class="block border rounded-lg px-4 py-3 hover:bg-slate-50">
                Registrar entidad
            </a>

            <a href="/convocatorias/create" class="block border rounded-lg px-4 py-3 hover:bg-slate-50">
                Nueva convocatoria
            </a>

            <a href="/formularios/generar" class="block border rounded-lg px-4 py-3 hover:bg-slate-50">
                Generar documento Word
            </a>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border">
    <div class="px-5 py-4 border-b flex justify-between items-center">
        <div>
            <h3 class="font-semibold">Últimas convocatorias</h3>
            <p class="text-sm text-slate-500">Convocatorias registradas recientemente.</p>
        </div>

        <a href="/convocatorias" class="text-sm text-blue-600 hover:underline">
            Ver convocatorias
        </a>
    </div>

    <div id="loadingConvocatorias" class="p-5 text-sm text-slate-500">
        Cargando convocatorias...
    </div>

    <div id="convocatoriasContainer" class="hidden overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500">
                <tr>
                    <th class="text-left px-5 py-3">Nro. Convocatoria</th>
                    <th class="text-left px-5 py-3">Entidad</th>
                    <th class="text-left px-5 py-3">Empresa</th>
                    <th class="text-left px-5 py-3">Objeto</th>
                    <th class="text-left px-5 py-3">Estado</th>
                    <th class="text-left px-5 py-3">Acción</th>
                </tr>
            </thead>
            <tbody id="convocatoriasBody"></tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const totalEmpresas = document.getElementById('totalEmpresas');
    const totalEntidades = document.getElementById('totalEntidades');
    const totalConvocatorias = document.getElementById('totalConvocatorias');
    const totalDocumentos = document.getElementById('totalDocumentos');

    const loadingDocumentos = document.getElementById('loadingDocumentos');
    const documentosContainer = document.getElementById('documentosContainer');
    const documentosBody = document.getElementById('documentosBody');

    const loadingConvocatorias = document.getElementById('loadingConvocatorias');
    const convocatoriasContainer = document.getElementById('convocatoriasContainer');
    const convocatoriasBody = document.getElementById('convocatoriasBody');

    async function obtenerDatos(url) {
        const response = await fetch(url);
        const data = await response.json();

        if (!response.ok) {
            console.error(data);
            throw new Error(data.message || `Error cargando ${url}`);
        }

        return Array.isArray(data) ? data : data.data ?? [];
    }

    try {
        const [empresas, entidades, convocatorias, documentos] = await Promise.all([
            obtenerDatos('/api/proponentes'),
            obtenerDatos('/api/entidades'),
            obtenerDatos('/api/convocatorias'),
            obtenerDatos('/api/documentos-generados'),
        ]);

        totalEmpresas.textContent = empresas.length;
        totalEntidades.textContent = entidades.length;
        totalConvocatorias.textContent = convocatorias.length;
        totalDocumentos.textContent = documentos.length;

        const ultimosDocumentos = documentos.slice(-5).reverse();

        loadingDocumentos.classList.add('hidden');
        documentosContainer.classList.remove('hidden');

        if (ultimosDocumentos.length === 0) {
            documentosBody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-5 py-6 text-center text-slate-500">
                        No hay documentos generados todavía.
                    </td>
                </tr>
            `;
        } else {
            documentosBody.innerHTML = ultimosDocumentos.map(documento => {
                const id = documento.id_documento_generado;
                const modelo = documento.documento_modelo?.nombre_modelo ?? 'Sin modelo';
                const convocatoria = documento.convocatoria?.numero_convocatoria ?? 'Sin convocatoria';

                return `
                    <tr class="border-t">
                        <td class="px-5 py-3 font-medium">
                            ${documento.nombre_archivo ?? 'Documento generado'}
                        </td>

                        <td class="px-5 py-3">
                            ${modelo}
                        </td>

                        <td class="px-5 py-3">
                            ${convocatoria}
                        </td>

                        <td class="px-5 py-3">
                            ${documento.fecha_generacion ?? '-'}
                        </td>

                        <td class="px-5 py-3 space-x-2">
                            <a href="/documentos/${id}" class="text-blue-600 hover:underline">
                                Ver
                            </a>

                            <a href="/documentos/${id}/descargar" class="text-green-600 hover:underline">
                                Descargar
                            </a>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        const ultimasConvocatorias = convocatorias.slice(-5).reverse();

        loadingConvocatorias.classList.add('hidden');
        convocatoriasContainer.classList.remove('hidden');

        if (ultimasConvocatorias.length === 0) {
            convocatoriasBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-5 py-6 text-center text-slate-500">
                        No hay convocatorias registradas todavía.
                    </td>
                </tr>
            `;
        } else {
            convocatoriasBody.innerHTML = ultimasConvocatorias.map(item => {
                const entidad = item.entidad?.nombre_entidad ?? 'Sin entidad';
                const empresa = item.proponente?.razon_social ?? item.proponente?.nombre_comercial ?? 'Sin empresa';
                const estado = item.estado ?? 'Sin estado';

                let estadoClase = 'bg-slate-100 text-slate-700';

                if (estado.toLowerCase() === 'borrador') {
                    estadoClase = 'bg-yellow-100 text-yellow-700';
                }

                if (estado.toLowerCase() === 'activa') {
                    estadoClase = 'bg-green-100 text-green-700';
                }

                if (estado.toLowerCase() === 'cerrada') {
                    estadoClase = 'bg-red-100 text-red-700';
                }

                return `
                    <tr class="border-t">
                        <td class="px-5 py-3 font-medium">
                            ${item.numero_convocatoria ?? 'Sin número'}
                        </td>

                        <td class="px-5 py-3">
                            ${entidad}
                        </td>

                        <td class="px-5 py-3">
                            ${empresa}
                        </td>

                        <td class="px-5 py-3 max-w-xs">
                            <span class="line-clamp-2">
                                ${item.objeto ?? 'Sin objeto'}
                            </span>
                        </td>

                        <td class="px-5 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium ${estadoClase}">
                                ${estado}
                            </span>
                        </td>

                        <td class="px-5 py-3">
                            <a href="/formularios/generar" class="text-green-600 hover:underline">
                                Generar
                            </a>
                        </td>
                    </tr>
                `;
            }).join('');
        }

    } catch (error) {
        console.error(error);

        totalEmpresas.textContent = '0';
        totalEntidades.textContent = '0';
        totalConvocatorias.textContent = '0';
        totalDocumentos.textContent = '0';

        loadingDocumentos.textContent = 'No se pudieron cargar los documentos.';
        loadingConvocatorias.textContent = 'No se pudieron cargar las convocatorias.';
    }
});
</script>
@endsection