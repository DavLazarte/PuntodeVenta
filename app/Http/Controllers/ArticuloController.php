<?php

namespace zitaraventas\Http\Controllers;

use Illuminate\Http\Request;

use zitaraventas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use zitaraventas\Http\Requests\ArticuloFormRequest;
use zitaraventas\Articulo;
use DB;

use Fpdf;


class ArticuloController extends Controller
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
            $articulos=DB::table('articulo as a')
            ->join('categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.precio','a.estado')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->orwhere('c.nombre','LIKE','%'.$query.'%')
            ->orwhere('a.codigo','LIKE','%'.$query.'%')
            ->orderBy('a.idarticulo','desc')
            ->paginate(10);
            return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        }
    }
    public function create()
    {
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.create",["categorias"=>$categorias]);
    }
    public function store (ArticuloFormRequest $request)
    {
        $articulo=new Articulo;
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->precio=$request->get('precio');
        $articulo->estado='disponible';

        // if (Input::hasFile('imagen')){
        // 	$file=Input::file('imagen');
        // 	$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
        //     $articulo->imagen=$file->getClientOriginalName();
        // }
        $articulo->save();
        // return Redirect::to('almacen/articulo');
        return back()->with('status','La prenda se Cargo Correctamente');

    }
    public function show($id)
    {
        return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
    }
    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    }
    
    
    public function update(ArticuloFormRequest $request,$id)
    {
        $articulo=Articulo::findOrFail($id);

        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->precio=$request->get('precio');
        $articulo->estado=$request->get('estado');
        // if (Input::hasFile('imagen')){
        // 	$file=Input::file('imagen');
        // 	$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
        // 	$articulo->imagen=$file->getClientOriginalName();
        // }

        $articulo->update();
        return Redirect::to('almacen/articulo')->with('status_edit', 'La prenda se edito correctamente');
    }
    public function destroy($id)
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->Estado='Vendido';
        $articulo->update();
        return Redirect::to('almacen/articulo')->with('status_delete', 'Se Elimino la prenda');
    }
    public function reporte(){
         //Obtenemos los registros
         $registros=DB::table('articulo as a')
            ->join('categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
            ->orderBy('a.nombre','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Prendas"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(30,8,utf8_decode("Código"),1,"","L",true);
         $pdf::cell(80,8,utf8_decode("Nombre"),1,"","L",true);
         $pdf::cell(65,8,utf8_decode("Categoría"),1,"","L",true);
         $pdf::cell(15,8,utf8_decode("Precio"),1,"","L",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(30,6,utf8_decode($reg->codigo),1,"","L",true);
            $pdf::cell(80,6,utf8_decode($reg->descripcion),1,"","L",true);
            $pdf::cell(65,6,utf8_decode($reg->categoria),1,"","L",true);
            $pdf::cell(15,6,utf8_decode($reg->stock),1,"","L",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }

}
