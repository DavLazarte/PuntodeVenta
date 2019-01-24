<?php

namespace zitaraventas\Http\Requests;

use zitaraventas\Http\Requests\Request;

class VentaFormRequest extends Request
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
    public function rules()
    {
        return [
            'idcliente'=>'',
            'tipo_comprobante'=>'|max:20',
            'serie_comprobante'=>'max:7',
            'num_comprobante'=>'|max:10',
            'idarticulo'=>'',
            'cantidad'=>'',
            'precio_venta'=>'',
            'descuento'=>'',
            'total_venta'=>'',
            'sena',
            'saldo'
            

        
        ];
    }
}
