<?php

namespace zitaraventas\Http\Requests;
use zitaraventas\Http\Requests\Request;

class ArticuloFormRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idcategoria'=>'required',
            'codigo'=>'required|max:50',
            'descripcion'=>'max:512',
        ];
    }
}
