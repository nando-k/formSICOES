@extends('layouts.app')

@section('title', 'Generar documento')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border p-6">
        <h3 class="text-lg font-semibold mb-1">Generar documento desde plantilla</h3>
        <p class="text-sm text-slate-500 mb-6">
            Seleccione la convocatoria y el modelo de documento que desea generar.
        </p>

        <form class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium mb-1">Modelo de documento</label>
                <select id="documentoModelo" class="w-full border rounded-lg px-3 py-2">
                    <option value="">Cargando modelos...</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Convocatoria</label>
                <select id="convocatoria" class="w-full border rounded-lg px-3 py-2">
                    <option value="">Cargando convocatorias...</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Observación</label>
                <textarea class="w-full border rounded-lg px-3 py-2" rows="3" placeholder="Observación opcional para el documento generado"></textarea>
            </div>

            <div class="md:col-span-2 flex justify-end gap-3 pt-4">
                <a href="/formularios" class="px-4 py-2 rounded-lg border">
                    Cancelar
                </a>

                <button type="button" id="btnGenerar" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    Generar documento
                </button>
            </div>
        </form>

        <div id="mensaje" class="hidden mt-5 rounded-lg p-4 text-sm"></div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h3 class="font-semibold mb-4">Funcionamiento</h3>

        <div class="space-y-4 text-sm text-slate-600">
            <p>
                El sistema tomará los datos registrados de la convocatoria y los insertará en la plantilla Word seleccionada.
            </p>

            <div class="border rounded-lg p-4 bg-slate-50">
                <p class="font-medium text-slate-800 mb-2">Flujo:</p>
                <p>1. Seleccionar modelo</p>
                <p>2. Seleccionar convocatoria</p>
                <p>3. Generar documento</p>
                <p>4. Descargar archivo final</p>
            </div>

            <p class="text-xs text-slate-500">
                Esta pantalla ya consume datos reales desde la API. La generación final depende del endpoint del backend.
            </p>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const documentoModelo = document.getElementById('documentoModelo');
    const convocatoria = document.getElementById('convocatoria');
    const btnGenerar = document.getElementById('btnGenerar');
    const mensaje = document.getElementById('mensaje');

    async function cargarModelos() {
        const response = await fetch('/api/documentos-modelo');
        const data = await response.json();
        const modelos = Array.isArray(data) ? data : data.data ?? [];

        documentoModelo.innerHTML = '<option value="">Seleccione un modelo</option>';

        modelos.forEach(modelo => {
            documentoModelo.innerHTML += `
                <option value="${modelo.id}">
                    ${modelo.codigo_modelo ?? modelo.codigo ?? 'Modelo'} - ${modelo.nombre_modelo ?? modelo.nombre ?? 'Sin nombre'}
                </option>
            `;
        });
    }

    async function cargarConvocatorias() {
        const response = await fetch('/api/convocatorias');
        const data = await response.json();
        const convocatorias = Array.isArray(data) ? data : data.data ?? [];

        convocatoria.innerHTML = '<option value="">Seleccione una convocatoria</option>';

        if (convocatorias.length === 0) {
            convocatoria.innerHTML = '<option value="">No hay convocatorias registradas</option>';
            return;
        }

        convocatorias.forEach(item => {
            convocatoria.innerHTML += `
                <option value="${item.id}">
                    ${item.nro_convocatoria ?? 'Sin número'} - ${item.entidad_convocante ?? 'Sin entidad'}
                </option>
            `;
        });
    }

    function mostrarMensaje(texto, tipo = 'info') {
        mensaje.classList.remove('hidden', 'bg-green-50', 'text-green-700', 'border-green-200', 'bg-red-50', 'text-red-700', 'border-red-200');
        mensaje.classList.add('border');

        if (tipo === 'error') {
            mensaje.classList.add('bg-red-50', 'text-red-700', 'border-red-200');
        } else {
            mensaje.classList.add('bg-green-50', 'text-green-700', 'border-green-200');
        }

        mensaje.textContent = texto;
    }

    btnGenerar.addEventListener('click', async () => {
        const convocatoriaId = convocatoria.value;
        const documentoModeloId = documentoModelo.value;

        if (!convocatoriaId || !documentoModeloId) {
            mostrarMensaje('Debe seleccionar un modelo y una convocatoria.', 'error');
            return;
        }

        mostrarMensaje('Datos listos para enviar al backend. Próximo paso: conectar el POST de generación.', 'success');
    });

    try {
        await cargarModelos();
        await cargarConvocatorias();
    } catch (error) {
        console.error(error);
        mostrarMensaje('No se pudieron cargar los datos desde la API.', 'error');
    }
});
</script>
@endsection