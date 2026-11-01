<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <!-- Enlazar con el css -->
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

        <a class="enlaces" href="/programas">Programas de ChannelRecommend</a>

        <a class="enlaces" href="/canales">Canales registradas en Channel Recommend</a>

        <a class="enlaces" href="/guia">Guia</a>
    </header>
    <h1 class = "main-h1"> Channel Recommend, encontramos tu programa </h1>
    <main class = "main">

        <div class = "div-inicioDeSesion"> 
            <h2 class = "div-inicio de sesión"> Introduzca sus credenciales de acceso</h2>
            <form class = "div-inicioDeSesion-form"  method = "POST" action = "/login">
                <label for="div-inicioDeSesion-form-input"> Correo electrónico</label>    
                <input id = "div-inicioDeSesion-form-input" name = "email" placeholder = "tucorreo@correo.es" required = true>
                <label for="div-inicioDeSesion-form-input"> Contraseña</label>  
                <input id = "div-inicioDeSesion-form-input2" type = "password" name = "password" required = true>
                <input id = ".div-inicioDeSesion-form-submit " value = "Iniciar sesión"type = "submit" > 
            </form>
        </div>

        <div class = "div-recomendadciones">
            @if(count($mejoresProgramas) > 0)
                <h2 class = "div-recomendacions-h2"> Programas mejor valorados por los usuarios</h2>
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
            @endif

            @if($mejorCadena != null)
                <h2 class = "div-recomendaciones"> La mejor cadena por los usuarios</h2>
                <a class = "enlaces" href="/canales/{{ $mejorCadena -> id }}" > {{ $mejorCadena->name}}</a>
 
            @endif
        </div>     

    </main>


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