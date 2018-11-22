<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Telefono extends Model
{
    protected $table='telefonos';
    protected $fillable = [
        'alias',
        'ubicacion_id',
        'telefonoscache_id'
    ];

    public function ubicacion (){

        return $this->belongsTo('App\Ubicacion');

    }

    public function telefonoscache (){

        return $this->belongsTo('App\Telefonoscache');

    }

    public function getDatatable($front=false){
        // Devuelve Json reducido con los datos que necesitamos, compatible con DataTables.
        $query = $this->join('telefonoscache', 'telefonos.telefonoscache_id', '=', 'telefonoscache.id')
                ->join('telefonostipos', 'telefonoscache.telefonostipo_id', '=', 'telefonostipos.id')
                ->leftjoin('personas', 'telefonoscache.persona_id', '=', 'personas.id')
                ->leftjoin('lugares', 'telefonoscache.lugar_id', '=', 'lugares.id')
                ->join('ubicaciones', 'telefonos.ubicacion_id', '=', 'ubicaciones.id')
                ->select([
                    'telefonos.id',
                    'telefonos.alias',
                    'telefonostipos.name as tipo',
                    'personas.full_name as fullname',
                    'lugares.name as lugar',
                    'ubicaciones.name as ubicacion',
                    'telefonoscache.visible as visible',
                ]);

        if($front){
            $query = $query->where('visible', '=', 1);
        }

        return Datatables::of($query)->make(true);


    }

    // Función para saber el ID de la ubicación de un número que está dentro de algún rango
    public function getUbicacionID ($number=0){

        // recorro el modelo para buscar los rangos
        foreach (Ubicacion::all() as $ubicacion){

            $ubicacionId=0;
            //pregunto si está dentro del rango
            if(in_array($number, range($ubicacion->ini_range,$ubicacion->end_range))){
                $ubicacionId=$ubicacion->id; // Guardo el ID de la ubicación que le corresponde y salgo del bucle
                break;
            };

        }

        return $ubicacionId;

    }

    // Función para saber los próximos IDs disponibles en una ubicación
    public function disponible ($id, $desde=0){

        $ubicacion = Ubicacion::find($id);

        if(!is_null($ubicacion)) {

            $valido = true;

            if (!$desde) {
                $desde = $ubicacion->ini_range;
            } else {

                //si no está dentro del rango invalído la búsqueda
                if (!in_array($desde, range($ubicacion->ini_range, $ubicacion->end_range))) {
                    $valido = false;
                };

            }

            if($valido) {

                for ($i = $desde; $i <= $ubicacion->end_range; $i++) {

                    $telefono = Telefonoscache::find($i);
                    if (is_null($telefono)) {
                        return $i; // devuelvo el primer ID vacío disponible
                        break;
                    }

                };

            }else{
                return $id.': 456: '.$desde;
            }

        }else{
            return $id.': 123: '.$desde;
        }

    }
}
