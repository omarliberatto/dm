<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use App\Area;

class SectoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectores = Sector::orderBy('id', 'DESC')->paginate(10);

        return view('admin.sectores.index')->with('sectores', $sectores);
    }

    public function datatable(Request $request){

        if($request->ajax()) {
            $data = new Sector;
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
        $areas= Area::orderBy('name', 'ASC')->pluck('name','id');
        return view('admin.sectores.create',compact('areas'));
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
            'email'=>'nullable|email|max:255',
            'description'=>'nullable|max:1200|string',
        ];

        $this->validate($request, $rules);
        $sector = new Sector($request->all());

        if($sector->save())
            flash($sector->name.', creada con éxito.')->success();
        else
            flash('Error: '.$sector->name.', no pudo ser creada.')->error();

        return redirect()->route('sectores.index');
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
        $sector= Sector::find($id);
        $areas= Area::orderBy('name', 'ASC')->pluck('name','id');

        return view('admin.sectores.edit', compact('sector', 'areas'));
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
            'email'=>'nullable|email|max:255',
            'description'=>'nullable|max:1200|string',
        ];

        $this->validate($request, $rules);

        $sector = Sector::find($id);

        $sector->fill($request->all());

        if($sector->save())
            flash($sector->name.', editada con éxito.')->success();
        else
            flash('Error: '.$sector->name.', no pudo ser editada.')->error();

        return redirect()->route('sectores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sector= Sector::find($id);

        if($sector->delete())
            flash($sector->name.', eliminada con éxito.')->success();
        else
            flash('Error: '.$sector->name.', no pudo ser eliminada.')->error();

        return redirect()->route('sectores.index');
    }
}
