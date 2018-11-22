<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\DataTables\Facades\DataTables;


class Sector extends Model
{
    use SoftDeletes;

    protected $table='sectores';
    protected $fillable = [
        'name',
        'email',
        'description',
        'area_id'
    ];

    protected $dates = ['deleted_at'];

    public function area (){

        return $this->belongsTo('App\Area');

    }

    public function getDatatable(){
        // Devuelve Json reducido con los datos que necesitamos, compatible con DataTables.
        $query = $this->join('areas', 'sectores.area_id', '=', 'areas.id')
            ->select([
                'sectores.id',
                'sectores.name',
                'sectores.email',
                'sectores.description',
                'areas.name as area',
            ]);

        return Datatables::of($query)->make(true);

    }

}
