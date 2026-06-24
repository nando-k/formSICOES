<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('documentos_generados', function (Blueprint $table) {
            $table->id('id_documento_generado');
            $table->foreignId('id_convocatoria')->constrained('convocatorias', 'id_convocatoria')->cascadeOnDelete();
            $table->foreignId('id_documento_modelo')->constrained('documentos_modelo', 'id_documento_modelo')->restrictOnDelete();
            $table->string('nombre_archivo', 255);
            $table->string('ruta_archivo', 255);
            $table->dateTime('fecha_generacion')->useCurrent();
            $table->string('generado_por', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void { Schema::dropIfExists('documentos_generados'); }
};