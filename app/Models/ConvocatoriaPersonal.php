<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConvocatoriaPersonal extends Model
{
    use SoftDeletes;

    protected $table = 'contratacion.convocatoria_personal';
    protected $primaryKey = 'id_convocatoria_personal';

    protected $fillable = [
        'id_convocatoria',
        'id_persona',
        'id_cargo',
        'es_firmante',
        'orden_firma',
        'activo',
        'cv_pdf',
        'cv_nombre_original',
        'cv_fecha_subida',
    ];

    public function convocatoria()
    {
        return $this->belongsTo(Convocatoria::class, 'id_convocatoria', 'id_convocatoria');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id_persona');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'id_cargo', 'id_cargo');
    }
}