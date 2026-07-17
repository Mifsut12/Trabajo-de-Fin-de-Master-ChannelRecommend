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


    <h2> Ficha de modificación de {{ $programa-> name }} </h2>
            <form action = "/programas/{{ $programa->id }}" method = "POST" style = "display: inline-block" onsubmit="return confirm('¿Desea aplicar estos cambios?');">
            @csrf
            @method('PATCH')

                <label for="Nombre"> Nombre del programa</label>    
            <input id = "div-inicioDeSesion-form-input" name = "Nombre" type = "text" required = true value = "{{$programa->name}}">
            
            <label for="Fecha"> Fecha transmisión</label>    
            <input id = "div-inicioDeSesion-form-input" name = "Fecha" type = "date" required = true value = "{{$programa->Fecha_transmision}}">

            <label for="Duracion"> Duracion (Minutos)</label>    
            <input id = "div-inicioDeSesion-form-input" name = "Duracion" type = "number" required = true min = "1" value = "{{$programa->Duracion}}">

            <label for="Hora"> Hora de emision</label>    
            <input id = "div-inicioDeSesion-form-input" name = "Hora" type = "time" required = true value = "{{$programa->Hora_emision}}">

            <label for="Cadena"> Cadena dueña</label>
            <input id = "div-inicioDeSesion-form-input" name = "Cadena" type = "text" required = true value = "{{$programa->canal->name}}">
                
            
                <button type = "submit" class = "boton-peticion" title = "Modificar programa"> =C </button>
            </form>
    <a href = "/menuLogin"> Volver al perfil </a>

</body>
</html>
