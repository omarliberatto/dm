<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\DataTables\Facades\DataTables;

class Telefonostipo extends Model
{
    use SoftDeletes;

    protected $table='telefonostipos';
    protected $fillable = [
        'name',
    ];

    protected $dates = ['deleted_at'];

    public function getDatatable(){
        // Devuelve Json reducido con los datos que necesitamos, compatible con DataTables.
        $query = $this->all();

        return Datatables::of($query)->make(true);

    }
}
