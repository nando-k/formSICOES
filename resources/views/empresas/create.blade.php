@extends('layouts.app')

@section('title', 'Nueva empresa')

@section('content')
<div class="bg-white rounded-xl shadow-sm border p-6 max-w-5xl">
    <h3 class="text-lg font-semibold mb-1">Datos de la empresa</h3>
    <p class="text-sm text-slate-500 mb-6">
        Registre la información del proponente que será utilizada en los formularios.
    </p>

    <form class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Razón social</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="CONSULTORA INTEGRAL DE SERVICIOS DE AUDITORIA Y FINANZAS - CIDSAF S.R.L.">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Tipo de organización</label>
            <select class="w-full border rounded-lg px-3 py-2">
                <option>Sociedad de Responsabilidad Limitada</option>
                <option>Sociedad Accidental</option>
                <option>Profesional Independiente</option>
                <option>Otra</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">NIT</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="406312025">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Matrícula de comercio</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="406312025">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Matrícula anterior</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="00280544">
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Dirección</label>
            <textarea class="w-full border rounded-lg px-3 py-2" rows="2" placeholder="Calle República Dominicana Nro. 1900, Zona Miraflores"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Ciudad</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="La Paz">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">País</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Bolivia">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Teléfono</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="2243214 - 73008644">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Correo electrónico</label>
            <input type="email" class="w-full border rounded-lg px-3 py-2" placeholder="cidsaf.srl@gmail.com">
        </div>

        <div class="md:col-span-2 flex justify-end gap-3 pt-4">
            <a href="/empresas" class="px-4 py-2 rounded-lg border">
                Cancelar
            </a>
            <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Guardar empresa
            </button>
        </div>
    </form>
</div>
@endsection