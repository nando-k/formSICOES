@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">

    <!-- Hero -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-emerald-900 p-8 shadow-xl">
        <div class="absolute -right-20 -top-20 w-72 h-72 rounded-full bg-emerald-400/20 blur-3xl"></div>
        <div class="absolute right-32 bottom-0 w-40 h-40 rounded-full bg-cyan-400/10 blur-2xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <p class="text-emerald-300 text-sm font-medium mb-2">
                    Sistema operativo
                </p>

                <h3 class="text-3xl font-bold text-white mb-3">
                    Gestión documental de propuestas
                </h3>

                <p class="text-slate-300 max-w-2xl">
                    Administra empresas, entidades, convocatorias y documentos Word generados automáticamente desde plantillas.
                </p>
            </div>

            <div class="flex gap-3">
                <a href="/formularios/generar" class="bg-emerald-500 text-white px-5 py-3 rounded-2xl hover:bg-emerald-400 shadow-lg shadow-emerald-950/30 font-semibold">
                    Generar Word
                </a>

                <a href="/documentos" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10">
                    Ver historial
                </a>
            </div>
        </div>
    </div>

    <!-- Cards resumen -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
        <div class="group bg-white p-6 rounded-3xl shadow-sm border border-slate-200 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                    E
                </div>
                <span class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded-full">Proponentes</span>
            </div>
            <p class="text-sm text-slate-500">Empresas</p>
            <h3 id="totalEmpresas" class="text-4xl font-black text-slate-900 mt-1">...</h3>
        </div>

        <div class="group bg-white p-6 rounded-3xl shadow-sm border border-slate-200 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold">
                    N
                </div>
                <span class="text-xs bg-purple-50 text-purple-700 px-2 py-1 rounded-full">Convocantes</span>
            </div>
            <p class="text-sm text-slate-500">Entidades</p>
            <h3 id="totalEntidades" class="text-4xl font-black text-slate-900 mt-1">...</h3>
        </div>

        <div class="group bg-white p-6 rounded-3xl shadow-sm border border-slate-200 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                    C
                </div>
                <span class="text-xs bg-amber-50 text-amber-700 px-2 py-1 rounded-full">Procesos</span>
            </div>
            <p class="text-sm text-slate-500">Convocatorias</p>
            <h3 id="totalConvocatorias" class="text-4xl font-black text-slate-900 mt-1">...</h3>
        </div>

        <div class="group bg-white p-6 rounded-3xl shadow-sm border border-slate-200 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                    W
                </div>
                <span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-1 rounded-full">Word</span>
            </div>
            <p class="text-sm text-slate-500">Documentos</p>
            <h3 id="totalDocumentos" class="text-4xl font-black text-slate-900 mt-1">...</h3>
        </div>
    </div>

    <!-- Accesos rápidos -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">
        <a href="/empresas/create" class="bg-white border border-slate-200 rounded-3xl p-5 hover:shadow-lg hover:-translate-y-1 transition">
            <p class="text-sm text-slate-400 mb-2">Paso 1</p>
            <h4 class="font-bold text-slate-900">Registrar empresa</h4>
            <p class="text-sm text-slate-500 mt-1">Datos del proponente.</p>
        </a>

        <a href="/entidades/create" class="bg-white border border-slate-200 rounded-3xl p-5 hover:shadow-lg hover:-translate-y-1 transition">
            <p class="text-sm text-slate-400 mb-2">Paso 2</p>
            <h4 class="font-bold text-slate-900">Registrar entidad</h4>
            <p class="text-sm text-slate-500 mt-1">Entidad convocante.</p>
        </a>

        <a href="/convocatorias/create" class="bg-white border border-slate-200 rounded-3xl p-5 hover:shadow-lg hover:-translate-y-1 transition">
            <p class="text-sm text-slate-400 mb-2">Paso 3</p>
            <h4 class="font-bold text-slate-900">Crear convocatoria</h4>
            <p class="text-sm text-slate-500 mt-1">Datos del proceso.</p>
        </a>

        <a href="/formularios/generar" class="bg-gradient-to-br from-emerald-500 to-teal-500 text-white rounded-3xl p-5 hover:shadow-lg hover:-translate-y-1 transition">
            <p class="text-sm text-emerald-50 mb-2">Paso 4</p>
            <h4 class="font-bold">Generar documento</h4>
            <p class="text-sm text-emerald-50 mt-1">Crear archivo Word final.</p>
        </a>
    </div>

    <!-- Tablas -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- Últimos documentos -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-slate-900">Últimos documentos</h3>
                    <p class="text-sm text-slate-500">Archivos Word generados recientemente.</p>
                </div>

                <a href="/documentos" class="text-sm text-emerald-600 hover:underline font-medium">
                    Ver todos
                </a>
            </div>

            <div id="loadingDocumentos" class="p-6 text-sm text-slate-500">
                Cargando documentos...
            </div>

            <div id="documentosContainer" class="hidden">
                <div id="documentosBody" class="divide-y divide-slate-100"></div>
            </div>
        </div>

        <!-- Últimas convocatorias -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-slate-900">Últimas convocatorias</h3>
                    <p class="text-sm text-slate-500">Procesos registrados recientemente.</p>
                </div>

                <a href="/convocatorias" class="text-sm text-emerald-600 hover:underline font-medium">
                    Ver todas
                </a>
            </div>

            <div id="loadingConvocatorias" class="p-6 text-sm text-slate-500">
                Cargando convocatorias...
            </div>

            <div id="convocatoriasContainer" class="hidden">
                <div id="convocatoriasBody" class="divide-y divide-slate-100"></div>
            </div>
        </div>

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

    function obtenerEstadoClase(estado) {
        const valor = (estado ?? '').toLowerCase();

        if (valor === 'borrador') {
            return 'bg-yellow-50 text-yellow-700 border-yellow-200';
        }

        if (valor === 'activa') {
            return 'bg-green-50 text-green-700 border-green-200';
        }

        if (valor === 'cerrada') {
            return 'bg-red-50 text-red-700 border-red-200';
        }

        return 'bg-slate-50 text-slate-700 border-slate-200';
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
                <div class="p-6 text-sm text-center text-slate-500">
                    No hay documentos generados todavía.
                </div>
            `;
        } else {
            documentosBody.innerHTML = ultimosDocumentos.map(documento => {
                const id = documento.id_documento_generado;
                const modelo = documento.documento_modelo?.nombre_modelo ?? 'Sin modelo';
                const convocatoria = documento.convocatoria?.numero_convocatoria ?? 'Sin convocatoria';

                return `
                    <div class="p-5 hover:bg-slate-50 transition">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="font-semibold text-slate-900">
                                    ${documento.nombre_archivo ?? 'Documento generado'}
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    ${modelo} · ${convocatoria}
                                </p>

                                <p class="text-xs text-slate-400 mt-2">
                                    ${documento.fecha_generacion ?? '-'} · ${documento.generado_por ?? 'sistema'}
                                </p>
                            </div>

                            <div class="flex gap-2 shrink-0">
                                <a href="/documentos/${id}" class="text-sm px-3 py-2 rounded-xl border border-slate-200 hover:bg-white">
                                    Ver
                                </a>

                                <a href="/documentos/${id}/descargar" class="text-sm px-3 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-500">
                                    Descargar
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        const ultimasConvocatorias = convocatorias.slice(-5).reverse();

        loadingConvocatorias.classList.add('hidden');
        convocatoriasContainer.classList.remove('hidden');

        if (ultimasConvocatorias.length === 0) {
            convocatoriasBody.innerHTML = `
                <div class="p-6 text-sm text-center text-slate-500">
                    No hay convocatorias registradas todavía.
                </div>
            `;
        } else {
            convocatoriasBody.innerHTML = ultimasConvocatorias.map(item => {
                const entidad = item.entidad?.nombre_entidad ?? 'Sin entidad';
                const empresa = item.proponente?.razon_social ?? item.proponente?.nombre_comercial ?? 'Sin empresa';
                const estado = item.estado ?? 'Sin estado';
                const estadoClase = obtenerEstadoClase(estado);

                return `
                    <div class="p-5 hover:bg-slate-50 transition">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <p class="font-semibold text-slate-900">
                                        ${item.numero_convocatoria ?? 'Sin número'}
                                    </p>

                                    <span class="px-2 py-1 rounded-full text-xs font-medium border ${estadoClase}">
                                        ${estado}
                                    </span>
                                </div>

                                <p class="text-sm text-slate-500">
                                    ${entidad} · ${empresa}
                                </p>

                                <p class="text-sm text-slate-600 mt-2 line-clamp-2">
                                    ${item.objeto ?? 'Sin objeto'}
                                </p>
                            </div>

                            <a href="/formularios/generar" class="text-sm px-3 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800 shrink-0">
                                Generar
                            </a>
                        </div>
                    </div>
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