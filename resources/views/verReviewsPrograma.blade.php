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

    

        @if (count($reviews) > 0)
        
            @foreach($reviews as $r)
                
                <table>
                    <tr>
                        <th>Contenido</th>
                        <th>Puntuación</th>
                    </tr>
                    <tr>
                        <td>{{$r->review->Contenido}}</td>
                        <td>{{$r->review->Puntuacion_Reseña}}</td>
                </table>
            @endforeach
        @else
            <h1> No existen reseñas para este programa</h1>
        @endif
    
        
        <a href = "/"> Inicio </a>
    
</body>
</html>

