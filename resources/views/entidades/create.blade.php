@extends('layouts.app')

@section('title', 'Nueva entidad')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-purple-950 via-slate-900 to-indigo-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-purple-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-purple-300 text-sm font-medium mb-2">
                    Registro de entidad convocante
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Nueva entidad
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Registre la institución o entidad convocante que será utilizada en las convocatorias y documentos generados.
                </p>
            </div>

            <a href="/entidades" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                Volver al listado
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-6xl">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="font-bold text-slate-900">Datos de la entidad</h4>
            <p class="text-sm text-slate-500 mt-1">
                Complete los datos principales de la entidad convocante.
            </p>
        </div>

        <form id="entidadForm" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre de la entidad</label>
                <input 
                    name="nombre_entidad" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition" 
                    placeholder="Caja Nacional de Salud"
                >
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Dirección</label>
                <textarea 
                    name="direccion" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition" 
                    rows="2" 
                    placeholder="Dirección de la entidad"
                ></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Ciudad</label>
                <input 
                    name="ciudad" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition" 
                    placeholder="La Paz"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                <input 
                    name="telefono" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition" 
                    placeholder="2243214"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                <input 
                    name="correo" 
                    type="email" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition" 
                    placeholder="correo@entidad.gob.bo"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Contacto</label>
                <input 
                    name="contacto" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition" 
                    placeholder="Nombre del contacto"
                >
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Cargo del contacto</label>
                <input 
                    name="cargo_contacto" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition" 
                    placeholder="Responsable de contratación"
                >
            </div>

            <div class="md:col-span-2">
                <div id="mensaje" class="hidden rounded-2xl p-4 text-sm border"></div>
            </div>

            <div class="md:col-span-2 flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="/entidades" class="px-5 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 text-center">
                    Cancelar
                </a>

                <button 
                    type="submit" 
                    id="btnGuardar"
                    class="bg-purple-600 text-white px-5 py-3 rounded-2xl hover:bg-purple-500 shadow-lg shadow-purple-950/20 font-semibold transition"
                >
                    Guardar entidad
                </button>
            </div>
        </form>
    </div>

</div>

<script>
document.getElementById('entidadForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const mensaje = document.getElementById('mensaje');
    const btnGuardar = document.getElementById('btnGuardar');

    const data = {
        nombre_entidad: form.nombre_entidad.value,
        direccion: form.direccion.value,
        ciudad: form.ciudad.value,
        telefono: form.telefono.value,
        correo: form.correo.value,
        contacto: form.contacto.value,
        cargo_contacto: form.cargo_contacto.value,
    };

    btnGuardar.disabled = true;
    btnGuardar.textContent = 'Guardando...';

    try {
        const response = await fetch('/api/entidades', {
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

            throw new Error(result.message || errores || 'No se pudo guardar la entidad.');
        }

        mensaje.className = 'rounded-2xl p-4 text-sm border bg-green-50 text-green-700 border-green-200';
        mensaje.innerHTML = 'Entidad guardada correctamente. Redirigiendo...';

        setTimeout(() => {
            window.location.href = '/entidades';
        }, 900);

    } catch (error) {
        mensaje.className = 'rounded-2xl p-4 text-sm border bg-red-50 text-red-700 border-red-200';
        mensaje.innerHTML = error.message;
    } finally {
        btnGuardar.disabled = false;
        btnGuardar.textContent = 'Guardar entidad';
    }
});
</script>
@endsection