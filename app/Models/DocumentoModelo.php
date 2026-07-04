<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoModelo extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_documento_modelo';

    protected $fillable = [
        'nombre_modelo', 'codigo_modelo', 'descripcion', 'archivo_template', 'activo',
    ];

    public function documentosGenerados()
    {
        return $this->hasMany(DocumentoGenerado::class, 'id_documento_modelo', 'id_documento_modelo');
    }
}