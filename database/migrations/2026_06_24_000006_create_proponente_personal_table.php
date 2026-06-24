<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('proponente_personal', function (Blueprint $table) {
            $table->id('id_proponente_personal');
            $table->foreignId('id_proponente')->constrained('proponentes', 'id_proponente')->cascadeOnDelete();
            $table->foreignId('id_persona')->constrained('personas', 'id_persona')->restrictOnDelete();
            $table->foreignId('id_cargo')->constrained('cargos', 'id_cargo')->restrictOnDelete();
            $table->boolean('es_firmante')->default(false);
            $table->integer('orden_firma')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['id_proponente', 'id_persona', 'id_cargo']);
        });
    }
    public function down(): void { Schema::dropIfExists('proponente_personal'); }
};