@extends('layouts.app')

@section('title', 'Detalle del documento')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-emerald-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-emerald-300 text-sm font-medium mb-2">
                    Documento generado
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Detalle del documento
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Información del archivo Word generado y su convocatoria relacionada.
                </p>
            </div>

            <a href="/documentos" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                Volver al historial
            </a>
        </div>
    </div>

    <div id="loading" class="bg-white border border-slate-200 rounded-3xl p-6 text-slate-500 shadow-sm">
        Cargando detalle del documento...
    </div>

    <div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5">
        No se pudo cargar el detalle del documento.
    </div>

    <div id="detalle" class="hidden space-y-6">

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-black text-xl">
                        W
                    </div>

                    <div>
                        <h3 id="nombreArchivo" class="text-xl font-bold text-slate-900 break-all">
                            Documento generado
                        </h3>

                        <p id="rutaArchivo" class="text-sm text-slate-500 mt-1"></p>
                    </div>
                </div>

                <a id="btnDescargar" href="#" class="bg-emerald-600 text-white px-5 py-3 rounded-2xl hover:bg-emerald-500 shadow-lg shadow-emerald-950/20 font-semibold text-center">
                    Descargar Word
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h4 class="font-bold text-slate-900">Información del documento</h4>
                    <p class="text-sm text-slate-500">Datos de generación del archivo.</p>
                </div>

                <div class="p-6 space-y-5 text-sm">
                    <div>
                        <p class="text-slate-500 mb-1">Modelo</p>
                        <p id="modelo" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Fecha de generación</p>
                        <p id="fecha" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Generado por</p>
                        <p id="generadoPor" class="font-semibold text-slate-900">-</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h4 class="font-bold text-slate-900">Convocatoria relacionada</h4>
                    <p class="text-sm text-slate-500">Proceso usado para llenar la plantilla.</p>
                </div>

                <div class="p-6 space-y-5 text-sm">
                    <div>
                        <p class="text-slate-500 mb-1">Número de convocatoria</p>
                        <p id="numeroConvocatoria" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">CUCE</p>
                        <p id="cuce" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Objeto</p>
                        <p id="objeto" class="font-semibold text-slate-900 leading-relaxed">-</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const documentoId = Number(@json($id));

    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const detalle = document.getElementById('detalle');

    try {
        const response = await fetch('/api/documentos-generados');
        const data = await response.json();

        if (!response.ok) {
            console.error(data);
            throw new Error(data.message || 'No se pudo cargar el documento.');
        }

        const documentos = Array.isArray(data) ? data : data.data ?? [];

        const documento = documentos.find(item => {
            return Number(item.id_documento_generado) === documentoId;
        });

        if (!documento) {
            throw new Error('No se encontró el documento generado.');
        }

        const id = documento.id_documento_generado;

        document.getElementById('nombreArchivo').textContent =
            documento.nombre_archivo ?? 'Documento generado';

        document.getElementById('rutaArchivo').textContent =
            documento.ruta_archivo ?? 'Sin ruta registrada';

        document.getElementById('modelo').textContent =
            documento.documento_modelo?.nombre_modelo ?? 'Sin modelo';

        document.getElementById('fecha').textContent =
            documento.fecha_generacion ?? '-';

        document.getElementById('generadoPor').textContent =
            documento.generado_por ?? '-';

        document.getElementById('numeroConvocatoria').textContent =
            documento.convocatoria?.numero_convocatoria ?? '-';

        document.getElementById('cuce').textContent =
            documento.convocatoria?.cuce ?? '-';

        document.getElementById('objeto').textContent =
            documento.convocatoria?.objeto ?? '-';

        document.getElementById('btnDescargar').href =
            `/documentos/${id}/descargar`;

        loading.classList.add('hidden');
        detalle.classList.remove('hidden');

    } catch (e) {
        console.error(e);
        loading.classList.add('hidden');
        error.classList.remove('hidden');
        error.textContent = e.message;
    }
});
</script>
@endsection