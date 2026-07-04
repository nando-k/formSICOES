<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_cargo';

    protected $fillable = ['nombre_cargo', 'descripcion'];

    public function asignaciones()
    {
        return $this->hasMany(ProponentePersonal::class, 'id_cargo', 'id_cargo');
    }
}