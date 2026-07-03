@extends('layouts.app')

@section('title', 'Nueva convocatoria')

@section('content')
<div class="bg-white rounded-xl shadow-sm border p-6 max-w-5xl">
    <h3 class="text-lg font-semibold mb-1">Datos de la convocatoria</h3>
    <p class="text-sm text-slate-500 mb-6">Complete la información principal del proceso.</p>

    <form class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium mb-1">Entidad convocante</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Caja Nacional de Salud">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Nro. convocatoria</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="CH LP - 085/2023">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">CUCE</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="23-1404-00-1345364-1-1">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Tipo de convocatoria</label>
            <select class="w-full border rounded-lg px-3 py-2">
                <option>Primera Convocatoria</option>
                <option>Segunda Convocatoria</option>
            </select>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Objeto de contratación</label>
            <textarea class="w-full border rounded-lg px-3 py-2" rows="3" placeholder="Servicio de auditoría externa..."></textarea>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Lugar de entrega</label>
            <textarea class="w-full border rounded-lg px-3 py-2" rows="2" placeholder="Dirección donde se entrega la propuesta"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Fecha de apertura</label>
            <input type="date" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Hora de apertura</label>
            <input type="time" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Resolución administrativa Nro.</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="07/2023">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Fecha de resolución</label>
            <input type="date" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Plazo de validez en días</label>
            <input type="number" class="w-full border rounded-lg px-3 py-2" placeholder="60">
        </div>

        <div class="md:col-span-2 flex justify-end gap-3 pt-4">
            <a href="/convocatorias" class="px-4 py-2 rounded-lg border">
                Cancelar
            </a>
            <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Guardar convocatoria
            </button>
        </div>
    </form>
</div>
@endsection