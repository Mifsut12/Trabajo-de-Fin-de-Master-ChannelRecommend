<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar programa</title>
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
    <h1>Rellanar el formulario para el nuevo programa</h1>

    <div class = "formulario">
    <form class = "div-inicioDeSesion-form" method = "post" action = "/canales/{{$canal->id}}/programas">
            @csrf

            <label for="Nombre"> Nombre del programa</label>    
            <input id = "div-inicioDeSesion-form-input" name = "Nombre" type = "text" required = true>
            
            <label for="Fecha"> Fecha transmisión</label>    
            <input id = "div-inicioDeSesion-form-input" name = "Fecha" type = "date" required = true value = {{$fecha}}>

            <label for="Duracion"> Duracion (Minutos)</label>    
            <input id = "div-inicioDeSesion-form-input" name = "Duracion" type = "number" required = true min = "1">

            <label for="Hora"> Hora de emision</label>    
            <input id = "div-inicioDeSesion-form-input" name = "Hora" type = "time" required = true >

            <label for="Cadena"> Cadena dueña</label>
            <input id = "div-inicioDeSesion-form-input" name = "Cadena" type = "text" readonly required = true value = "{{$canal->name}}" disabled = true>

            
    
            <input id = ".div-inicioDeSesion-form-submit " value = "Registrar" type = "submit"> 
    </form>
</div>
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


