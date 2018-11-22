<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::orderBy('id', 'DESC')->paginate(10);

        return view('admin.areas.index')->with('areas', $areas);
    }

    public function datatable(Request $request){

        if($request->ajax()) {
            $data = new Area();
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
        return view('admin.areas.create');
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
        $area = new Area($request->all());

        if($area->save())
            flash($area->name.', creada con éxito.')->success();
        else
            flash('Error: '.$area->name.', no pudo ser creada.')->error();

        return redirect()->route('areas.index');
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
        $area= Area::find($id);

        return view('admin.areas.edit', compact('area'));
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

        $area = Area::find($id);

        $area->fill($request->all());

        if($area->save())
            flash($area->name.', editada con éxito.')->success();
        else
            flash('Error: '.$area->name.', no pudo ser editada.')->error();

        return redirect()->route('areas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area= Area::find($id);

        if($area->delete())
            flash($area->name.', eliminada con éxito.')->success();
        else
            flash('Error: '.$area->name.', no pudo ser eliminada.')->error();

        return redirect()->route('areas.index');
    }
}
