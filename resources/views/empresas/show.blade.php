@extends('layouts.app')

@section('title', 'Detalle de empresa')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-950 via-slate-900 to-cyan-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-cyan-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-cyan-300 text-sm font-medium mb-2">
                    Personal de la empresa
                </p>

                <h3 id="tituloEmpresa" class="text-2xl font-bold text-white">
                    Detalle de empresa
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Consulte los datos principales del proponente y asigne personas registradas a su equipo de trabajo.
                </p>
            </div>

            <a href="/empresas" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                Volver al listado
            </a>
        </div>
    </div>

    <div id="loading" class="bg-white border border-slate-200 rounded-3xl p-6 text-slate-500 shadow-sm">
        Cargando empresa...
    </div>

    <div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5">
        No se pudo cargar la empresa.
    </div>

    <div id="contenido" class="hidden space-y-6">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h4 class="font-bold text-slate-900">Datos de la empresa</h4>
                    <p class="text-sm text-slate-500">Información principal del proponente.</p>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5 text-sm">
                    <div>
                        <p class="text-slate-500 mb-1">Razón social</p>
                        <p id="razonSocial" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Nombre comercial</p>
                        <p id="nombreComercial" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">NIT</p>
                        <p id="nit" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">NRC / Matrícula</p>
                        <p id="matricula" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Ciudad</p>
                        <p id="ciudad" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">País</p>
                        <p id="pais" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Teléfono</p>
                        <p id="telefono" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Correo</p>
                        <p id="correo" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-slate-500 mb-1">Dirección</p>
                        <p id="direccion" class="font-semibold text-slate-900">-</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h4 class="font-bold text-slate-900">Representante legal</h4>
                    <p class="text-sm text-slate-500">Persona vinculada a la empresa.</p>
                </div>

                <div class="p-6">
                    <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-700 flex items-center justify-center font-black text-xl mb-4">
                        R
                    </div>

                    <p id="representanteLegal" class="font-bold text-slate-900">
                        Sin representante
                    </p>

                    <p id="representanteCi" class="text-sm text-slate-500 mt-1">
                        -
                    </p>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                    <div>
                        <h4 class="font-bold text-slate-900">Personal asignado</h4>
                        <p class="text-sm text-slate-500">Personas que pertenecen al equipo de esta empresa.</p>
                    </div>

                    <span id="totalPersonal" class="text-sm bg-cyan-50 text-cyan-700 px-3 py-1 rounded-full font-medium">
                        0 registros
                    </span>
                </div>

                <div id="personalAsignado" class="divide-y divide-slate-100"></div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h4 class="font-bold text-slate-900">Agregar personal</h4>
                    <p class="text-sm text-slate-500">Seleccione una persona y su cargo.</p>
                </div>

                <form id="asignarForm" class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Persona</label>
                        <select id="personaSelect" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition">
                            <option value="">Cargando personas...</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Cargo</label>
                        <select id="cargoSelect" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition">
                            <option value="">Cargando cargos...</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Orden de firma</label>
                        <input id="ordenFirma" type="number" min="1" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition" placeholder="1">
                    </div>

                    <label class="flex items-center gap-2 text-sm text-slate-700">
                        <input id="esFirmante" type="checkbox" class="rounded border-slate-300">
                        Es firmante
                    </label>

                    <div id="mensaje" class="hidden rounded-2xl p-4 text-sm border"></div>

                    <button type="submit" id="btnAsignar" class="w-full bg-cyan-600 text-white px-5 py-3 rounded-2xl hover:bg-cyan-500 shadow-lg shadow-cyan-950/20 font-semibold transition">
                        Asignar personal
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const empresaId = Number(@json($id));

    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const contenido = document.getElementById('contenido');
    const personalAsignado = document.getElementById('personalAsignado');
    const totalPersonal = document.getElementById('totalPersonal');
    const personaSelect = document.getElementById('personaSelect');
    const cargoSelect = document.getElementById('cargoSelect');
    const asignarForm = document.getElementById('asignarForm');
    const btnAsignar = document.getElementById('btnAsignar');
    const mensaje = document.getElementById('mensaje');

    let cargos = [];

    function nombreCompleto(persona) {
        return [
            persona?.nombres,
            persona?.apellido_paterno,
            persona?.apellido_materno
        ].filter(Boolean).join(' ');
    }

    function mostrarMensaje(texto, tipo = 'info') {
        mensaje.classList.remove(
            'hidden',
            'bg-green-50',
            'text-green-700',
            'border-green-200',
            'bg-red-50',
            'text-red-700',
            'border-red-200',
            'bg-blue-50',
            'text-blue-700',
            'border-blue-200'
        );

        mensaje.classList.add('border');

        if (tipo === 'error') {
            mensaje.classList.add('bg-red-50', 'text-red-700', 'border-red-200');
        } else if (tipo === 'success') {
            mensaje.classList.add('bg-green-50', 'text-green-700', 'border-green-200');
        } else {
            mensaje.classList.add('bg-blue-50', 'text-blue-700', 'border-blue-200');
        }

        mensaje.innerHTML = texto;
    }

    async function obtenerJson(url) {
        const response = await fetch(url);
        const data = await response.json();

        if (!response.ok) {
            console.error(data);
            throw new Error(data.message || 'No se pudieron cargar los datos.');
        }

        return Array.isArray(data) ? data : data.data ?? data;
    }

    async function cargarPersonas() {
        const personas = await obtenerJson('/api/personas');

        personaSelect.innerHTML = '<option value="">Seleccione una persona</option>';

        personas.forEach(persona => {
            const nombre = nombreCompleto(persona) || 'Persona sin nombre';
            const ci = persona.ci ? ` - CI: ${persona.ci}` : '';

            personaSelect.innerHTML += `
                <option value="${persona.id_persona}">
                    ${nombre}${ci}
                </option>
            `;
        });
    }

    async function cargarCargos() {
        cargos = await obtenerJson('/api/cargos');

        cargoSelect.innerHTML = '<option value="">Seleccione un cargo</option>';

        cargos.forEach(cargo => {
            cargoSelect.innerHTML += `
                <option value="${cargo.id_cargo}">
                    ${cargo.nombre_cargo ?? 'Cargo sin nombre'}
                </option>
            `;
        });
    }

    function obtenerNombreCargo(idCargo) {
        const cargo = cargos.find(item => Number(item.id_cargo) === Number(idCargo));

        return cargo?.nombre_cargo ?? 'Sin cargo';
    }

    function pintarEmpresa(empresa) {
        const representante = empresa.representante_legal;
        const representanteNombre = representante ? nombreCompleto(representante) : 'Sin representante';

        document.getElementById('tituloEmpresa').textContent =
            empresa.razon_social ?? empresa.nombre_comercial ?? 'Detalle de empresa';

        document.getElementById('razonSocial').textContent =
            empresa.razon_social ?? '-';

        document.getElementById('nombreComercial').textContent =
            empresa.nombre_comercial ?? '-';

        document.getElementById('nit').textContent =
            empresa.nit ?? '-';

        document.getElementById('matricula').textContent =
            empresa.matricula_comercio ?? '-';

        document.getElementById('ciudad').textContent =
            empresa.ciudad ?? '-';

        document.getElementById('pais').textContent =
            empresa.pais ?? '-';

        document.getElementById('telefono').textContent =
            empresa.telefono ?? '-';

        document.getElementById('correo').textContent =
            empresa.correo ?? '-';

        document.getElementById('direccion').textContent =
            empresa.direccion ?? '-';

        document.getElementById('representanteLegal').textContent =
            representanteNombre || 'Sin representante';

        document.getElementById('representanteCi').textContent =
            representante?.ci ? `CI: ${representante.ci}` : '-';

        const personal = empresa.personal ?? [];

        totalPersonal.textContent = `${personal.length} registro${personal.length === 1 ? '' : 's'}`;

        if (personal.length === 0) {
            personalAsignado.innerHTML = `
                <div class="px-6 py-8 text-center text-slate-500">
                    Esta empresa todavía no tiene personal asignado.
                </div>
            `;
            return;
        }

        personalAsignado.innerHTML = personal.map(persona => {
            const nombre = nombreCompleto(persona) || 'Persona sin nombre';
            const cargo = obtenerNombreCargo(persona.pivot?.id_cargo);
            const firmante = persona.pivot?.es_firmante ? 'Firmante' : 'No firmante';
            const orden = persona.pivot?.orden_firma ?? '-';

            return `
                <div class="p-6 hover:bg-slate-50 transition">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-black">
                                ${(persona.nombres ?? 'P').charAt(0)}
                            </div>

                            <div>
                                <p class="font-bold text-slate-900">${nombre}</p>
                                <p class="text-sm text-slate-500">${persona.profesion ?? 'Sin profesión'} · ${cargo}</p>
                                <p class="text-xs text-slate-400 mt-1">CI: ${persona.ci ?? '-'}</p>
                            </div>
                        </div>

                        <div class="flex gap-2 flex-wrap">
                            <span class="text-xs px-3 py-1 rounded-full bg-slate-50 text-slate-700 border border-slate-200">
                                ${firmante}
                            </span>

                            <span class="text-xs px-3 py-1 rounded-full bg-cyan-50 text-cyan-700 border border-cyan-100">
                                Orden: ${orden}
                            </span>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
    }

    async function cargarEmpresa() {
        const empresa = await obtenerJson(`/api/proponentes/${empresaId}`);

        pintarEmpresa(empresa);

        loading.classList.add('hidden');
        contenido.classList.remove('hidden');
    }

    asignarForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const personaId = personaSelect.value;
        const cargoId = cargoSelect.value;
        const ordenFirma = document.getElementById('ordenFirma').value;
        const esFirmante = document.getElementById('esFirmante').checked;

        if (!personaId || !cargoId) {
            mostrarMensaje('Debe seleccionar una persona y un cargo.', 'error');
            return;
        }

        btnAsignar.disabled = true;
        btnAsignar.textContent = 'Asignando...';

        try {
            const response = await fetch('/api/proponente-personal', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    id_proponente: empresaId,
                    id_persona: personaId,
                    id_cargo: cargoId,
                    es_firmante: esFirmante,
                    orden_firma: ordenFirma || null,
                }),
            });

            const result = await response.json();

            if (!response.ok) {
                console.error(result);

                let errores = '';

                if (result.errors) {
                    errores = Object.values(result.errors).flat().join('<br>');
                }

                throw new Error(errores || result.message || 'No se pudo asignar el personal.');
            }

            mostrarMensaje('Personal asignado correctamente.', 'success');

            asignarForm.reset();

            await cargarEmpresa();

        } catch (error) {
            mostrarMensaje(error.message, 'error');
        } finally {
            btnAsignar.disabled = false;
            btnAsignar.textContent = 'Asignar personal';
        }
    });

    try {
        await cargarCargos();
        await cargarPersonas();
        await cargarEmpresa();

    } catch (e) {
        console.error(e);
        loading.classList.add('hidden');
        error.classList.remove('hidden');
        error.textContent = e.message;
    }
});
</script>
@endsection