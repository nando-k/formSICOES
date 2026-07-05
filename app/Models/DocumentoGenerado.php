<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoGenerado extends Model
{
    use SoftDeletes;

    protected $table = 'documentacion.documentos_generados';   // ← AGREGAR
    protected $primaryKey = 'id_documento_generado';

    protected $fillable = [
        'id_convocatoria', 'id_documento_modelo', 'nombre_archivo',
        'ruta_archivo', 'fecha_generacion', 'generado_por',
    ];

    public function convocatoria()
    {
        return $this->belongsTo(Convocatoria::class, 'id_convocatoria', 'id_convocatoria');
    }

    public function documentoModelo()
    {
        return $this->belongsTo(DocumentoModelo::class, 'id_documento_modelo', 'id_documento_modelo');
    }
}