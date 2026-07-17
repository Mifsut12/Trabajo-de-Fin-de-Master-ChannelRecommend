<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
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

    <div class = "div-inicioDeSesion"> 
    @if ($user != null)
        <h1> Datos de {{ $user-> name }} </h1>
        <ul>
            <li> {{ $user-> email }} </li>
        </ul>
            <h2> Ficha de modificación de {{ $user-> name }} </h2>
            <form action = "/usuarios/{{ $user->id }}" method = "POST" style = "display: inline-block" onsubmit="return confirm('¿Desea aplicar estos cambios?');">
            @csrf
            @method('PATCH')

                <label for="Nombre"> Nombre</label>    
                <input id = "div-inicioDeSesion-form-input" name = "nombre" type = "text" required = true value = "{{ $user -> name }}">
                <label for="email"> Correo electrónico</label>    
                <input id = "div-inicioDeSesion-form-input" name = "email" type = "email" placeholder = "tucorreo@correo.es" required = true value = "{{ $user -> email }}">
                <label for="password"> Contraseña</label>  
                <input id = "div-inicioDeSesion-form-input2" name = "password" type = "password" required = true value = "{{ $user -> password }}">
            
                <button type = "submit" class = "boton-peticion" title = "Modificar usuario"> =C </button>
            </form>


            <br><form action = "/usuarios/{{ $user->id }}" method = "POST" style = "display: inline-block" onsubmit="return confirm('¿Desea borrar a {{ $user->name }}?');">
                @csrf
                @method('DELETE')
                <button type = "submit" class = "boton-peticion" title = "Borrar usuario"  > X </button>
            </form>
    @else
        <h1> El usuario especificado no esta registrado en el sistema </h1>
    @endif
    @if(Auth::check())
        <br><a href = "/menuLogin"> Volver al perfil </a><br>
    @endif
    <a href = "/"> Inicio </a>



</div>

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
