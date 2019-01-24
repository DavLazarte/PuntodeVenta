<?php

namespace zitaraventas\Http\Controllers;

use Illuminate\Http\Request;

use zitaraventas\Http\Requests;
use zitaraventas\Caja;
use Illuminate\Support\Facades\Redirect;
use DB;
use Response;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Fpdf;

class ResumenCajaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function resumen()
    {
        $fecha = date("Y-m-d");
        $comprasmes=DB::select('SELECT monthname(i.fecha_hora) as mes, sum(di.cantidad*di.precio_compra) as totalmes from ingreso i inner join detalle_ingreso di on i.idingreso=di.idingreso where i.estado="A" group by monthname(i.fecha_hora) order by month(i.fecha_hora) desc limit 12');

        $ventasmes=DB::select('SELECT monthname(v.fecha_hora) as mes, sum(v.total_venta) as totalmes from venta v where v.estado="cancelado" group by monthname(v.fecha_hora) order by month(v.fecha_hora) desc limit 12');

        $ventasdia=DB::select('SELECT DATE(v.fecha_hora) as dia, sum(v.total_venta) as totaldia from venta v where v.estado="cancelado" group by v.fecha_hora order by day(v.fecha_hora) desc limit 15');

        $productosvendidos=DB::select('SELECT a.nombre as articulo,sum(dv.cantidad) as cantidad from articulo a inner join detalle_venta dv on a.idarticulo=dv.idarticulo inner join venta v on dv.idventa=v.idventa where v.estado="cancelado" and year(v.fecha_hora)=year(("'.$fecha.'")) group by a.nombre order by sum(dv.cantidad) desc limit 10');

        $totales=DB::select('SELECT (select ifnull(sum(di.cantidad*di.precio_compra),0) from ingreso i inner join detalle_ingreso di on i.idingreso=di.idingreso where DATE(i.fecha_hora)=("'.$fecha.'") and i.estado="A") as totalingreso, (select ifnull(sum(v.total_venta),0) from venta v where DATE(v.fecha_hora)=("'.$fecha.'") and v.tipo_comprobante="Contado") as totalventa,(select ifnull(sum(v.total_venta),0) from venta v where DATE(v.fecha_hora)=("'.$fecha.'") and v.tipo_comprobante="Tarjeta") as totaltarjeta,(select ifnull(sum(v.total_venta),0) from venta v where DATE(v.fecha_hora)=("'.$fecha.'") and v.tipo_comprobante="MP") as totalmp,(select ifnull(sum(v.total_venta),0) from venta v where DATE(v.fecha_hora)=("'.$fecha.'") and v.tipo_comprobante="Cuenta") as totalsena,(select ifnull(sum(v.cuota),0) from venta v where DATE(v.fecha_cuota)=("'.$fecha.'")) as totalcuota, (select ifnull(sum(s.monto),0) from salidas s where DATE(s.created_at)=("'.$fecha.'")) as totalsalida');

        $caja = Caja::where('estado','=','Cerrada')->get()->last();

        return view('caja.resumen',compact('caja','comprasmes','ventasmes','ventasdia','productosvendidos','totales'));
    }

    public function  index(Request $request)
    {
        if($request)
        {
            $searchText   =trim($request->get('searchText')); 
            $cajas = DB::table('cajas')
                ->where('created_at','LIKE','%'.$searchText.'%')
                ->orderBy('id', 'desc')
                ->get();
            // $caja = Caja::findOrFail($id);
            return view('caja.index', compact('cajas', 'searchText'));
            
        }
    }
    public function create()
    {
        // $caja = Caja::where('estado','=','Cerrada')->last();
        // $totales=DB::select('SELECT (select ifnull(sum(di.cantidad*di.precio_compra),0) from ingreso i inner join detalle_ingreso di on i.idingreso=di.idingreso where DATE(i.fecha_hora)=("'.$fecha.'") and i.estado="A") as totalingreso, (select ifnull(sum(v.total_venta),0) from venta v where DATE(v.fecha_hora)=("'.$fecha.'") and v.tipo_comprobante="Contado") as totalventa,(select ifnull(sum(v.total_venta),0) from venta v where DATE(v.fecha_hora)=("'.$fecha.'") and v.tipo_comprobante="Tarjeta") as totaltarjeta,(select ifnull(sum(v.sena),0) from venta v where DATE(v.fecha_hora)=("'.$fecha.'") and v.tipo_comprobante="Cuenta") as totalsena,(select ifnull(sum(v.cuota),0) from venta v where DATE(v.fecha_cuota)=("'.$fecha.'")) as totalcuota, (select ifnull(sum(s.monto),0) from salidas s where DATE(s.created_at)=("'.$fecha.'")) as totalsalida');       
        return view('caja.create');
    }
    public function store(Request $request)
    {
        $caja = Caja::create( $request->all() );
        
        return  Redirect::to('caja/resumen');
    }
    public function edit($id)
    {
        $fecha = date("Y-m-d");
        // dd($fecha);
        $cajas = Caja::findOrFail($id);
        $totales=DB::select('SELECT (select ifnull(sum(di.cantidad*di.precio_compra),0) from ingreso i inner join detalle_ingreso di on i.idingreso=di.idingreso where DATE(i.fecha_hora)=("'.$fecha.'") and i.estado="A") as totalingreso, (select ifnull(sum(v.total_venta),0) from venta v where DATE(v.fecha_hora)=("'.$fecha.'") and v.tipo_comprobante="Contado") as totalventa,(select ifnull(sum(v.total_venta),0) from venta v where DATE(v.fecha_hora)=("'.$fecha.'") and v.tipo_comprobante="Tarjeta") as totaltarjeta,(select ifnull(sum(v.sena),0) from venta v where DATE(v.fecha_hora)=("'.$fecha.'") and v.tipo_comprobante="Cuenta") as totalsena,(select ifnull(sum(v.cuota),0) from venta v where DATE(v.fecha_cuota)=("'.$fecha.'")) as totalcuota, (select ifnull(sum(s.monto),0) from salidas s where DATE(s.created_at)=("'.$fecha.'")) as totalsalida');        
        
        return view('caja.edit', compact('totales','caja', 'cajas'));
    }
    public function update(Request $request, $id)
    {
        $Caja = Caja::findOrFail($id)->update($request->all());
        return Redirect::to('caja/cierre');

    }
    public function reportec($id){
        //Obtenemos los registros
        $registros=DB::table('cajas')
        ->where('id','=',$id)
        ->get();

        //Ponemos la hoja Horizontal (L)
        $pdf = new Fpdf('L','mm','A4');
        $pdf::AddPage();
        $pdf::SetTextColor(35,56,113);
        $pdf::SetFont('Arial','B',11);
        $pdf::Cell(0,10,utf8_decode("Listado Cajas"),0,"","C");
        $pdf::Ln();
        $pdf::Ln();
        $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
        $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
        $pdf::SetFont('Arial','B',10); 
        //El ancho de las columnas debe de sumar promedio 190        
        $pdf::cell(20,8,utf8_decode("Fecha"),1,"","L",true);
        $pdf::cell(20,8,utf8_decode("Inicial"),1,"","L",true);
        $pdf::cell(25,8,utf8_decode("Cuentas"),1,"","L",true);
        $pdf::cell(20,8,utf8_decode("Cuotas"),1,"","L",true);
        $pdf::cell(20,8,utf8_decode("Tarjetas"),1,"","L",true);
        $pdf::cell(25,8,utf8_decode("V.Efectivo"),1,"","R",true);
        $pdf::cell(25,8,utf8_decode("Salidas"),1,"","R",true);
        $pdf::cell(25,8,utf8_decode("Cierre"),1,"","R",true);
        
        $pdf::Ln();
        $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
        $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
        $pdf::SetFont("Arial","",9);
        $total=0;
        
        foreach ($registros as $reg)
        {
           $pdf::cell(20,8,substr($reg->created_at,0,10),1,"","L",true);
           $pdf::cell(20,8,utf8_decode($reg->monto_inicial),1,"","L",true);
           $pdf::cell(25,8,utf8_decode($reg->cuentas),1,"","L",true);
           $pdf::cell(20,8,utf8_decode($reg->cuotas),1,"","L",true);
           $pdf::cell(20,8,utf8_decode($reg->tarjetas),1,"","L",true);
           $pdf::cell(25,8,utf8_decode($reg->venta_efectivo),1,"","L",true);
           $pdf::cell(25,8,utf8_decode($reg->salidas),1,"","L",true);
           $pdf::cell(25,8,utf8_decode($reg->monto_final),1,"","L",true);
           $pdf::Ln(); 
        }
        $pdf::Output();
        exit;
   }
   
}
