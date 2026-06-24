<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('convocatorias', function (Blueprint $table) {
            $table->id('id_convocatoria');
            $table->foreignId('id_entidad')->constrained('entidades', 'id_entidad')->restrictOnDelete();
            $table->foreignId('id_proponente')->constrained('proponentes', 'id_proponente')->restrictOnDelete();
            $table->string('cite', 100)->nullable();
            $table->string('numero_convocatoria', 150);
            $table->string('cuce', 100)->nullable();
            $table->text('objeto');
            $table->text('lugar_entrega')->nullable();
            $table->date('fecha_presentacion')->nullable();
            $table->time('hora_apertura')->nullable();
            $table->date('fecha_apertura')->nullable();
            $table->decimal('monto', 12, 2)->nullable();
            $table->string('monto_literal', 255)->nullable();
            $table->integer('plazo_propuesta_dias')->nullable();
            $table->string('estado', 50)->default('ACTIVO');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['id_entidad', 'numero_convocatoria']);
        });
    }
    public function down(): void { Schema::dropIfExists('convocatorias'); }
};