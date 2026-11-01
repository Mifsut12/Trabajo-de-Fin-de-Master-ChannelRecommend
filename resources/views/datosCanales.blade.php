<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canal</title>
    @vite(['resources/css/app.css'])
</head>
<body>
        <header class = "header-login">
        @if(Auth::check())
            <form class = "form-cerrarSesion"  method = "post" action = "/menuLogin/logout"> 
                <input id = ".div-inicioDeSesion-form-submit " value = "Cerrar sesión"type = "submit" > 
            </form>
        @endif

        <a class="enlaces" href="/">Inicio</a>

        <a class="enlaces" href="/guia">Guia</a>
    </header>

    <div class = "div-inicioDeSesion"> 
    @if ($canal != null)
        @if(Auth::check())
            @if(Auth::user()->Admin == 1)
                <h1> Datos de {{ $canal-> name }} </h1>
                    <form action = "/canales/{{ $canal->id }}" method = "POST" style = "display: inline-block" onsubmit="return confirm('¿Desea aplicar estos cambios?');">
                    @csrf
                    @method('PATCH')

                        <label for="Nombre"> Nombre</label>    
                        <input id = "div-inicioDeSesion-form-input" name = "nombre" type = "text" required = true value = "{{ $canal -> name }}" >
                        
                    
                        <button type = "submit" class = "boton-peticion" title = "Modificar canal" > =C </button>
                    </form>


                    <br><form action = "/canales/{{ $canal->id }}" method = "POST" style = "display: inline-block" onsubmit="return confirm('¿Desea borrar a {{ $canal->name }}?');">
                    @csrf
                    @method('DELETE')
                    <button type = "submit" class = "boton-peticion" title = "Borrar canal"  > X </button>
                </form>
                <br><a href = "/canales/{{ $canal-> id }}/programas"> Gestión de canales de {{ $canal-> name}} </a><br>
            @else
                <h2> Nombre: {{ $canal-> name }} </h2>
                <h2> Puntuación: {{ $canal-> Puntuacion_Global }} </h2>
                @if (count($proximasEmisiones) > 0)
    
                <h1> Proximas emisiones de {{ $canal-> name }} </h1>
                <table>
                    <th>
                        <tr>
                            <td>Nombre</td>
                            <td>Fecha de transmision (Año-mes-dia)</td>
                            <td>Hora de emision (Peninsular)</td>
                            
                        </tr>
                    </th>
                    @foreach($programas as $programa)
                        <tr>
                            <td>{{ $programa->name }}</td>
                            <td>{{ $programa->Fecha_transmision }}</td>
                            <td>{{ $programa->Hora_emision}}</td>
                            
                            <td>
                                <a class="enlaces" style = "display: inline-block" href="/programas/{{ $programa->id }}">-O</a>
                                
                            </td>
                        </tr>
                    
                    @endforeach
                </table>
            @else
                <h1> En estos momentos {{ $canal->name }} no tiene emisiones futuras </h1>
            @endif

            @if(count($mejoresProgramas) > 0)
                <div class = "div-recomendadciones">
                    <h2 class = "div-recomendacions-h2"> Programas mejor valorados por los usuarios de {{ $canal -> name }}</h2>
                    <table>
                        <th>
                            <tr>
                                <td>Nombre</td>
                            </tr>
                        </th>
                        @foreach($mejoresProgramas as $programa)
                            <tr>
                                <td>{{ $programa->name }}</td>     
                                <td>
                                    <a class="enlaces" style = "display: inline-block" href="/programas/{{ $programa->id }}">-O</a>
                                </td>
                            </tr>
                        
                        @endforeach
                    </table>
                </div>
            @endif

            @endif
        @else 
            <h2> Nombre: {{ $canal-> name }} </h2>
            <h2> Puntuación: {{ $canal-> Puntuacion_Global }} </h2>
            @if (count($proximasEmisiones) > 0)
    
                <h1> Proximas emisiones de {{ $canal-> name }} </h1>
                <table>
                    <th>
                        <tr>
                            <td>Nombre</td>
                            <td>Fecha de transmision (Año-mes-dia)</td>
                            <td>Hora de emision (Peninsular)</td>
                            
                        </tr>
                    </th>
                    @foreach($programas as $programa)
                        <tr>
                            <td>{{ $programa->name }}</td>
                            <td>{{ $programa->Fecha_transmision }}</td>
                            <td>{{ $programa->Hora_emision}}</td>
                            <td>
                                <a class="enlaces" style = "display: inline-block" href="/programas/{{ $programa->id }}">-O</a>
                            </td>
                        </tr>                    
                    @endforeach
                </table>
                @else
            <h1> En estos momentos {{ $canal->name }} no tiene emisiones futuras </h1>
            @endif

            

            
            @if(count($mejoresProgramas) > 0)
                <div class = "div-recomendadciones">
                    <h2 class = "div-recomendacions-h2"> Programas mejor valorados por los usuarios de {{ $canal -> name }}</h2>
                    <table>
                        <th>
                            <tr>
                                <td>Nombre</td>
                            </tr>
                        </th>
                        @foreach($mejoresProgramas as $programa)
                            <tr>
                                <td>{{ $programa->name }}</td>     
                                <td>
                                    <a class="enlaces" style = "display: inline-block" href="/programas/{{ $programa->id }}">-O</a>
                                </td>
                            </tr>
                        
                        @endforeach
                    </table>
                </div>
            @endif

           

        @endif
    @else
        <h1> El canal especificado no esta registrado en el sistema </h1>
    @endif
    @if(Auth::check())
        <br><a href = "/menuLogin"> Volver al perfil </a><br>
    @endif
    <a href = "/"> Inicio </a>



</div>

    <footer class = "footer"> 
        <h2 class = "footer-h2">Creado por Ricardo Mifsut Castilla, estudiante de UNIR</h2>
        <h3 class = "footer-h3"> Contacto </h3>
        <h4 class = "footer-h4"> Teléfono </h4>
        <h4 class = "footer-h4"> Correo </h4>
        <h5 class = "footer-h5"> 123456789 </h5>
        <h5 class = "footer-h5"> micorreo@correo.es </h5>
    </footer>
</body>
</html>
