<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;

    protected $table = 'persona.personas';  

    protected $primaryKey = 'id_persona';

    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'ci',
        'ci_expedido',
        'direccion',
        'telefono',
        'correo',
        'profesion',
        'fecha_nacimiento',
    ];

    public function creadoPor()
    {
        return $this->belongsTo(User::class, 'creado_por_id');
    }

    public function actualizadoPor()
    {
        return $this->belongsTo(User::class, 'actualizado_por_id');
    }

    public function eliminadoPor()
    {
        return $this->belongsTo(User::class, 'eliminado_por_id');
    }

    public function proponentesRepresentados()
    {
        return $this->hasMany(Proponente::class, 'representante_legal_id');
    }

    public function proponentes()
    {
        return $this->belongsToMany(
            Proponente::class,
            'contratacion.proponente_personal',   
            'id_persona',
            'id_proponente'
        )->withPivot('id_cargo', 'es_firmante', 'orden_firma')->withTimestamps();
    }
}