<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ url('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ab58011517.js" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                          <a class="navbar-brand" href="#">
                            <img src="{{ url('img/soc.jpg') }}" width="150" class="d-inline-block align-top" alt="">
                          </a>
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <form class="form-inline ml-auto">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <a data-toggle="modal" data-target="#exampleModal" class="add-button"><i class="fas fa-plus-circle"></i>Agregar Material</a>
                          </form>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <main class="py-4">
            @yield('content')
        </main>
        <!-- Modal -->
        <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header" style="border: 0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Agrega la siguiente información</p>
                <form id="multi-file-upload-ajax" method="post" action="/insert" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="name" name="nombre" placeholder="Nombre">
                    <label for="destacada">Imagen destacada</label>
                    <label for="files">Archivos a subir</label>
                    <input type="file" name="filenames[]" id="files" placeholder="Choose files" multiple hidden>
                    <input type="file" name="destacada" id="destacada" hidden>
                    <select name="categoria" id="category">
                        <option value="" selected hidden>Categoría</option>
                        <option value="corporativa">Imagen corporativa</option>
                        <option value="negocio">Líneas de negocio</option>
                        <option value="herramientas">Herramientas</option>
                        <option value="corporativa">Contenido de difusión</option>
                        <option value="eventos">Eventos</option>
                    </select>
                    <select name="tipo" id="type">
                        <option value="" selectec hidden>Tipo</option>
                        <option value="imagen">Imagen</option>
                        <option value="pdf">PDF</option>
                        <option value="word">Word</option>
                        <option value="zip">Zip/Rar</option>
                        <option value="otro">Otro</option>
                    </select>
                    <input type="hidden" value="url({{ url('img/registros') }}" id="base_registro">
                    <input type="hidden" value="url({{ url('archivos') }}" id="base_imagen">
                    <textarea name="descripcion" cols="30" rows="7" placeholder="Descripcion" id="description"></textarea>
                    <input type="submit" value="Guardar">
                </form>
              </div>
            </div>
          </div>
        </div>
        <footer></footer>
    </div>
</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ url('js/main.js') }}"></script>
</html>
