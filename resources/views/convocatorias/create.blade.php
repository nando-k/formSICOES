@extends('layouts.app')

@section('title', 'Nueva convocatoria')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-amber-950 via-slate-900 to-orange-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-amber-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-amber-300 text-sm font-medium mb-2">
                    Registro de proceso
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Nueva convocatoria
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Complete la información principal del proceso de contratación, vinculando entidad y empresa proponente.
                </p>
            </div>

            <a href="/convocatorias" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                Volver al listado
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-6xl">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="font-bold text-slate-900">Datos de la convocatoria</h4>
            <p class="text-sm text-slate-500 mt-1">
                Complete los campos necesarios para generar documentos desde plantillas Word.
            </p>
        </div>

        <form id="convocatoriaForm" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Entidad convocante</label>
                <select name="id_entidad" id="id_entidad" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                    <option value="">Cargando entidades...</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Empresa / Proponente</label>
                <select name="id_proponente" id="id_proponente" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                    <option value="">Cargando empresas...</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">CITE</label>
                <input name="cite" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="CITE CIDSAF 094/2023">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Número de convocatoria</label>
                <input name="numero_convocatoria" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="CH LP - 085/2023">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">CUCE</label>
                <input name="cuce" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="23-1404-00-1345364-1-1">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                <select name="estado" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                    <option value="Borrador">Borrador</option>
                    <option value="En revisión">En revisión</option>
                    <option value="Finalizada">Finalizada</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Objeto de contratación</label>
                <textarea name="objeto" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" rows="3" placeholder="Servicio de auditoría externa..."></textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Lugar de entrega</label>
                <textarea name="lugar_entrega" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" rows="2" placeholder="Dirección donde se entrega la propuesta"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de presentación</label>
                <input name="fecha_presentacion" type="date" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de apertura</label>
                <input name="fecha_apertura" type="date" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Hora de apertura</label>
                <input name="hora_apertura" type="time" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Plazo de validez en días</label>
                <input name="plazo_propuesta_dias" type="number" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="60">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Monto Bs.</label>
                <input name="monto" type="number" step="0.01" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="41500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Monto literal</label>
                <input name="monto_literal" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="Cuarenta y un mil quinientos 00/100 bolivianos">
            </div>

            <div class="md:col-span-2">
                <div id="mensaje" class="hidden rounded-2xl p-4 text-sm border"></div>
            </div>

            <div class="md:col-span-2 flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="/convocatorias" class="px-5 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 text-center">
                    Cancelar
                </a>

                <button type="submit" id="btnGuardar" class="bg-amber-600 text-white px-5 py-3 rounded-2xl hover:bg-amber-500 shadow-lg shadow-amber-950/20 font-semibold transition">
                    Guardar convocatoria
                </button>
            </div>
        </form>
    </div>
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
    const btnGuardar = document.getElementById('btnGuardar');

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

    btnGuardar.disabled = true;
    btnGuardar.textContent = 'Guardando...';

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
                errores = Object.values(result.errors).flat().join('<br>');
            }

            throw new Error(result.message || errores || 'No se pudo guardar la convocatoria.');
        }

        mensaje.className = 'rounded-2xl p-4 text-sm border bg-green-50 text-green-700 border-green-200';
        mensaje.innerHTML = 'Convocatoria guardada correctamente. Redirigiendo...';

        setTimeout(() => {
            window.location.href = '/convocatorias';
        }, 900);

    } catch (error) {
        mensaje.className = 'rounded-2xl p-4 text-sm border bg-red-50 text-red-700 border-red-200';
        mensaje.innerHTML = error.message;
    } finally {
        btnGuardar.disabled = false;
        btnGuardar.textContent = 'Guardar convocatoria';
    }
});
</script>
@endsection