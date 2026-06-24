<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('proponentes', function (Blueprint $table) {
            $table->id('id_proponente');
            $table->string('razon_social', 255)->nullable();
            $table->string('nombre_comercial', 255)->nullable();
            $table->string('nit', 30)->nullable();
            $table->string('matricula_comercio', 50)->nullable();
            $table->text('direccion')->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->string('pais', 100)->nullable();
            $table->string('telefono', 100)->nullable();
            $table->string('correo', 150)->nullable();
            $table->string('tipo_organizacion', 100)->nullable();
            $table->foreignId('representante_legal_id')->nullable()->constrained('personas', 'id_persona')->nullOnDelete();
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->unique('nit');
        });
    }
    public function down(): void { Schema::dropIfExists('proponentes'); }
};
