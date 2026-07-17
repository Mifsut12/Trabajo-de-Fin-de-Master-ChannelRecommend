<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <table>
            <tr>
                <th>Nombre</th>
                <th>Fecha de transmisión</th>
                <th>Duración</th>
                <th>Hora de emisión(Hora peninsular)</th>
                <th>Canal dueña</th>
                <th>Puntuación(0-10)</th>
            </tr>
            <tr>
                <td>{{$programas->name}}</td>
                <td>{{$programas->Fecha_transmision}}</td>
                <td>{{$programas->Duracion}}</td>
                <td>{{$programas->Hora_emision}}</td>
                <td>{{$programas->canal->name}}</td>
                <td>{{$programas->Puntuacion}}</td>

                <td>
                    <a class="enlaces" style = "display: inline-block" href="/reviews/programa/{{ $programas->id }}">Ver reseñas de {{ $programas->name }}</a>
                </td>
        </table>

        @if(Auth::check())
            <a class = "navegacion" href = "/menuLogin"> Volver al perfil </a>
        @endif
        <a class = "navegacion" href = "/"> Inicio </a>

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
