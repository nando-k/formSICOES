@extends('layouts.app')

@section('title', 'Nuevo personal')

@section('content')
<div class="bg-white rounded-xl shadow-sm border p-6 max-w-5xl">
    <h3 class="text-lg font-semibold mb-1">Datos del personal</h3>
    <p class="text-sm text-slate-500 mb-6">
        Registre los datos de las personas que participarán en las propuestas.
    </p>

    <form class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium mb-1">Nombres</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Sandra Irene">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Apellido paterno</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Rodríguez">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Apellido materno</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Callisaya">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Cargo</label>
            <select class="w-full border rounded-lg px-3 py-2">
                <option>Representante Legal</option>
                <option>Socia de la Firma de Auditoría</option>
                <option>Gerente de Auditoría</option>
                <option>Supervisor de Auditoría</option>
                <option>Auditor Junior</option>
                <option>Especialista</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Cédula de identidad</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="4791992">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Expedido</label>
            <select class="w-full border rounded-lg px-3 py-2">
                <option>LP</option>
                <option>CB</option>
                <option>SC</option>
                <option>OR</option>
                <option>PT</option>
                <option>CH</option>
                <option>TJ</option>
                <option>BN</option>
                <option>PD</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Teléfono</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="73008644">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Correo electrónico</label>
            <input type="email" class="w-full border rounded-lg px-3 py-2" placeholder="correo@empresa.com">
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Dirección</label>
            <textarea class="w-full border rounded-lg px-3 py-2" rows="2" placeholder="Dirección de la persona"></textarea>
        </div>

        <div class="md:col-span-2 flex justify-end gap-3 pt-4">
            <a href="/personal" class="px-4 py-2 rounded-lg border">
                Cancelar
            </a>
            <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Guardar personal
            </button>
        </div>
    </form>
</div>
@endsection