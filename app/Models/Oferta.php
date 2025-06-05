<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Negocio;
use App\Models\User;

class Oferta extends Model
{
    protected $table = 'ofertas';

    protected $fillable = [
        'nombre',
        'precio_original',
        'precio_oferta',
        'imagen',
        'negocio_id'
    ];

    public function negocio()
    {
        return $this->belongsTo(Negocio::class);
    }
}

