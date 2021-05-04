<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registros;
use App\Models\Archivos;
use Illuminate\Http\File;
use Illuminate\Support\Str;

class RegistrosController extends Controller
{
    public function index(Request $request)
    {
        $corporativa = Registros::where('categoria','corporativa')->orderBy('id','desc')->get();
        $hipocaterio = Registros::where('categoria','hipocaterio')->orderBy('id','desc')->get();
        $empresarial = Registros::where('categoria','empresarial')->orderBy('id','desc')->get();
        $seguros = Registros::where('categoria','seguros')->orderBy('id','desc')->get();
        $franquicias = Registros::where('categoria','franquicias')->orderBy('id','desc')->get();
        $herramientas = Registros::where('categoria','herramientas')->orderBy('id','desc')->get();
        $difusion = Registros::where('categoria','difusion')->orderBy('id','desc')->get();
        $eventos = Registros::where('categoria','eventos')->orderBy('id','desc')->get();
        return view('home',['corporativa'=>$corporativa, 'hipocaterio'=>$hipocaterio, 'empresarial'=>$empresarial, 'seguros'=>$seguros, 'franquicias'=>$franquicias, 'herramientas'=>$herramientas, 'difusion'=>$difusion, 'eventos'=>$eventos]);
    }

    public function linea($linea,  Request $request)
    {
        $corporativa = Registros::where('categoria',$linea)->orderBy('id','desc')->get();
        return view('linea',['corporativa'=>$corporativa, 'linea'=>$linea]);
    }

    public function search($searchTerm, Request $request)
    {
        $corporativa = Registros::where('nombre', 'LIKE', "%{$searchTerm}%")->orWhere('categoria', 'LIKE', "%{$searchTerm}%")->orWhere('descripcion', 'LIKE', "%{$searchTerm}%")->get();
        return view('search',['corporativa'=>$corporativa, 'search'=>$searchTerm]);
    }

    public function registro(Request $request)
    {
    	$registro_id = intval($request->id);
    	$registro = Registros::where('id',$registro_id)->get();
    	$archivos = Archivos::where('registro_id',$registro_id)->get();
    	$count = count($archivos);
    	return response()->json(['registros' => $registro, 'archivos' => $archivos, 'count' => $count]);
    }
    public function archivo($url)
    {

        $registro = Registros::where('url',$url)->get();
     
        $archivos = Archivos::where('registro_id',$registro[0]->id)->get();
        $count = count($archivos);

        $archivos_array = [];

        foreach ($archivos as $key => $value) {
            array_push($archivos_array, $value->url);
        }
        $cadena_equipo = implode(",", $archivos_array );

        $corporativa = Registros::where('categoria','corporativa')->orderBy('id','desc')->get();
        $hipocaterio = Registros::where('categoria','hipocaterio')->orderBy('id','desc')->get();
        $empresarial = Registros::where('categoria','empresarial')->orderBy('id','desc')->get();
        $seguros = Registros::where('categoria','seguros')->orderBy('id','desc')->get();
        $franquicias = Registros::where('categoria','franquicias')->orderBy('id','desc')->get();
        $herramientas = Registros::where('categoria','herramientas')->orderBy('id','desc')->get();
        $difusion = Registros::where('categoria','difusion')->orderBy('id','desc')->get();
        $eventos = Registros::where('categoria','eventos')->orderBy('id','desc')->get();
        return view('home',['corporativa'=>$corporativa, 'hipocaterio'=>$hipocaterio, 'empresarial'=>$empresarial, 'seguros'=>$seguros, 'franquicias'=>$franquicias, 'herramientas'=>$herramientas, 'difusion'=>$difusion, 'eventos'=>$eventos, 'registros' => $registro, 'archivos' => $cadena_equipo, 'count' => $count]);
    }

    public function insertRegistro(Request $request)
    {
        $nombre = $request->nombre;
        $categoria = $request->categoria;
        $tipo = $request->tipo;

        //Clean URL
        $url = Str::slug($nombre, '-');
        $url = $url."-".rand();

        //Upload Imagen Destacada
        $descripcion = $request->descripcion;
        $destacada = $request->file('destacada');
        $destacada_name = rand().time().'.'.$destacada->extension();
        $destacada->move(public_path().'/img/registros/', $destacada_name);  

        $registro_id = Registros::insertGetId([
            'nombre' => $nombre,
            'categoria' => $categoria,
            'tipo' => $tipo,
            'descripcion' => $descripcion,
            'url' => $url,
            'imagen' => $destacada_name,
        ]);

        if($request->hasfile('filenames'))
         {
            foreach($request->file('filenames') as $file)
            {

                $name = rand().time().'.'.$file->extension();
                $file->move(public_path().'/archivos/', $name);  
                Archivos::insertGetId([
                    'url' => $name,
                    'registro_id' => $registro_id,
                ]);  
            }
         }


        $corporativa = Registros::where('categoria','corporativa')->orderBy('id','desc')->get();
        $hipocaterio = Registros::where('categoria','hipocaterio')->orderBy('id','desc')->get();
        $empresarial = Registros::where('categoria','empresarial')->orderBy('id','desc')->get();
        $seguros = Registros::where('categoria','seguros')->orderBy('id','desc')->get();
        $franquicias = Registros::where('categoria','franquicias')->orderBy('id','desc')->get();
        $herramientas = Registros::where('categoria','herramientas')->orderBy('id','desc')->get();
        $difusion = Registros::where('categoria','difusion')->orderBy('id','desc')->get();
        $eventos = Registros::where('categoria','eventos')->orderBy('id','desc')->get();
        return view('home',['corporativa'=>$corporativa,  'hipocaterio'=>$hipocaterio, 'empresarial'=>$empresarial, 'seguros'=>$seguros, 'franquicias'=>$franquicias, 'herramientas'=>$herramientas, 'difusion'=>$difusion, 'eventos'=>$eventos]);
    }
}
