<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoPromocional extends Model
{
    use HasFactory;

    // Especificado el nombre de tabla porque la pluralización de Laravel no cuadra con este caso
    protected $table = 'codigos_promocionales';

    protected $fillable = [
        'codigo',
        'is_canjeado',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
