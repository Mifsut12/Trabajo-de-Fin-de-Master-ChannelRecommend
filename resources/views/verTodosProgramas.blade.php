<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de programas</title>
    @vite(['resources/css/app.css'])
</head>

    <header class = "header-login">
        @if(Auth::check())
            <form class = "form-cerrarSesion"  method = "post" action = "/menuLogin/logout"> 
                <input id = ".div-inicioDeSesion-form-submit " value = "Cerrar sesión"type = "submit" > 
            </form>
        @endif

        <a class="enlaces" href="/">Inicio</a>

        <a class="enlaces" href="/guia">Guia</a>
    </header>
<body>
    
        @if (count($programas) > 0)
    
            <h1> Listado de programas registrados en ChannelRecommend </h1>
            <table>
                <th>
                    <tr>
                        <td>Nombre</td>
                    </tr>
                </th>
                @foreach($programas as $programa)
                    <tr>
                        <td>{{ $programa->name }}</td>     
                        <td>
                            <a class="enlaces" style = "display: inline-block" href="/programas/{{ $programa->id }}">-O</a>
                        </td>
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
