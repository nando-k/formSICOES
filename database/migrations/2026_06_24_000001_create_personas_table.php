<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('personas', function (Blueprint $table) {
            $table->id('id_persona');
            $table->string('nombres', 150);
            $table->string('apellido_paterno', 100)->nullable();
            $table->string('apellido_materno', 100)->nullable();
            $table->string('ci', 30);
            $table->string('ci_expedido', 10)->nullable();
            $table->text('direccion')->nullable();
            $table->string('telefono', 100)->nullable();
            $table->string('correo', 150)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['ci', 'ci_expedido']);
        });
    }
    public function down(): void { Schema::dropIfExists('personas'); }
};