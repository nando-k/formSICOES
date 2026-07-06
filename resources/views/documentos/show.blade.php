@extends('layouts.app')

@section('title', 'Detalle del documento')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-lg font-semibold">Carta de presentación técnica</h3>
                <p class="text-sm text-slate-500">
                    Documento generado para la propuesta CH LP - 085/2023.
                </p>
            </div>

            <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                Generado
            </span>
        </div>

        <div class="border rounded-xl p-5 bg-slate-50">
            <h4 class="font-semibold mb-4">Información del archivo</h4>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-slate-500">Nombre del archivo</p>
                    <p class="font-medium">carta_presentacion_tecnica_CH_LP_085_2023.docx</p>
                </div>

                <div>
                    <p class="text-slate-500">Formato</p>
                    <p class="font-medium">DOCX</p>
                </div>

                <div>
                    <p class="text-slate-500">Fecha de generación</p>
                    <p class="font-medium">30/06/2023 10:35</p>
                </div>

                <div>
                    <p class="text-slate-500">Generado por</p>
                    <p class="font-medium">Usuario Operativo</p>
                </div>

                <div>
                    <p class="text-slate-500">Estado</p>
                    <p class="font-medium">Listo para descarga</p>
                </div>

                <div>
                    <p class="text-slate-500">Versión</p>
                    <p class="font-medium">1</p>
                </div>
            </div>
        </div>

        <div class="mt-6 border rounded-xl p-5">
            <h4 class="font-semibold mb-4">Datos usados para generar el documento</h4>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-slate-500">Empresa</p>
                    <p class="font-medium">CIDSAF S.R.L.</p>
                </div>

                <div>
                    <p class="text-slate-500">Entidad</p>
                    <p class="font-medium">Caja Nacional de Salud</p>
                </div>

                <div>
                    <p class="text-slate-500">Convocatoria</p>
                    <p class="font-medium">CH LP - 085/2023</p>
                </div>

                <div>
                    <p class="text-slate-500">CUCE</p>
                    <p class="font-medium">23-1404-00-1345364-1-1</p>
                </div>

                <div>
                    <p class="text-slate-500">Representante legal</p>
                    <p class="font-medium">Sandra Irene Rodríguez Callisaya</p>
                </div>

                <div>
                    <p class="text-slate-500">Fecha de presentación</p>
                    <p class="font-medium">30/06/2023</p>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <h3 class="font-semibold mb-4">Acciones</h3>

            <div class="space-y-3">
                <button class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    Descargar Word
                </button>

                <button class="w-full bg-slate-900 text-white px-4 py-2 rounded-lg hover:bg-slate-800">
                    Descargar PDF
                </button>

                <a href="/formularios/preview" class="block text-center w-full border px-4 py-2 rounded-lg hover:bg-slate-50">
                    Ver vista previa
                </a>

                <a href="/documentos" class="block text-center w-full border px-4 py-2 rounded-lg hover:bg-slate-50">
                    Volver al historial
                </a>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-sm text-blue-800">
            En una versión final, esta sección permitirá descargar el archivo generado desde el servidor.
        </div>
    </div>

</div>
@endsection