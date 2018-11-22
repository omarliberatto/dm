<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Telefonostipo;

class TelefonostiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $telefonostipos = Telefonostipo::orderBy('id', 'DESC')->paginate(5);

        return view('admin.telefonos.tipos.index')->with('telefonostipos', $telefonostipos);
    }

    public function datatable(Request $request){

        if($request->ajax()) {
            $data = new Telefonostipo;
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
        return view('admin.telefonos.tipos.create');
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
            'name'=>'min:3|max:120|required'
        ];

        $this->validate($request, $rules);
        $telefonostipos = new Telefonostipo($request->all());

        if($telefonostipos->save())
            flash($telefonostipos->name.', creada con éxito.')->success();
        else
            flash('Error: '.$telefonostipos->name.', no pudo ser creada.')->error();

        return redirect()->route('telefonostipos.index');
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
        $telefonostipo= Telefonostipo::find($id);

        return view('admin.telefonos.tipos.edit', compact('telefonostipo'));
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
            'name'=>'min:3|max:120|required'
        ];

        $this->validate($request, $rules);

        $telefonostipo = Telefonostipo::find($id);

        $telefonostipo->fill($request->all());

        if($telefonostipo->save())
            flash($telefonostipo->name.', editada con éxito.')->success();
        else
            flash('Error: '.$telefonostipo->name.', no pudo ser editada.')->error();

        return redirect()->route('telefonostipos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $telefonostipo= Telefonostipo::find($id);

        if($telefonostipo->delete())
            flash($telefonostipo->name.', eliminada con éxito.')->success();
        else
            flash('Error: '.$telefonostipo->name.', no pudo ser eliminada.')->error();

        return redirect()->route('telefonostipos.index');
    }
}
