<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    public $table = 'denuncias';
    
    protected $primaryKey = 'den_id';

    protected $fillable = [
        'den_observacao',
        'den_quantidade_pessoas',
        'den_geoposicao',
    ];


}
