<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UbicacionesRequest;
use App\Ubicacion;


class UbicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ubicaciones = Ubicacion::orderBy('id', 'DESC')->paginate(10);
        return view('admin.ubicaciones.index')->with('ubicaciones', $ubicaciones);
    }

    public function datatable(Request $request){

        if($request->ajax()) {
            $data = new Ubicacion;
            return $data->getDatatable();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ubicaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UbicacionesRequest $request)
    {

        $ubicacion = new Ubicacion($request->all());

        if ($ubicacion->save()) {
            flash($ubicacion->name . ', creada con éxito.')->success();
        }else{
            flash('Error: ' . $ubicacion->name . ', no pudo ser creada.')->error();
        }

        return redirect()->route('ubicaciones.index');
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
        $ubicacion= Ubicacion::find($id);

        return view('admin.ubicaciones.edit', compact('ubicacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UbicacionesRequest $request, $id)
    {

        $ubicacion = Ubicacion::find($id);

        $ubicacion->fill($request->all());


        if ($ubicacion->save()) {
            flash($ubicacion->name . ', editada con éxito.')->success();
        }else{
            flash('Error: ' . $ubicacion->name . ', no pudo ser editada.')->error();
        }

        return redirect()->route('ubicaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ubicacion= Ubicacion::find($id);

        if($ubicacion->delete())
            flash($ubicacion->name.', eliminada con éxito.')->success();
        else
            flash('Error: '.$ubicacion->name.', no pudo ser eliminada.')->error();

        return redirect()->route('ubicaciones.index');
    }
}
