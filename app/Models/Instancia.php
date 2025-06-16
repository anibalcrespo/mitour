<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instancia extends Model
{
    use HasFactory;

    protected $table = 'instancias';
    
    // Permitir la asignación masiva
    protected $fillable = [
        'actividad_id',
        'precio',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'direccion'
    ];

    public function actividad() {
        return $this->belongsTo(Actividad::class);
    }

    public function cant_transactions() {
        return $this->hasMany(Transaction::class);
    }
}

