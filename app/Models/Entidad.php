<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entidad extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_entidad';

    protected $fillable = [
        'nombre_entidad', 'direccion', 'ciudad', 'telefono', 'correo',
        'contacto', 'cargo_contacto',
    ];

    public function convocatorias()
    {
        return $this->hasMany(Convocatoria::class, 'id_entidad', 'id_entidad');
    }
}