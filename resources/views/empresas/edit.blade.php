@extends('layouts.app')

@section('title', 'Editar empresa')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-emerald-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-emerald-300 text-sm font-medium mb-2">
                    Actualización de empresa
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Editar empresa
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Modifique los datos de la empresa proponente y su representante legal.
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

    <div id="formContainer" class="hidden bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-6xl">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="font-bold text-slate-900">Datos de la empresa</h4>
            <p class="text-sm text-slate-500 mt-1">
                Actualice la información registrada.
            </p>
        </div>

        <form id="empresaForm" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Razón social</label>
                <input name="razon_social" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre comercial</label>
                <input name="nombre_comercial" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">NIT</label>
                <input name="nit" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Matrícula de comercio</label>
                <input name="matricula_comercio" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Dirección</label>
                <textarea name="direccion" rows="2" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Ciudad</label>
                <input name="ciudad" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">País</label>
                <input name="pais" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                <input name="telefono" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                <input name="correo" type="email" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Tipo de organización</label>
                <input name="tipo_organizacion" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Representante legal</label>
                <select name="representante_legal_id" id="representante_legal_id" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    <option value="">Cargando personas...</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <div id="mensaje" class="hidden rounded-2xl p-4 text-sm border"></div>
            </div>

            <div class="md:col-span-2 flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="/empresas" class="px-5 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 text-center">
                    Cancelar
                </a>

                <button type="submit" id="btnGuardar" class="bg-emerald-600 text-white px-5 py-3 rounded-2xl hover:bg-emerald-500 shadow-lg shadow-emerald-950/20 font-semibold transition">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>

</div>

<script>
function convertirMayusculas(valor) {
    return valor ? valor.trim().toUpperCase() : valor;
}

document.addEventListener('DOMContentLoaded', async () => {
    const empresaId = @json($id);

    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const formContainer = document.getElementById('formContainer');
    const form = document.getElementById('empresaForm');
    const mensaje = document.getElementById('mensaje');
    const btnGuardar = document.getElementById('btnGuardar');
    const representanteSelect = document.getElementById('representante_legal_id');

    const camposMayusculas = document.querySelectorAll('input[type="text"], textarea');

    camposMayusculas.forEach(campo => {
        campo.classList.add('uppercase');

        campo.addEventListener('input', () => {
            const posicion = campo.selectionStart;
            campo.value = campo.value.toUpperCase();

            if (campo.setSelectionRange && posicion !== null) {
                campo.setSelectionRange(posicion, posicion);
            }
        });
    });

    function campo(nombre) {
        return form.querySelector(`[name="${nombre}"]`);
    }

    function mostrarMensaje(texto, tipo = 'error') {
        mensaje.className = 'rounded-2xl p-4 text-sm border';

        if (tipo === 'success') {
            mensaje.classList.add('bg-green-50', 'text-green-700', 'border-green-200');
        } else {
            mensaje.classList.add('bg-red-50', 'text-red-700', 'border-red-200');
        }

        mensaje.innerHTML = texto;
        mensaje.classList.remove('hidden');
    }

    async function cargarPersonas() {
        const response = await fetch('/api/personas');
        const data = await response.json();
        const personas = Array.isArray(data) ? data : data.data ?? [];

        representanteSelect.innerHTML = '<option value="">Sin representante legal</option>';

        personas.forEach(persona => {
            const nombreCompleto = [
                persona.nombres,
                persona.apellido_paterno,
                persona.apellido_materno
            ].filter(Boolean).join(' ');

            representanteSelect.innerHTML += `
                <option value="${persona.id_persona}">
                    ${nombreCompleto} - CI ${persona.ci ?? ''}
                </option>
            `;
        });
    }

    try {
        await cargarPersonas();

        const response = await fetch(`/api/proponentes/${empresaId}`, {
            headers: {
                'Accept': 'application/json',
            }
        });

        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.message || 'No se pudo cargar la empresa.');
        }

        const empresa = result.data ?? result.proponente ?? result;

        campo('razon_social').value = empresa.razon_social ?? '';
        campo('nombre_comercial').value = empresa.nombre_comercial ?? '';
        campo('nit').value = empresa.nit ?? '';
        campo('matricula_comercio').value = empresa.matricula_comercio ?? '';
        campo('direccion').value = empresa.direccion ?? '';
        campo('ciudad').value = empresa.ciudad ?? '';
        campo('pais').value = empresa.pais ?? '';
        campo('telefono').value = empresa.telefono ?? '';
        campo('correo').value = empresa.correo ?? '';
        campo('tipo_organizacion').value = empresa.tipo_organizacion ?? '';
        representanteSelect.value = empresa.representante_legal_id ?? '';

        loading.classList.add('hidden');
        formContainer.classList.remove('hidden');

    } catch (e) {
        console.error(e);
        loading.classList.add('hidden');
        error.classList.remove('hidden');
        error.textContent = e.message;
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const data = {
            razon_social: convertirMayusculas(campo('razon_social').value),
            nombre_comercial: convertirMayusculas(campo('nombre_comercial').value),
            nit: convertirMayusculas(campo('nit').value),
            matricula_comercio: convertirMayusculas(campo('matricula_comercio').value),
            direccion: convertirMayusculas(campo('direccion').value),
            ciudad: convertirMayusculas(campo('ciudad').value),
            pais: convertirMayusculas(campo('pais').value),
            telefono: convertirMayusculas(campo('telefono').value),
            correo: campo('correo').value.trim().toLowerCase(),
            tipo_organizacion: convertirMayusculas(campo('tipo_organizacion').value),
            representante_legal_id: representanteSelect.value || null,
            activo: true,
        };

        btnGuardar.disabled = true;
        btnGuardar.textContent = 'Guardando...';

        try {
            const response = await fetch(`/api/proponentes/${empresaId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (!response.ok) {
                let errores = '';

                if (result.errors) {
                    errores = Object.values(result.errors).flat().join('<br>');
                }

                throw new Error(errores || result.message || 'No se pudo actualizar la empresa.');
            }

            mostrarMensaje('Empresa actualizada correctamente. Redirigiendo...', 'success');

            setTimeout(() => {
                window.location.href = '/empresas';
            }, 900);

        } catch (error) {
            mostrarMensaje(error.message, 'error');
        } finally {
            btnGuardar.disabled = false;
            btnGuardar.textContent = 'Guardar cambios';
        }
    });
});
</script>
@endsection