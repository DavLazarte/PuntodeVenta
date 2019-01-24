<?php

namespace zitaraventas\Http\Controllers;

use Illuminate\Http\Request;

use zitaraventas\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use zitaraventas\Http\Requests\VentaFormRequest;
use zitaraventas\Venta;
use zitaraventas\DetalleVenta;
use zitaraventas\Estado;
use DB;
use Fpdf;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request)
        {
           $query=trim($request->get('searchText'));
           $ventas=DB::table('venta as v')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.sena','v.cuota','v.fecha_cuota','v.saldo')
            ->where('v.tipo_comprobante','LIKE','%'.$query.'%')
            ->orwhere('p.nombre','LIKE','%'.$query.'%')
            ->orwhere('v.fecha_hora','LIKE','%'.$query.'%')
            ->orwhere('v.estado','LIKE','%'.$query.'%')
            ->orderBy('v.idventa','desc')
            ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.sena','v.cuota','v.fecha_cuota','v.saldo','v.estado')
            ->paginate(10);
            return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);

        }
    }
    public function create()
    {
        $personas=DB::table('persona')->where('tipo_persona','=','Cliente')->get();
        $ventas = DB::table('venta as v')->get();
        $articulos = DB::table('articulo')
        // ->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
        ->select(DB::raw('CONCAT(codigo, " ",descripcion) AS articulo'),'idarticulo','stock')
        ->where('estado','=','disponible')
        ->groupBy('articulo','idarticulo','stock')
        ->get();
        return view("ventas.venta.create",compact('personas', 'ventas', 'articulos'));
    }

    public function store (VentaFormRequest $request)
    {
        try{
            DB::beginTransaction();
            $venta=new Venta;
            $venta->idcliente=$request->get('idcliente');
            $venta->total_venta=$request->get('total_venta');
            $venta->tipo_comprobante=$request->get('tipo_comprobante');//manda el tipo de venta
            $venta->num_comprobante=$request->get('num_comprobante');//guarda la tarjeta de compra
            $venta->sena=$request->get('sena');
            $venta->saldo=$request->get('saldo');
            $venta->cuota='0.00';
            $venta->fecha_cuota=" ";

            $mytime = Carbon::now('America/Argentina/Tucuman');
            $venta->fecha_hora=$mytime->toDateTimeString();
            if ($request->get('impuesto')=='1')
            {
                $venta->impuesto='21';
            }
            else
            {
                $venta->impuesto='0';
            } 
            if ($request->get('saldo')=='0.00')
            {
                $venta->estado='cancelado';
            }
            else
            {
                $venta->estado='debe';
            }
            
            $venta->save();

            $idarticulo = $request->get('idarticulo');
            $descuento = $request->get('descuento');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while($cont < count($idarticulo))
            {
                $detalle = new DetalleVenta();
                $detalle->idventa= $venta->idventa; 
                $detalle->idarticulo= $idarticulo[$cont];
                $detalle->descuento= $descuento[$cont];
                $detalle->precio_venta= $precio_venta[$cont];
                $detalle->save();
                $cont=$cont+1;            
            }
            DB::commit();
        }
        catch(\Exception $e)
        {
           DB::rollback();
        }

        return Redirect::to('ventas/venta');
    }

    public function show($id)
    {
        $venta=DB::table('venta as v')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.sena','v.cuota','v.fecha_cuota','v.saldo')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('detalle_venta as d')
             ->join('articulo as a','d.idarticulo','=','a.idarticulo')
             ->select('a.descripcion as articulo','d.cantidad','d.descuento','d.precio_venta')
             ->where('d.idventa','=',$id)
             ->get();
        return view("ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles]);
    }
    public function edit($id)
    {
        $venta=DB::table('venta as v')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.idpersona','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.sena','v.cuota','v.fecha_cuota','v.saldo')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('detalle_venta as d')
             ->join('articulo as a','d.idarticulo','=','a.idarticulo')
             ->select('a.descripcion as articulo','d.cantidad','d.descuento','d.precio_venta')
             ->where('d.idventa','=',$id)
             ->get(); 

        // $venta=DB::table('venta as v')
        //     ->select('v.idventa','v.estado','v.total_venta','v.sena','v.cuota','v.fecha_cuota','v.saldo')
        //     ->where('v.idventa','=',$id)
        //     ->first();    
        return view("ventas.venta.edit",["venta"=>$venta]);
    }
    public function update(VentaFormRequest $request,$id){

            $venta=Venta::findOrFail($id);
            
            $venta->sena=$request->get('sena');
            $venta->saldo=$request->get('saldo');
            $venta->estado=$request->get('estado');
            $venta->cuota=$request->get('cuota');

            $mytime = Carbon::now('America/Argentina/Tucuman');
            $venta->fecha_cuota=$mytime->toDateTimeString();
            $venta->update();
            
            $estado = Estado::create($request->only('idventa','idcliente','cuota','saldo','estado'));
            
            return Redirect::to('ventas/venta');
        }
    
    public function reportec($id){
         //Obtengo los datos
        $venta=DB::table('venta as v')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','p.direccion','p.num_documento','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.sena','v.cuota','v.fecha_cuota','v.saldo')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('detalle_venta as d')
             ->join('articulo as a','d.idarticulo','=','a.idarticulo')
             ->select('a.descripcion as articulo','d.cantidad','d.descuento','d.precio_venta')
             ->where('d.idventa','=',$id)
             ->get();


        $pdf = new Fpdf();
        $pdf::AddPage();
        $pdf::SetFont('Arial','B',14);
        $pdf::Image('..\public\img\logo.jpeg',5,5,60);
        //Inicio con el reporte
        $pdf::SetXY(150,20);
        $pdf::Cell(0,0,utf8_decode('Tipo de Venta:'.$venta->tipo_comprobante));

        $pdf::SetFont('Arial','B',14);
        //Inicio con el reporte
        $pdf::SetXY(150,40);
        $pdf::Cell(0,0,utf8_decode("Nº:".$venta->idventa));

        $pdf::SetFont('Arial','B',10);
        $pdf::SetXY(35,60);
        $pdf::Cell(0,0,utf8_decode("Cliente:".$venta->nombre));
        $pdf::SetXY(35,69);
        $pdf::Cell(0,0,substr("Fecha:".$venta->fecha_hora,0,16));
        $total=0;
        $pdf::SetXY(180,69);
        $pdf::setXY(10,78);
        $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
        $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
        $pdf::SetFont('Arial','B',10);
        $pdf::cell(60,8,utf8_decode("Prenda"),1,"","L",true);
        $pdf::cell(40,8,utf8_decode("Precio"),1,"","L",true);
        $pdf::cell(45,8,utf8_decode("Descuento"),1,"","L",true);
        $pdf::cell(20,8,utf8_decode("Subtotal"),1,"","L",true);

        //Mostramos los detalles
        $y=89;
        foreach($detalles as $det){
            $pdf::SetXY(12,$y);
            $pdf::MultiCell(120,0,utf8_decode($det->articulo));
            $pdf::SetXY(72,$y);
            $pdf::MultiCell(25,0,$det->precio_venta);
            $pdf::SetXY(112,$y);
            $pdf::MultiCell(25,0,$det->descuento);
            $pdf::SetXY(157,$y);
            $pdf::MultiCell(25,0,sprintf("%0.2F",(($det->precio_venta-$det->descuento))));

            $total=$total+($det->precio_venta-$det->descuento);
            $y=$y+7;
        }
        $imp = $venta->total_venta*$venta->impuesto/100;

        $pdf::SetXY(157,187);
        $pdf::MultiCell(150,0,"Total: $/. ".sprintf("%0.2F", $venta->total_venta+ $imp));
        $pdf::SetXY(157,180);
        $pdf::MultiCell(150,0,"Impuesto: $/. ".sprintf("%0.2F", ($imp)));
        $pdf::SetXY(157,173);
        $pdf::MultiCell(150,0,"SubTotal: $/. ".sprintf("%0.2F", $venta->total_venta));

        $pdf::Output();
        exit;
    }
    
    public function reporte(Request $request,$searchText){
         //Obtenemos los registros
        if($request)
        {
            $query=trim($request->get('searchText'));
            $registros=DB::table('venta as v')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.sena','v.cuota','v.fecha_cuota','v.saldo')
            ->orderBy('v.idventa','desc')
            ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado')
            ->where('v.tipo_comprobante','LIKE','%'.$searchText.'%')
            ->orwhere('p.nombre','LIKE','%'.$searchText.'%')
            ->orwhere('v.fecha_hora','LIKE','%'.$searchText.'%')
            ->orwhere('v.estado','LIKE','%'.$searchText.'%')
            ->get();
        }
         

         //Ponemos la hoja Horizontal (L)
         $pdf = new Fpdf('L','mm','A4');
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Ventas"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(35,8,utf8_decode("Fecha"),1,"","L",true);
         $pdf::cell(40,8,utf8_decode("Cliente"),1,"","L",true);
         $pdf::cell(45,8,utf8_decode("Tipo de Venta"),1,"","L",true);
         $pdf::cell(20,8,utf8_decode("Pago Inicial"),1,"","L",true);
         $pdf::cell(20,8,utf8_decode("Estado"),1,"","L",true);
         $pdf::cell(25,8,utf8_decode("Total"),1,"","R",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         $total=0;
         
         foreach ($registros as $reg)
         {
            $pdf::cell(35,8,substr($reg->fecha_hora,0,10),1,"","L",true);
            $pdf::cell(40,8,utf8_decode($reg->nombre),1,"","L",true);
            $pdf::cell(45,8,utf8_decode($reg->tipo_comprobante.': '.$reg->serie_comprobante."-".$reg->idventa.'-'.$reg->num_comprobante),1,"","L",true);
            $pdf::cell(20,8,utf8_decode($reg->sena),1,"","L",true);
            $pdf::cell(20,8,utf8_decode($reg->estado),1,"","L",true);
            $pdf::cell(25,8,utf8_decode($reg->total_venta),1,"","R",true);
            $total=$total+$reg->total_venta;
            $pdf::Ln(); 
         }
         $pdf::cell(185,8,utf8_decode("Total"."-".$total),1,"","C",true);
         $pdf::Output();
         exit;
    }    
}
