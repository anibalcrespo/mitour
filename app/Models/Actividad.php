<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';
    
    // Permitir la asignación masiva para el campo 'descripcion'
    protected $fillable = [
        'tipo_actividad_id',
        'titulo', 
        'descripcion',
        'image1',
        'image2',
        'image3',
    ];

    public function tipo_actividad() {
        return $this->belongsTo(TipoActividad::class);
    }
}

