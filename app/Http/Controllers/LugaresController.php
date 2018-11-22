<?php

namespace App\Http\Controllers;

use App\Ubicacion;
use Illuminate\Http\Request;
use App\Lugar;

class LugaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lugares = Lugar::orderBy('id', 'DESC')->paginate(10);

        return view('admin.lugares.index')->with('lugares', $lugares);
    }

    public function datatable(Request $request){

        if($request->ajax()) {
            $data = new Lugar;
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
        $ubicaciones= Ubicacion::orderBy('name', 'ASC')->pluck('name','id');
        return view('admin.lugares.create',compact('ubicaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'name'=>'min:3|max:120|string|required',
            'description'=>'nullable|max:1200|string',
        ];

        $this->validate($request, $rules);
        $lugar = new Lugar($request->all());

        if($lugar->save())
            flash($lugar->name.', creada con éxito.')->success();
        else
            flash('Error: '.$lugar->name.', no pudo ser creada.')->error();

        return redirect()->route('lugares.index');
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
        $lugar= Lugar::find($id);
        $ubicaciones= Ubicacion::orderBy('name', 'ASC')->pluck('name','id');

        return view('admin.lugares.edit', compact('lugar', 'ubicaciones'));
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
        $rules=[
            'name'=>'min:3|max:120|string|required',
            'description'=>'nullable|max:1200|string',
        ];

        $this->validate($request, $rules);

        $lugar = Lugar::find($id);

        $lugar->fill($request->all());

        if($lugar->save())
            flash($lugar->name.', editada con éxito.')->success();
        else
            flash('Error: '.$lugar->name.', no pudo ser editada.')->error();

        return redirect()->route('lugares.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lugar= Lugar::find($id);

        if($lugar->delete())
            flash($lugar->name.', eliminada con éxito.')->success();
        else
            flash('Error: '.$lugar->name.', no pudo ser eliminada.')->error();

        return redirect()->route('lugares.index');
    }
}
