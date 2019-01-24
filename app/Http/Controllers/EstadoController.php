<?php

namespace zitaraventas\Http\Controllers;

use Illuminate\Http\Request;

use zitaraventas\Http\Requests;
use zitaraventas\Persona;
use DB;
use Fpdf;

class EstadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function vistaestado(Request $request)
    {
        if ($request)
        {
            $personas = Persona::where('tipo_persona','=','Cliente')->get(); 
            // dd($personas);
            $cliente    = trim($request->get('cliente'));
            // $fecha   = trim($request->get('fecha'));
            $venta = trim($request->get('venta'));
            $pagos   = DB::table('estados as e')
            ->join('venta as v','e.idventa','=','v.idventa')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->select('e.id','e.idventa','e.created_at','p.nombre','e.cuota','e.saldo','e.estado')
            ->orwhere('e.idcliente','=',$cliente)
            ->orwhere('e.idventa','=',$venta)
            // ->orwhere('e.created_at','=',$fecha)
            ->orderBy('id','desc')
            ->get();
            return view('estado.resumen',compact('personas','cliente','fecha','venta','pagos'));
        }
    }
    public function reporte($cliente, $credito){
        //Obtengo los datos
        $detalles = DB::table('estados as e')
        ->join('venta as v','e.idventa','=','v.idventa')
        ->join('persona as p','v.idcliente','=','p.idpersona')
        ->select('e.id','e.idventa','e.created_at','p.nombre','e.cuota','e.saldo','e.estado')
        ->orwhere('e.idcliente','=',$cliente)
        ->orwhere('e.idventa','=',$credito)
        // ->orwhere('e.created_at','=',$fecha)
        ->orderBy('id','desc')
        ->get();


       $pdf = new Fpdf();
       $pdf::AddPage();
       $pdf::SetFont('Arial','B',14);
       $pdf::Image('..\public\img\logo.jpeg',5,5,60);
       //Inicio con el reporte
       $pdf::SetXY(150,20);
       $pdf::Cell(0,0,utf8_decode('Movimientos:'));

       $pdf::SetFont('Arial','B',14);
       //Inicio con el reporte
    //    $pdf::SetXY(110,40);
    //    $pdf::Cell(0,0,utf8_decode("Fecha:"));

       $pdf::SetFont('Arial','B',10);
    //    $pdf::SetXY(35,60);
    //    $pdf::Cell(0,0,utf8_decode("Cliente:");
    //    $pdf::SetXY(35,69);
    //    $pdf::Cell(0,0,substr("Fecha:"));
       $total=0;
       $pdf::SetXY(180,69);
       $pdf::setXY(10,78);
       $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
       $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
       $pdf::SetFont('Arial','B',10);
       $pdf::cell(25,8,utf8_decode("N° de pago"),1,"","L",true);
       $pdf::cell(50,8,utf8_decode("Cliente"),1,"","L",true);
       $pdf::cell(30,8,utf8_decode("N° de Credito"),1,"","L",true);
       $pdf::cell(35,8,utf8_decode("Fecha de Pago"),1,"","L",true);
       $pdf::cell(30,8,utf8_decode("Cuota"),1,"","L",true);
       $pdf::cell(25,8,utf8_decode("Saldo"),1,"","L",true);

       //Mostramos los detalles
       $y=89;
       foreach($detalles as $det){
           $pdf::SetXY(10,$y);
           $pdf::MultiCell(120,0,utf8_decode($det->id));
           $pdf::SetXY(35,$y);
           $pdf::MultiCell(25,0,$det->nombre);
           $pdf::SetXY(85,$y);
           $pdf::MultiCell(25,0,$det->idventa);
           $pdf::SetXY(115,$y);
           $pdf::MultiCell(25,0,substr($det->created_at,0,10));
           $pdf::SetXY(150,$y);
           $pdf::MultiCell(25,0,$det->cuota);
           $pdf::SetXY(180,$y);
           $pdf::MultiCell(25,0,$det->saldo);
           $y=$y+7;
       }
       $pdf::Output();
       exit;
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
