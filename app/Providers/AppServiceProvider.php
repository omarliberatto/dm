<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory as Validator;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);
        
        $this->app->validator->extendImplicit('ubicacionrange', function ($attribute, $value, $parameters) {

            $valid = true;
            $ubicaciones = \App\Ubicacion::all();

            // recorro el modelo para buscar los rangos
            foreach ($ubicaciones as $ubicacion) {

                //Pregunto si el ID guardado es el mismo del que viene del form para saber si está editandolo y en ese caso no tener en cuenta el rango
                if($parameters['0'] != $ubicacion->id) {

                    //pregunto si el dato está dentro del rango

                    if (in_array($value, range($ubicacion->ini_range, $ubicacion->end_range))) {
                        $valid = false;
                        break;
                    };
                }

            }

            return $valid;

        }, 'El rango ingresado ya existe en otra ubicación.');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
