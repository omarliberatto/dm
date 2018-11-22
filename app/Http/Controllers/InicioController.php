<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Telefono;
use App\User;

class InicioController extends Controller
{
    public function index()
    {
        //dd(bcrypt('!sistemas2017#'));
        return view('index');
    }

    public function datatable(Request $request){

        if($request->ajax()) {
            $data = new Telefono();
            return $data->getDatatable(true);
        }

    }
}
