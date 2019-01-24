<?php

namespace zitaraventas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;


use zitaraventas\Http\Requests;
use zitaraventas\Salida;
use Illuminate\Support\Facades\Redirect;
use DB;
use Response;
use Illuminate\Support\Collection;
use Fpdf;

class SalidaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request)
        {
            $searchText   =trim($request->get('searchText')); 
            $salidas =DB::table('salidas')
                ->where('created_at','LIKE','%'.$searchText.'%')
                ->get();
    
            return view('salida.index', compact('salidas', 'searchText'));
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salida.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salida = Salida::create( $request->all() );
        
        return  Redirect::to('salida');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salida = Salida::findOrFail($id);

        return view('salida.edit', compact('salida'));
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
        $salida = Salida::findOrFail($id)->update($request->all());
    
        return Redirect::to('salida');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $salida = Salida::findOrFail($id)->update($request->all());

        return Redirect::to('salida');
    }
    public function reportec($id){
        //Obtenemos los registros
        $registros=DB::table('salidas')
        ->where('id','=',$id)
        ->get();

        //Ponemos la hoja Horizontal (L)
        $pdf = new Fpdf('L','mm','A4');
        $pdf::AddPage();
        $pdf::SetTextColor(35,56,113);
        $pdf::SetFont('Arial','B',11);
        $pdf::Cell(0,10,utf8_decode("Listado Salidas"),0,"","C");
        $pdf::Ln();
        $pdf::Ln();
        $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
        $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
        $pdf::SetFont('Arial','B',10); 
        //El ancho de las columnas debe de sumar promedio 190        
        $pdf::cell(40,8,utf8_decode("Fecha"),1,"","L",true);
        $pdf::cell(40,8,utf8_decode("Monto"),1,"","L",true);
        $pdf::cell(45,8,utf8_decode("Destino"),1,"","L",true);
        $pdf::cell(40,8,utf8_decode("Descripción"),1,"","L",true);
        
        $pdf::Ln();
        $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
        $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
        $pdf::SetFont("Arial","",9);
        $total=0;
        
        foreach ($registros as $reg)
        {
           $pdf::cell(40,8,substr($reg->created_at,0,10),1,"","L",true);
           $pdf::cell(40,8,utf8_decode($reg->monto),1,"","L",true);
           $pdf::cell(45,8,utf8_decode($reg->destino),1,"","L",true);
           $pdf::cell(40,8,utf8_decode($reg->descripcion),1,"","L",true);
           $pdf::Ln(); 
        }
        $pdf::Output();
        exit;
   }
}
