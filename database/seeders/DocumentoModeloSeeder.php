<?php

namespace Database\Seeders;

use App\Models\DocumentoModelo;
use Illuminate\Database\Seeder;

class DocumentoModeloSeeder extends Seeder
{
    public function run(): void
    {
        $modelos = [
            ['codigo_modelo' => 'MODELO_1', 'nombre_modelo' => 'Carta de Presentación de la Propuesta', 'archivo_template' => 'modelo_1_carta_presentacion.docx'],
            ['codigo_modelo' => 'MODELO_2', 'nombre_modelo' => 'Etiqueta de Sobres', 'archivo_template' => 'modelo_2_etiqueta_sobres.docx'],
            ['codigo_modelo' => 'MODELO_3', 'nombre_modelo' => 'Tapa de Propuesta', 'archivo_template' => 'modelo_3_tapa_propuesta.docx'],
            ['codigo_modelo' => 'MODELO_4', 'nombre_modelo' => 'Formulario de Propuesta N°4', 'archivo_template' => 'modelo_4.docx'],
            ['codigo_modelo' => 'MODELO_5', 'nombre_modelo' => 'Formulario de Propuesta N°5', 'archivo_template' => 'modelo_5.docx'],
            ['codigo_modelo' => 'MODELO_7', 'nombre_modelo' => 'Declaración de Integridad', 'archivo_template' => 'modelo_7_declaracion_integridad.docx'],
            ['codigo_modelo' => 'MODELO_8', 'nombre_modelo' => 'Formulario de Propuesta N°8', 'archivo_template' => 'modelo_8.docx'],
            ['codigo_modelo' => 'MODELO_11', 'nombre_modelo' => 'Propuesta Económica', 'archivo_template' => 'modelo_11_propuesta_economica.docx'],
        ];

        foreach ($modelos as $modelo) {
            DocumentoModelo::firstOrCreate(['codigo_modelo' => $modelo['codigo_modelo']], $modelo);
        }
    }
}