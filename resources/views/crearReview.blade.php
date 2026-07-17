<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar usuario</title>
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
    <h1> Rellenar la reseña para {{ $programa->name }} </h1>

    <div class = "div-inicioDeSesion">
    <form class = "div-inicioDeSesion-form" method = "post" action = "/reviews">
            @csrf

            <label for="Programa"> Programa</label>
            <input id = "div-inicioDeSesion-form-input" name = "Programa" type = "text" readonly required = true value = "{{ $programa->name }}">
            <label for="Contenido"> Contenido</label>    
            <textarea id= "Contenido" name = "Contenido" rows = 5> </textarea>
            <label for="email"> Puntuación (0-10)</label>    
            <input id = "div-inicioDeSesion-form-input" name = "Puntuacion" type = "number"  required = true min= 0 max = 10>
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


