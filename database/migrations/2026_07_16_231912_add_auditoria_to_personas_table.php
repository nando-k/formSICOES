<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('persona.personas', function (Blueprint $table) {
            if (!Schema::hasColumn('persona.personas', 'creado_por_id')) {
                $table->unsignedBigInteger('creado_por_id')->nullable();
            }

            if (!Schema::hasColumn('persona.personas', 'actualizado_por_id')) {
                $table->unsignedBigInteger('actualizado_por_id')->nullable();
            }

            if (!Schema::hasColumn('persona.personas', 'eliminado_por_id')) {
                $table->unsignedBigInteger('eliminado_por_id')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('persona.personas', function (Blueprint $table) {
            if (Schema::hasColumn('persona.personas', 'creado_por_id')) {
                $table->dropColumn('creado_por_id');
            }

            if (Schema::hasColumn('persona.personas', 'actualizado_por_id')) {
                $table->dropColumn('actualizado_por_id');
            }

            if (Schema::hasColumn('persona.personas', 'eliminado_por_id')) {
                $table->dropColumn('eliminado_por_id');
            }
        });
    }
};