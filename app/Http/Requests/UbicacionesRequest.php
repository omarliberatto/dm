<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UbicacionesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()    {

        // busco el ID de la ubicacion si es que se está editando
        $ubicacionId=(int)$this->route()->parameter('ubicacione');
        //Seteo el rango minimo tomando el Rango Final como referencia -1
        $minRange=((int)$this->request->get('end_range', 'NULL'))-1;

        return [
            'name'=>'min:3|max:120|string|required',
            'ini_range'=>'nullable|integer|max:4999|ubicacionrange:'.$ubicacionId.'|max:'.$minRange,
            'end_range'=>'nullable|integer|max:4999|ubicacionrange:'.$ubicacionId,
            'description'=>'nullable|max:1200|string',
        ];

    }
}
