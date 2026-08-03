<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contratacion.convocatoria_personal', function (Blueprint $table) {
            $table->id('id_convocatoria_personal');

            $table->unsignedBigInteger('id_convocatoria');
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_cargo')->nullable();

            $table->boolean('es_firmante')->default(false);
            $table->integer('orden_firma')->nullable();
            $table->boolean('activo')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['id_convocatoria', 'id_persona'], 'convocatoria_personal_unique');

            $table->foreign('id_convocatoria')
                ->references('id_convocatoria')
                ->on('contratacion.convocatorias')
                ->onDelete('cascade');

            $table->foreign('id_persona')
                ->references('id_persona')
                ->on('persona.personas')
                ->onDelete('cascade');

            $table->foreign('id_cargo')
                ->references('id_cargo')
                ->on('contratacion.cargos')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contratacion.convocatoria_personal');
    }
};