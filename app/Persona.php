<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;

    protected $table='personas';
    protected $fillable = [
        'full_name',
        'email',
        'legajo',
        'sector_id'
    ];

    protected $dates = ['deleted_at'];

    public function sector (){

        return $this->belongsTo('App\Sector');

    }
}
