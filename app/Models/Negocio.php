<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    protected $table = 'negocios';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'imagen',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ofertas()
    {
        return $this->hasMany(Oferta::class);
    }
}