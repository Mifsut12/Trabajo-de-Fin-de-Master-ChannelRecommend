<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de programas</title>
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
        @if (count($programas) > 0)
    
            <h1> Listado de programas registrados en ChannelRecommend, selecciona el canal al que deseas hacer una reseña </h1>
            <table>
                <th>
                    <tr>
                        <td>Nombre</td>
                        <td>Fecha de emision</td>
                        <td>Hora de emision</td>
                    </tr>
                </th>
                @foreach($programas as $programa)
                    
                    <tr> 
                        <td>
                            <a class="enlaces" style = "display: inline-block" href="/reviews/nuevo/{{ $programa->id }}">{{ $programa->name }}</a>
                        </td>
                        <td>{{$programa->Fecha_transmision}}</td>
                        <td>{{$programa->Hora_emision}}</td>
                        
                    </tr>
                
                @endforeach
            </table>
        @else
            <h1> En estos momentos no hay programas registrados en ChannelRecommend </h1>
        @endif
        
        

        @if(Auth::check())
            <a href = "/menuLogin"> Volver al perfil </a>
        @endif
        <a href = "/"> Inicio </a>
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

</body>
</html>

