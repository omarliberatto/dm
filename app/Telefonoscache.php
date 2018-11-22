<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefonoscache extends Model
{

    protected $table='telefonoscache';
    protected $fillable = [
        'tipo_telefono_id',
        'lugar_id',
        'persona_id',
        'visible'
    ];

    public function telefonostipo (){

        return $this->belongsTo('App\Telefonostipo');

    }

    public function lugar (){

        return $this->belongsTo('App\Lugar');

    }

    public function persona (){

        return $this->belongsTo('App\Persona');

    }

}
