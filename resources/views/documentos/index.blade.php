@extends('layouts.app')

@section('title', 'Documentos generados')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-emerald-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-emerald-300 text-sm font-medium mb-2">
                    Historial documental
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Documentos generados
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Consulte, revise y descargue los documentos Word generados desde las plantillas del sistema.
                </p>
            </div>

            <a href="/formularios/generar" class="bg-emerald-500 text-white px-5 py-3 rounded-2xl hover:bg-emerald-400 shadow-lg shadow-emerald-950/30 font-semibold text-center">
                Generar nuevo
            </a>
        </div>
    </div>

    <div id="loading" class="bg-white border border-slate-200 rounded-3xl p-6 text-slate-500 shadow-sm">
        Cargando documentos generados...
    </div>

    <div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5">
        No se pudieron cargar los documentos generados.
    </div>

    <div id="tablaContainer" class="hidden bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h4 class="font-bold text-slate-900">Historial de documentos</h4>
                <p class="text-sm text-slate-500">Archivos generados desde plantillas Word.</p>
            </div>

            <span id="totalDocumentos" class="text-sm bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full font-medium">
                0 registros
            </span>
        </div>

        <div id="documentosBody" class="divide-y divide-slate-100"></div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const tablaContainer = document.getElementById('tablaContainer');
    const documentosBody = document.getElementById('documentosBody');
    const totalDocumentos = document.getElementById('totalDocumentos');

    try {
        const response = await fetch('/api/documentos-generados');
        const data = await response.json();

        if (!response.ok) {
            console.error(data);
            throw new Error(data.message || 'No se pudieron cargar los documentos.');
        }

        const documentos = Array.isArray(data) ? data : data.data ?? [];

        loading.classList.add('hidden');
        tablaContainer.classList.remove('hidden');

        totalDocumentos.textContent = `${documentos.length} registro${documentos.length === 1 ? '' : 's'}`;

        if (documentos.length === 0) {
            documentosBody.innerHTML = `
                <div class="px-6 py-8 text-center text-slate-500">
                    No hay documentos generados todavía.
                </div>
            `;
            return;
        }

        documentosBody.innerHTML = documentos.slice().reverse().map(documento => {
            const id = documento.id_documento_generado;
            const modelo = documento.documento_modelo?.nombre_modelo ?? 'Sin modelo';
            const codigoModelo = documento.documento_modelo?.codigo_modelo ?? 'Modelo';
            const convocatoria = documento.convocatoria?.numero_convocatoria ?? 'Sin convocatoria';

            return `
                <div class="p-6 hover:bg-slate-50 transition">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-black">
                                W
                            </div>

                            <div>
                                <div class="flex items-center gap-2 mb-2 flex-wrap">
                                    <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-100 px-3 py-1 rounded-full">
                                        ${codigoModelo}
                                    </span>

                                    <span class="text-xs text-slate-400">
                                        ${documento.fecha_generacion ?? '-'}
                                    </span>
                                </div>

                                <p class="font-bold text-slate-900 break-all">
                                    ${documento.nombre_archivo ?? 'Documento generado'}
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    ${modelo} · ${convocatoria}
                                </p>

                                <p class="text-xs text-slate-400 mt-2">
                                    Generado por: ${documento.generado_por ?? '-'}
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-2 shrink-0">
                            <a href="/documentos/${id}" class="px-4 py-2 rounded-2xl border border-slate-200 hover:bg-white text-sm font-medium">
                                Ver detalle
                            </a>

                            <a href="/documentos/${id}/descargar" class="px-4 py-2 rounded-2xl bg-emerald-600 text-white hover:bg-emerald-500 text-sm font-semibold">
                                Descargar
                            </a>
                        </div>
                    </div>
                </div>
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