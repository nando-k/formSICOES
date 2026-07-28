@extends('layouts.app')

@section('title', 'Nueva entidad')

@section('content')
<div class="bg-white rounded-xl shadow-sm border p-6 max-w-5xl">
    <h3 class="text-lg font-semibold mb-1">Datos de la entidad</h3>
    <p class="text-sm text-slate-500 mb-6">
        Registre la institución o entidad convocante.
    </p>

    <form id="entidadForm" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Nombre de la entidad</label>
            <input name="nombre_entidad" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Caja Nacional de Salud">
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Dirección</label>
            <textarea name="direccion" class="w-full border rounded-lg px-3 py-2" rows="2" placeholder="Dirección de la entidad"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Ciudad</label>
            <input name="ciudad" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="La Paz">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Teléfono</label>
            <input name="telefono" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="2243214">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Correo electrónico</label>
            <input name="correo" type="email" class="w-full border rounded-lg px-3 py-2" placeholder="correo@entidad.gob.bo">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Contacto</label>
            <input name="contacto" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Nombre del contacto">
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Cargo del contacto</label>
            <input name="cargo_contacto" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Responsable de contratación">
        </div>

        <div class="md:col-span-2 flex justify-end gap-3 pt-4">
            <a href="/entidades" class="px-4 py-2 rounded-lg border">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Guardar entidad
            </button>
        </div>
    </form>

    <div id="mensaje" class="hidden mt-5 rounded-lg p-4 text-sm border"></div>
</div>

<script>
document.getElementById('entidadForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const mensaje = document.getElementById('mensaje');

    const data = {
        nombre_entidad: form.nombre_entidad.value,
        direccion: form.direccion.value,
        ciudad: form.ciudad.value,
        telefono: form.telefono.value,
        correo: form.correo.value,
        contacto: form.contacto.value,
        cargo_contacto: form.cargo_contacto.value,
    };

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
                errores = Object.values(result.errors).flat().join(' ');
            }

            throw new Error(result.message || errores || 'No se pudo guardar la entidad.');
        }

        mensaje.className = 'mt-5 rounded-lg p-4 text-sm border bg-green-50 text-green-700 border-green-200';
        mensaje.textContent = 'Entidad guardada correctamente. Redirigiendo...';

        setTimeout(() => {
            window.location.href = '/entidades';
        }, 1000);

    } catch (error) {
        mensaje.className = 'mt-5 rounded-lg p-4 text-sm border bg-red-50 text-red-700 border-red-200';
        mensaje.textContent = error.message;
    }
});
</script>
@endsection