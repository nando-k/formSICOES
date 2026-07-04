<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proponente extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_proponente';

    protected $fillable = [
        'razon_social', 'nombre_comercial', 'nit', 'matricula_comercio',
        'direccion', 'ciudad', 'pais', 'telefono', 'correo',
        'tipo_organizacion', 'representante_legal_id', 'activo',
    ];

    public function representanteLegal()
    {
        return $this->belongsTo(Persona::class, 'representante_legal_id', 'id_persona');
    }

    public function convocatorias()
    {
        return $this->hasMany(Convocatoria::class, 'id_proponente', 'id_proponente');
    }

    public function personal()
    {
        return $this->belongsToMany(
            Persona::class,
            'proponente_personal',
            'id_proponente',
            'id_persona'
        )->withPivot('id_cargo', 'es_firmante', 'orden_firma')->withTimestamps();
    }
}