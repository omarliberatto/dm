<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'InicioController@index');
Route::get('datatable/telefonos', 'InicioController@datatable');

Auth::routes();

Route::get('admin', function () {
    return redirect()->route('telefonos.index');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth' ], function (){

    Route::resource('telefonostipos', 'TelefonostiposController');
    Route::get('datatable/telefonostipos', 'TelefonostiposController@datatable');

    Route::resource('telefonos', 'TelefonosController');
    Route::post('telefonos', [
        'uses'=>'TelefonosController@importar',
        'as' => 'telefonos.importar'
    ]);
    Route::get('datatable/telefonos', 'TelefonosController@datatable');

    Route::resource('areas', 'AreasController');
    Route::get('datatable/areas', 'AreasController@datatable');

    Route::resource('sectores', 'SectoresController');
    Route::get('datatable/sectores', 'SectoresController@datatable');

    Route::resource('ubicaciones', 'UbicacionesController');
    Route::get('datatable/ubicaciones', 'UbicacionesController@datatable');

    Route::resource('lugares', 'LugaresController');
    Route::get('datatable/lugares', 'LugaresController@datatable');

    Route::resource('personas', 'PersonasController');

});