<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProponentePersonal extends Model
{
    use SoftDeletes;

    protected $table = 'proponente_personal';
    protected $primaryKey = 'id_proponente_personal';

    protected $fillable = [
        'id_proponente', 'id_persona', 'id_cargo', 'es_firmante', 'orden_firma', 'activo',
    ];

    public function proponente()
    {
        return $this->belongsTo(Proponente::class, 'id_proponente', 'id_proponente');
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