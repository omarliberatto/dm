<?php

namespace App\Http\Controllers;

use App\Telefonostipo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Telefono;
use App\Telefonoscache;
use App\Lugar;
use App\Persona;

class TelefonosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $ip='Sin acceso al nombre';
        if (!empty($_SERVER['REMOTE_HOST'])) {
            $ip = $_SERVER['REMOTE_HOST'];
        }
//        dd($request->ip().' - '. $ip);
//        dd(dns_get_record ( $request->ip()));
//        dd($request->server->get('REMOTE_HOST'));
        return view('admin.telefonos.index');
    }

    public function datatable(Request $request){

        if($request->ajax()) {
            $data = new Telefono();
            return $data->getDatatable();
        }
    }

    public function importar(Request $request)
    {

        $file = $request->file('archivo');

        /* Importar filas y columnas del CSV*/

        Excel::load($file->getRealPath(), function($reader) {

            // Guardo los datos en un array sin tomar la primer fila como una cabecera
            $filasExcel=$reader->noHeading()->all()->toArray();
            array_shift($filasExcel); // elimino la primer fila que no trae datos
            $msg='';
            //recorro las filas
            foreach($filasExcel as $fila){

                $idTelefono = $fila[0];
                // Pregunto si la variable es un entero si no la busco en la segunda columna
                if(!is_int($idTelefono)){
                    $idTelefono = $fila[1];
                }

                //si el ID del telefono existe lo modifico
                $telefono = Telefono::find($idTelefono);
                $cache = Telefonoscache::find($idTelefono);

                //si el ID del telefono no existe lo creo
                if(!$telefono){
                    unset($telefono);
                    $telefono = new Telefono();
                }

                //si el ID del cache no existe lo creo
                if(!$cache){
                    unset($cache);
                    $cache = new Telefonoscache();
                    $cache->visible = true;
                }

                // Verifico en que rango ubicación se encuentra
                $ubicacionId = $telefono->getUbicacionID($idTelefono);

                if($ubicacionId){

                    //cargo los datos de cada columna
                    $telefono->telefonoscache_id = $cache->id = $telefono->id = $idTelefono;
                    $telefono->alias = $fila[4];
                    $telefono->ubicacion_id = $ubicacionId;
                    $cache->telefonostipo_id = 1;// El tipo en este caso es 1 porque corresponde a Interno, por las dudas revisar si cambia en la DB

                    $cache->save();
                    $telefono->save();

                }else{

                    // cuando no pertenece a una Ubicación
                    flash('El dato '.$fila[4].' no se pudo importar.')->warning();

                }


            }
        });

        flash($file->getClientOriginalName().' importado con éxito.')->success();

        return redirect()->route('telefonos.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $telefono = new Telefono();
        //dd ($telefono->disponible(1, 1123));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $cache = Telefonoscache::find($id);
        $lugares = Lugar::orderBy('name', 'ASC')->pluck('name','id');
        $personas = Persona::orderBy('full_name', 'ASC')->pluck('full_name','id');
        $tipos = Telefonostipo::orderBy('name', 'ASC')->pluck('name','id');

        return view('admin.telefonos.edit', compact('cache', 'lugares', 'personas', 'tipos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $cache = Telefonoscache::find($id);
        $cache->fill($request->all());

        if($cache->save())
            flash($cache->id.', editado con éxito.')->success();
        else
            flash('Error: '.$cache->id.', no pudo ser editado.')->error();

        return redirect()->route('telefonos.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
