@extends('layouts.app')

@section('content')
<section class="home-section home-1">
    <div class="container">
            @if(!$corporativa->isEmpty())
            <div class="row">
                <div class="col-12">
                    <h2>Imagen Corporativa</h2>
                </div>
                @foreach ($corporativa as $registro_corporativa)
                    <div class="col-md-4">
                        <a href="{{$registro_corporativa->url}}" class="registro_id" id="{{$registro_corporativa->id}}" base="{{ url('img/registros') }}/">
                            <div class="content-registro" style="background-image: url({{ url('img/registros') }}/{{$registro_corporativa->imagen}});"></div>
                            <p class="text-center">
                                {{$registro_corporativa->nombre}}
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>
            @endif
    </div>
</section>
<section class="home-section home-2">
    <div class="container">
            @if(!$negocio->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <h2>Líneas de negocio</h2>
                    </div>
                    @foreach ($negocio as $registro_negocio)
                        <div class="col-md-4">
                            <a href="{{$registro_negocio->url}}" class="registro_id" id="{{$registro_negocio->id}}" base="{{ url('img/registros') }}/">
                                <div class="content-registro" style="background-image: url({{ url('img/registros') }}/{{$registro_negocio->imagen}});"></div>
                                <p class="text-center">
                                    {{$registro_negocio->nombre}}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
    </div>
</section>
<section class="home-section home-3">
    <div class="container">
            @if(!$herramientas->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <h2>Herramientas</h2>
                    </div>
                    @foreach ($herramientas as $registro_herramientas)
                        <div class="col-md-4">
                            <a href="{{$registro_herramientas->url}}" class="registro_id" id="{{$registro_herramientas->id}}" base="{{ url('img/registros') }}/">
                                <div class="content-registro" style="background-image: url({{ url('img/registros') }}/{{$registro_herramientas->imagen}});"></div>
                                <p class="text-center">
                                    {{$registro_herramientas->nombre}}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
    </div>
</section>
<section class="home-section home-4">
    <div class="container">
            @if(!$difusion->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <h2>Contenido de difusión</h2>
                    </div>
                    @foreach ($difusion as $registro_difusion)
                        <div class="col-md-4">
                            <a href="{{$registro_difusion->url}}" class="registro_id" id="{{$registro_difusion->id}}" base="{{ url('img/registros') }}/">
                                <div class="content-registro" style="background-image: url({{ url('img/registros') }}/{{$registro_difusion->imagen}});"></div>
                                <p class="text-center">
                                    {{$registro_difusion->nombre}}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
    </div>
</section>
<section class="home-section home-5">
    <div class="container">
            @if(!$eventos->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <h2>Eventos</h2>
                    </div>
                    @foreach ($eventos as $registro_eventos)
                        <div class="col-md-4">
                            <a href="{{$registro_eventos->url}}" class="registro_id" id="{{$registro_eventos->id}}" base="{{ url('img/registros') }}/">
                                <div class="content-registro" style="background-image: url({{ url('img/registros') }}/{{$registro_eventos->imagen}});"></div>
                                <p class="text-center">
                                    {{$registro_eventos->nombre}}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
    </div>
</section>
<section class="registro-section hide">
    <a href="" class="close"><i class="fas fa-times"></i></a>
    @isset($registros)
        <img class="image_registro" src="{{ url('img/registros') }}/{{$registros[0]->imagen}}" alt="">
        <h3 class="title">{{$registros[0]->nombre}}</h3>
        <p class="description">{{$registros[0]->descripcion}}</p>
        <p class="info"><span>{{$count}}</span> Archivos</p>
        <p class="date">Subido el: <span>{{date_format($registros[0]->created_at,"Y/m/d")}}</span></p>
        <a class="download" href="" files="{{$archivos}}" base="{{ url('archivos') }}/"><i class="fas fa-cloud-download-alt"></i></i> Descargar</a>
        <a class="share" href=""><i class="fas fa-share"></i> Compartir</a>
        <a class="copy" href=""><i class="far fa-copy"></i> Copiar vínculo</a>
        <a class="delete" href=""><i class="far fa-trash-alt"></i> Eliminar</a>
    @endisset

    @empty($registros)
        <img class="image_registro" src="" alt="">
        <h3 class="title"></h3>
        <p class="description"></p>
        <p class="info"><span></span> Archivos</p>
        <p class="date">Subido el: <span></span></p>
        <a class="download" href="" files="[]" base="{{ url('archivos') }}/"><i class="fas fa-cloud-download-alt"></i></i> Descargar</a>
        <a class="share" href=""><i class="fas fa-share"></i> Compartir</a>
        <a class="copy" href=""><i class="far fa-copy"></i> Copiar vínculo</a>
        <a class="delete" href=""><i class="far fa-trash-alt"></i> Eliminar</a>
    @endempty
</section>
@endsection
