@extends('layouts.app')

@section('title', 'Nueva convocatoria')

@section('content')
<div class="bg-white rounded-xl shadow-sm border p-6 max-w-5xl">
    <h3 class="text-lg font-semibold mb-1">Datos de la convocatoria</h3>
    <p class="text-sm text-slate-500 mb-6">
        Complete la información principal del proceso.
    </p>

    <form id="convocatoriaForm" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium mb-1">Entidad convocante</label>
            <select name="id_entidad" id="id_entidad" class="w-full border rounded-lg px-3 py-2">
                <option value="">Cargando entidades...</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Empresa / Proponente</label>
            <select name="id_proponente" id="id_proponente" class="w-full border rounded-lg px-3 py-2">
                <option value="">Cargando empresas...</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">CITE</label>
            <input name="cite" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="CITE CIDSAF 094/2023">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Número de convocatoria</label>
            <input name="numero_convocatoria" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="CH LP - 085/2023">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">CUCE</label>
            <input name="cuce" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="23-1404-00-1345364-1-1">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Estado</label>
            <select name="estado" class="w-full border rounded-lg px-3 py-2">
                <option value="Borrador">Borrador</option>
                <option value="En revisión">En revisión</option>
                <option value="Finalizada">Finalizada</option>
            </select>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Objeto de contratación</label>
            <textarea name="objeto" class="w-full border rounded-lg px-3 py-2" rows="3" placeholder="Servicio de auditoría externa..."></textarea>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Lugar de entrega</label>
            <textarea name="lugar_entrega" class="w-full border rounded-lg px-3 py-2" rows="2" placeholder="Dirección donde se entrega la propuesta"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Fecha de presentación</label>
            <input name="fecha_presentacion" type="date" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Fecha de apertura</label>
            <input name="fecha_apertura" type="date" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Hora de apertura</label>
            <input name="hora_apertura" type="time" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Plazo de validez en días</label>
            <input name="plazo_propuesta_dias" type="number" class="w-full border rounded-lg px-3 py-2" placeholder="60">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Monto Bs.</label>
            <input name="monto" type="number" step="0.01" class="w-full border rounded-lg px-3 py-2" placeholder="41500">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Monto literal</label>
            <input name="monto_literal" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Cuarenta y un mil quinientos 00/100 bolivianos">
        </div>

        <div class="md:col-span-2 flex justify-end gap-3 pt-4">
            <a href="/convocatorias" class="px-4 py-2 rounded-lg border">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Guardar convocatoria
            </button>
        </div>
    </form>

    <div id="mensaje" class="hidden mt-5 rounded-lg p-4 text-sm border"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const entidadSelect = document.getElementById('id_entidad');
    const proponenteSelect = document.getElementById('id_proponente');

    async function cargarEntidades() {
        const response = await fetch('/api/entidades');
        const data = await response.json();
        const entidades = Array.isArray(data) ? data : data.data ?? [];

        entidadSelect.innerHTML = '<option value="">Seleccione una entidad</option>';

        entidades.forEach(entidad => {
            entidadSelect.innerHTML += `
                <option value="${entidad.id_entidad}">
                    ${entidad.nombre_entidad}
                </option>
            `;
        });
    }

    async function cargarProponentes() {
        const response = await fetch('/api/proponentes');
        const data = await response.json();
        const proponentes = Array.isArray(data) ? data : data.data ?? [];

        proponenteSelect.innerHTML = '<option value="">Seleccione una empresa</option>';

        proponentes.forEach(proponente => {
            proponenteSelect.innerHTML += `
                <option value="${proponente.id_proponente}">
                    ${proponente.razon_social ?? proponente.nombre_comercial ?? 'Empresa sin nombre'}
                </option>
            `;
        });
    }

    await cargarEntidades();
    await cargarProponentes();
});

document.getElementById('convocatoriaForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const mensaje = document.getElementById('mensaje');

    const data = {
        id_entidad: form.id_entidad.value,
        id_proponente: form.id_proponente.value,
        cite: form.cite.value,
        numero_convocatoria: form.numero_convocatoria.value,
        cuce: form.cuce.value,
        objeto: form.objeto.value,
        lugar_entrega: form.lugar_entrega.value,
        fecha_presentacion: form.fecha_presentacion.value,
        fecha_apertura: form.fecha_apertura.value,
        hora_apertura: form.hora_apertura.value,
        plazo_propuesta_dias: form.plazo_propuesta_dias.value,
        monto: form.monto.value,
        monto_literal: form.monto_literal.value,
        estado: form.estado.value,
    };

    try {
        const response = await fetch('/api/convocatorias', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (!response.ok) {
            console.error(result);

            let errores = '';

            if (result.errors) {
                errores = Object.values(result.errors).flat().join(' ');
            }

            throw new Error(result.message || errores || 'No se pudo guardar la convocatoria.');
        }

        mensaje.className = 'mt-5 rounded-lg p-4 text-sm border bg-green-50 text-green-700 border-green-200';
        mensaje.textContent = 'Convocatoria guardada correctamente. Redirigiendo...';

        setTimeout(() => {
            window.location.href = '/convocatorias';
        }, 1000);

    } catch (error) {
        mensaje.className = 'mt-5 rounded-lg p-4 text-sm border bg-red-50 text-red-700 border-red-200';
        mensaje.textContent = error.message;
    }
});
</script>
@endsection