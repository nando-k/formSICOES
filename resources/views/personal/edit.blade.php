@extends('layouts.app')

@section('title', 'Editar persona')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-cyan-950 via-slate-900 to-blue-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-cyan-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-cyan-300 text-sm font-medium mb-2">
                    Actualización de personal
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Editar persona
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Modifique los datos personales y profesionales registrados.
                </p>
            </div>

            <a href="/personal" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                Volver al listado
            </a>
        </div>
    </div>

    <div id="loading" class="bg-white border border-slate-200 rounded-3xl p-6 text-slate-500 shadow-sm">
        Cargando persona...
    </div>

    <div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5">
        No se pudo cargar la persona.
    </div>

    <div id="formContainer" class="hidden bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-5xl">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="font-bold text-slate-900">Datos de la persona</h4>
            <p class="text-sm text-slate-500 mt-1">
                Actualice la información registrada.
            </p>
        </div>

        <form id="personaForm" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nombres</label>
                <input name="nombres" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido paterno</label>
                <input name="apellido_paterno" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido materno</label>
                <input name="apellido_materno" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">CI</label>
                <input name="ci" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Expedido</label>
                <input name="ci_expedido" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition" placeholder="LP">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                <input name="telefono" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                <input name="correo" type="email" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Profesión</label>
                <input name="profesion" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Dirección</label>
                <textarea name="direccion" rows="2" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition"></textarea>
            </div>

            <div class="md:col-span-2">
                <div id="mensaje" class="hidden rounded-2xl p-4 text-sm border"></div>
            </div>

            <div class="md:col-span-2 flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="/personal" class="px-5 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 text-center">
                    Cancelar
                </a>

                <button type="submit" id="btnGuardar" class="bg-cyan-600 text-white px-5 py-3 rounded-2xl hover:bg-cyan-500 shadow-lg shadow-cyan-950/20 font-semibold transition">
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
    const personaId = @json($id);

    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const formContainer = document.getElementById('formContainer');
    const form = document.getElementById('personaForm');
    const mensaje = document.getElementById('mensaje');
    const btnGuardar = document.getElementById('btnGuardar');

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

    try {
        const response = await fetch(`/api/personas/${personaId}`, {
            headers: {
                'Accept': 'application/json',
            }
        });

        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.message || 'No se pudo cargar la persona.');
        }

        const persona = result.data ?? result.persona ?? result;

        campo('nombres').value = persona.nombres ?? '';
        campo('apellido_paterno').value = persona.apellido_paterno ?? '';
        campo('apellido_materno').value = persona.apellido_materno ?? '';
        campo('ci').value = persona.ci ?? '';
        campo('ci_expedido').value = persona.ci_expedido ?? '';
        campo('telefono').value = persona.telefono ?? '';
        campo('correo').value = persona.correo ?? '';
        campo('profesion').value = persona.profesion ?? '';
        campo('direccion').value = persona.direccion ?? '';

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
            nombres: convertirMayusculas(campo('nombres').value),
            apellido_paterno: convertirMayusculas(campo('apellido_paterno').value),
            apellido_materno: convertirMayusculas(campo('apellido_materno').value),
            ci: convertirMayusculas(campo('ci').value),
            ci_expedido: convertirMayusculas(campo('ci_expedido').value),
            telefono: convertirMayusculas(campo('telefono').value),
            correo: campo('correo').value.trim().toLowerCase(),
            profesion: convertirMayusculas(campo('profesion').value),
            direccion: convertirMayusculas(campo('direccion').value),
            fecha_nacimiento: null,
        };

        btnGuardar.disabled = true;
        btnGuardar.textContent = 'Guardando...';

        try {
            const response = await fetch(`/api/personas/${personaId}`, {
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

                throw new Error(errores || result.message || 'No se pudo actualizar la persona.');
            }

            mostrarMensaje('Persona actualizada correctamente. Redirigiendo...', 'success');

            setTimeout(() => {
                window.location.href = '/personal';
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