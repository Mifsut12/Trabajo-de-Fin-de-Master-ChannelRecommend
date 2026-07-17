<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <!-- En caso de que estes aqui, se mira el caso de que no este logueado -->
    @if(Auth::check())
        <h1> Bienvenido {{ auth()->user()->name  }}</h1>

        @if( auth()->user()->Admin == 1)
        <div class = "div-menuUsuarios">
            <h2> Menu de usuario</h2>
            <a class="enlaces" href="/usuarios">Gestión de usuarios</a>
        </div>

        <div class = "div-menuCanales">
            <h2> Menu de canales</h2>
            <a class="enlaces" href="/canales">Gestión de canales</a>
        </div>    

        <div class = "div-menuProgramas">
            <h2> Menu de programas</h2>
            <a class="enlaces" href="/programas">Gestión de programas</a>
        </div>    
        @else
        <div class = "div-menuReviews">
            <h2> Gestiona tus reseñas</h2>
            <a class="enlaces" href='/menuLogin/reviews/{{Auth::id()}}'>Mis reseñas</a>
        </div>  
        @endif


        
    @else
        <a href = "/"> Volver al Inicio </a>
    @endif
    
    
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