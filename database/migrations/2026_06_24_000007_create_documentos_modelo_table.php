<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('documentos_modelo', function (Blueprint $table) {
            $table->id('id_documento_modelo');
            $table->string('nombre_modelo', 150);
            $table->string('codigo_modelo', 50)->unique();
            $table->text('descripcion')->nullable();
            $table->string('archivo_template', 255);
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void { Schema::dropIfExists('documentos_modelo'); }
};