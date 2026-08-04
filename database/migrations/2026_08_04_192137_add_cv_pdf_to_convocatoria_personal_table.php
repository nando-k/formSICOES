<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contratacion.convocatoria_personal', function (Blueprint $table) {
            $table->string('cv_pdf')->nullable()->after('activo');
            $table->string('cv_nombre_original')->nullable()->after('cv_pdf');
            $table->timestamp('cv_fecha_subida')->nullable()->after('cv_nombre_original');
        });
    }

    public function down(): void
    {
        Schema::table('contratacion.convocatoria_personal', function (Blueprint $table) {
            $table->dropColumn([
                'cv_pdf',
                'cv_nombre_original',
                'cv_fecha_subida',
            ]);
        });
    }
};