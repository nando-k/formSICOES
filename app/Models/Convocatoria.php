<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Convocatoria extends Model
{
    use SoftDeletes;

    protected $table = 'contratacion.convocatorias';
    protected $primaryKey = 'id_convocatoria';

    protected $fillable = [
        'id_entidad',
        'id_proponente',
        'cite',
        'numero_convocatoria',
        'cuce',
        'objeto',
        'lugar_entrega',
        'fecha_presentacion',
        'hora_apertura',
        'fecha_apertura',
        'monto',
        'monto_literal',
        'plazo_propuesta_dias',
        'estado',
    ];

    public function entidad()
    {
        return $this->belongsTo(Entidad::class, 'id_entidad', 'id_entidad');
    }

    public function proponente()
    {
        return $this->belongsTo(Proponente::class, 'id_proponente', 'id_proponente');
    }

    public function documentosGenerados()
    {
        return $this->hasMany(DocumentoGenerado::class, 'id_convocatoria', 'id_convocatoria');
    }

    public function personalConvocatoria()
    {
        return $this->hasMany(ConvocatoriaPersonal::class, 'id_convocatoria', 'id_convocatoria');
    }

    public function personas()
    {
        return $this->belongsToMany(
            Persona::class,
            'contratacion.convocatoria_personal',
            'id_convocatoria',
            'id_persona'
        )->withPivot('id_cargo', 'es_firmante', 'orden_firma', 'activo')
         ->withTimestamps();
    }
}