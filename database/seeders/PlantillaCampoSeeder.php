<?php

namespace Database\Seeders;

use App\Models\PlantillaCampo;
use Illuminate\Database\Seeder;

class PlantillaCampoSeeder extends Seeder
{
    public function run(): void
    {
        $campos = [
            // Datos de la entidad convocante
            ['nombre_campo' => 'nombre_entidad', 'tabla_origen' => 'entidades', 'campo_origen' => 'nombre_entidad', 'descripcion' => 'Nombre de la entidad convocante'],
            ['nombre_campo' => 'direccion_entidad', 'tabla_origen' => 'entidades', 'campo_origen' => 'direccion', 'descripcion' => 'Direccion de la entidad'],

            // Datos de la convocatoria
            ['nombre_campo' => 'numero_convocatoria', 'tabla_origen' => 'convocatorias', 'campo_origen' => 'numero_convocatoria', 'descripcion' => 'Numero de convocatoria'],
            ['nombre_campo' => 'cuce', 'tabla_origen' => 'convocatorias', 'campo_origen' => 'cuce', 'descripcion' => 'Codigo unico de contratacion estatal'],
            ['nombre_campo' => 'objeto_contratacion', 'tabla_origen' => 'convocatorias', 'campo_origen' => 'objeto', 'descripcion' => 'Objeto de la contratacion'],
            ['nombre_campo' => 'lugar_entrega', 'tabla_origen' => 'convocatorias', 'campo_origen' => 'lugar_entrega', 'descripcion' => 'Lugar de entrega de la propuesta'],
            ['nombre_campo' => 'fecha_apertura', 'tabla_origen' => 'convocatorias', 'campo_origen' => 'fecha_apertura', 'descripcion' => 'Fecha de apertura de la propuesta'],
            ['nombre_campo' => 'monto_propuesta', 'tabla_origen' => 'convocatorias', 'campo_origen' => 'monto', 'descripcion' => 'Monto de la propuesta economica'],
            ['nombre_campo' => 'monto_literal', 'tabla_origen' => 'convocatorias', 'campo_origen' => 'monto_literal', 'descripcion' => 'Monto en letras'],

            // Datos del proponente
            ['nombre_campo' => 'razon_social', 'tabla_origen' => 'proponentes', 'campo_origen' => 'razon_social', 'descripcion' => 'Razon social del proponente'],
            ['nombre_campo' => 'nit', 'tabla_origen' => 'proponentes', 'campo_origen' => 'nit', 'descripcion' => 'NIT del proponente'],
            ['nombre_campo' => 'direccion_proponente', 'tabla_origen' => 'proponentes', 'campo_origen' => 'direccion', 'descripcion' => 'Direccion del proponente'],
            ['nombre_campo' => 'telefono_proponente', 'tabla_origen' => 'proponentes', 'campo_origen' => 'telefono', 'descripcion' => 'Telefono del proponente'],

            // Datos del representante legal (persona)
            ['nombre_campo' => 'nombre_representante', 'tabla_origen' => 'personas', 'campo_origen' => 'nombres', 'descripcion' => 'Nombres del representante legal'],
            ['nombre_campo' => 'apellido_representante', 'tabla_origen' => 'personas', 'campo_origen' => 'apellido_paterno', 'descripcion' => 'Apellido paterno del representante legal'],
            ['nombre_campo' => 'ci_representante', 'tabla_origen' => 'personas', 'campo_origen' => 'ci', 'descripcion' => 'Cedula de identidad del representante legal'],
        ];

        foreach ($campos as $campo) {
            PlantillaCampo::firstOrCreate(
                ['tabla_origen' => $campo['tabla_origen'], 'campo_origen' => $campo['campo_origen']],
                $campo
            );
        }
    }
}