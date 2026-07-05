<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;

    protected $table = 'persona.personas';   // ← AGREGAR esta línea nueva

    protected $primaryKey = 'id_persona';

    protected $fillable = [
        'nombres', 'apellido_paterno', 'apellido_materno', 'ci', 'ci_expedido',
        'direccion', 'telefono', 'correo', 'fecha_nacimiento', 'activo',
    ];

    public function proponentesRepresentados()
    {
        return $this->hasMany(Proponente::class, 'representante_legal_id');
    }

    public function proponentes()
    {
        return $this->belongsToMany(
            Proponente::class,
            'contratacion.proponente_personal',   // ← CAMBIAR: agregar el prefijo "contratacion."
            'id_persona',
            'id_proponente'
        )->withPivot('id_cargo', 'es_firmante', 'orden_firma')->withTimestamps();
    }
}