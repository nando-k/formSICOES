<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('plantilla_campos', function (Blueprint $table) {
            $table->id('id_campo');
            $table->string('nombre_campo', 100);
            $table->text('descripcion')->nullable();
            $table->string('tabla_origen', 100);
            $table->string('campo_origen', 100);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['tabla_origen', 'campo_origen']);
        });
    }
    public function down(): void { Schema::dropIfExists('plantilla_campos'); }
};