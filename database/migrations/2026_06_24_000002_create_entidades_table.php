<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('entidades', function (Blueprint $table) {
            $table->id('id_entidad');
            $table->string('nombre_entidad', 255);
            $table->text('direccion')->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->string('telefono', 100)->nullable();
            $table->string('correo', 150)->nullable();
            $table->string('contacto', 150)->nullable();
            $table->string('cargo_contacto', 150)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void { Schema::dropIfExists('entidades'); }
};
