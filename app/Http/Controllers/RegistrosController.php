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
        $negocio = Registros::where('categoria','negocio')->orderBy('id','desc')->get();
        $herramientas = Registros::where('categoria','herramientas')->orderBy('id','desc')->get();
        $difusion = Registros::where('categoria','difusion')->orderBy('id','desc')->get();
        $eventos = Registros::where('categoria','eventos')->orderBy('id','desc')->get();
        return view('home',['corporativa'=>$corporativa, 'negocio'=>$negocio, 'herramientas'=>$herramientas, 'difusion'=>$difusion, 'eventos'=>$eventos]);
    }

    public function registro(Request $request)
    {
    	$registro_id = intval($request->id);
    	$registro = Registros::where('id',$registro_id)->get();
    	$archivos = Archivos::where('registro_id',$registro_id)->get();
    	$count = count($archivos);
    	return response()->json(['registros' => $registro, 'archivos' => $archivos, 'count' => $count]);
    }
    public function archivo($id)
    {
        $registro_id = intval($id);
        $registro = Registros::where('id',$id)->get();
        $archivos = Archivos::where('registro_id',$id)->get();
        $count = count($archivos);

        $archivos_array = [];

        foreach ($archivos as $key => $value) {
            array_push($archivos_array, $value->url);
        }
        $cadena_equipo = implode(",", $archivos_array );

        $corporativa = Registros::where('categoria','corporativa')->orderBy('id','desc')->get();
        $negocio = Registros::where('categoria','negocio')->orderBy('id','desc')->get();
        $herramientas = Registros::where('categoria','herramientas')->orderBy('id','desc')->get();
        $difusion = Registros::where('categoria','difusion')->orderBy('id','desc')->get();
        $eventos = Registros::where('categoria','eventos')->orderBy('id','desc')->get();
        return view('home',['corporativa'=>$corporativa, 'negocio'=>$negocio, 'herramientas'=>$herramientas, 'difusion'=>$difusion, 'eventos'=>$eventos, 'registros' => $registro, 'archivos' => $cadena_equipo, 'count' => $count]);
    }

    public function insertRegistro(Request $request)
    {
        $nombre = $request->nombre;
        $categoria = $request->categoria;
        $tipo = $request->tipo;

        //Clean URL
        $url = Str::slug($nombre, '-');

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
        $negocio = Registros::where('categoria','negocio')->orderBy('id','desc')->get();
        $herramientas = Registros::where('categoria','herramientas')->orderBy('id','desc')->get();
        $difusion = Registros::where('categoria','difusion')->orderBy('id','desc')->get();
        $eventos = Registros::where('categoria','eventos')->orderBy('id','desc')->get();
        return view('home',['corporativa'=>$corporativa, 'negocio'=>$negocio, 'herramientas'=>$herramientas, 'difusion'=>$difusion, 'eventos'=>$eventos]);
    }
}
