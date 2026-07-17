<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>
<!-- Cerrar sesion -->
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
     @if (!empty($programas))
            @if(Auth::user()->Admin == 1)
                <h1> Datos del programa </h1>
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
                        <td> <form action = "/programas/{{ $programas->id }}" method = "POST" style = "display: inline-block" onsubmit="return confirm('¿Desea borrar a {{ $programas->name }}?');">
                        @csrf
                        @method('DELETE')
                        <button type = "submit" class = "boton-peticion" title = "Borrar programa"  > X </button></form></td>

                        <td> <form action = "/programas/{{ $programas->id }}/modificar" method = "Post" style = "display: inline-block" >
                        @csrf
                    
                        <button type = "submit" class = "boton-peticion" title = "Modificar programa"  > =C </button></form></td>
                </table>
            @endif

            

        @else
            <h1> El programa especificado no existe </h1>
        @endif

    @if(Auth::check())
            <a class = "navegacion" href = "/menuLogin"> Volver al perfil </a>
        @endif
        <a class = "navegacion" href = "/"> Inicio </a>
    
</body>
</html>