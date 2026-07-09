<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    public function run(): void
    {
        $cargos = [
            ['nombre_cargo' => 'Representante Legal', 'descripcion' => 'Firma y representa legalmente al proponente'],
            ['nombre_cargo' => 'Socio de la Firma', 'descripcion' => 'Socio de la consultora'],
            ['nombre_cargo' => 'Gerente de Auditoría', 'descripcion' => 'Responsable tecnico del equipo de auditoria'],
            ['nombre_cargo' => 'Supervisor', 'descripcion' => 'Profesional 1 - supervisor del equipo'],
            ['nombre_cargo' => 'Auditor Junior', 'descripcion' => 'Profesional 2 - auditor junior'],
            ['nombre_cargo' => 'Especialista', 'descripcion' => 'Especialista tecnico de apoyo'],
        ];

        foreach ($cargos as $cargo) {
            Cargo::firstOrCreate(['nombre_cargo' => $cargo['nombre_cargo']], $cargo);
        }
    }
}
