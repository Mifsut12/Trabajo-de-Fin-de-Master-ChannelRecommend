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

    @if(Auth::check())

        <a class="enlaces" href="/menuLogin/reviews/{{ Auth::id() }}/nuevo">Crear reseña</a>
        @if (count($reviews) > 0)
        <h1> Datos de la reseña </h1>
            @foreach($reviews as $review)
                
                <table>
                    <tr>
                        <th>Contenido</th>
                        <th>Puntuación</th>
                    </tr>
                    <tr>
                        <td>{{$review->Contenido}}</td>
                        <td>{{$review->Puntuacion_Reseña}}</td>
                        <td> <form action = "/reviews/{{ $review->id }}" method = "POST" style = "display: inline-block" onsubmit="return confirm('¿Desea borrar esta reseña?');">
                        @csrf
                        @method('DELETE')
                        <button type = "submit" class = "boton-peticion" title = "Borrar reseña"  > X </button></form></td>

                        <td> <form action = "/reviews/modificar/{{ $review->id }}" method = "Post" style = "display: inline-block" >
                        @csrf
                    
                        <button type = "submit" class = "boton-peticion" title = "Modificar reseña"  > =C </button></form></td>
                </table>
                -
            @endforeach
        @else
            <h1> Aún no has creado ninguna reseña </h1>

            
        @endif

        
    @else
        <h1> Acceso denegado por falta de privilegios </h1>
        <a href = "/"> Inicio </a>
    @endif

</body>
</html>
