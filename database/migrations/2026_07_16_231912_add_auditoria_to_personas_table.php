<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('persona.personas', function (Blueprint $table) {
            $table->foreignId('creado_por_id')->nullable()->constrained('seguridad.users', 'id')->nullOnDelete();
            $table->foreignId('actualizado_por_id')->nullable()->constrained('seguridad.users', 'id')->nullOnDelete();
            $table->foreignId('eliminado_por_id')->nullable()->constrained('seguridad.users', 'id')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('persona.personas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('creado_por_id');
            $table->dropConstrainedForeignId('actualizado_por_id');
            $table->dropConstrainedForeignId('eliminado_por_id');
        });
    }
};