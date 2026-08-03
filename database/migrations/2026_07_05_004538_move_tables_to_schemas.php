<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("CREATE SCHEMA IF NOT EXISTS persona");
        DB::statement("CREATE SCHEMA IF NOT EXISTS documentacion");
        DB::statement("CREATE SCHEMA IF NOT EXISTS seguridad");
        DB::statement("CREATE SCHEMA IF NOT EXISTS contratacion");

        $moves = [
            'personas' => 'persona',
            'documentos_modelo' => 'documentacion',
            'documentos_generados' => 'documentacion',
            'plantilla_campos' => 'documentacion',
            'users' => 'seguridad',
            'password_reset_tokens' => 'seguridad',
            'sessions' => 'seguridad',
            'personal_access_tokens' => 'seguridad',
            'entidades' => 'contratacion',
            'cargos' => 'contratacion',
            'proponentes' => 'contratacion',
            'convocatorias' => 'contratacion',
            'proponente_personal' => 'contratacion',
        ];

        foreach ($moves as $table => $schema) {
            $sourceExists = DB::select("
                SELECT to_regclass('public.\"{$table}\"') AS table_name
            ")[0]->table_name;

            $targetExists = DB::select("
                SELECT to_regclass('{$schema}.\"{$table}\"') AS table_name
            ")[0]->table_name;

            if ($sourceExists && !$targetExists) {
                DB::statement("ALTER TABLE public.\"{$table}\" SET SCHEMA {$schema}");
            }
        }
    }

    public function down(): void
    {
        $schemas = ['persona', 'documentacion', 'seguridad', 'contratacion'];

        $tables = [
            'personas',
            'documentos_modelo',
            'documentos_generados',
            'plantilla_campos',
            'users',
            'password_reset_tokens',
            'sessions',
            'personal_access_tokens',
            'entidades',
            'cargos',
            'proponentes',
            'convocatorias',
            'proponente_personal',
        ];

        foreach ($tables as $table) {
            foreach ($schemas as $schema) {
                DB::statement("ALTER TABLE IF EXISTS {$schema}.\"{$table}\" SET SCHEMA public");
            }
        }
    }
};