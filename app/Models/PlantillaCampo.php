<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantillaCampo extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_campo';

    protected $fillable = [
        'nombre_campo', 'descripcion', 'tabla_origen', 'campo_origen',
    ];
}