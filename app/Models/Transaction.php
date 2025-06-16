<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    // Permitir la asignación masiva
    protected $fillable = [
        'instancia_id',
        'payment_id',
        'status',
    ];

    public function instancia()
    {
        return $this->belongsTo(Instancia::class);
    }
}
