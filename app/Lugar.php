<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\DataTables\Facades\DataTables;

class Lugar extends Model
{
    use SoftDeletes;

    protected $table='lugares';
    protected $fillable = [
        'name',
        'description',
        'ubicacion_id',
    ];

    protected $dates = ['deleted_at'];

    public function ubicacion (){

        return $this->belongsTo('App\Ubicacion');

    }

    public function getDatatable(){
        // Devuelve Json reducido con los datos que necesitamos, compatible con DataTables.
        $query = $this->join('ubicaciones', 'lugares.ubicacion_id', '=', 'ubicaciones.id')
            ->select([
                'lugares.id',
                'lugares.name',
                'lugares.description',
                'ubicaciones.name as ubicacion',
            ]);

        return Datatables::of($query)->make(true);

    }
}
