<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfertaActivada extends Model
{
    protected $table = 'ofertas_activadas';

    protected $fillable = [
        'oferta_id',
        'user_id',
    ];

    // Relación con la oferta
    public function oferta()
    {
        return $this->belongsTo(Oferta::class);
    }

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}