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


    <h2> Ficha de modificación de la reseña </h2>
            <form action = "/reviews/{{ $review->id }}" method = "POST" style = "display: inline-block" onsubmit="return confirm('¿Desea aplicar estos cambios?');">
            @csrf
            @method('PATCH')

            
            <label for="Contenido"> Contenido</label>    
            <textarea id= "Contenido" name = "Contenido" rows = 5 > {{ $review -> Contenido }}</textarea>
            <label for="email"> Puntuación (0-10)</label>    
            <input id = "div-inicioDeSesion-form-input" name = "Puntuacion" type = "number"  required = true min= 0 max = 10 value = "{{ $review->Puntuacion_Reseña }}">
                <button type = "submit" class = "boton-peticion" title = "Modificar reseña"> =C </button>
            </form>
    <a href = "/menuLogin"> Volver al perfil </a>

</body>
</html>