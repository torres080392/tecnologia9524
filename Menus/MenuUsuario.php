<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>InventarioTecnologico9524</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/custom.css">

</head>

<body>
    <header id="header" class="header">

        <div class="four columns">
            <img src="img/logo.PNG" id="logo">
          
        </div>

    </header>
    <button id="navegarBoton">Salir</button>
    <!-- Script JavaScript para la navegación -->
    <script>
    // Obtén una referencia al botón
    var botonNavegar = document.getElementById("navegarBoton");

    // Agrega un controlador de eventos para el clic en el botón
    botonNavegar.addEventListener("click", function() {
        // Navega a la otra página
        window.location.href =
        "../login.php"; // Reemplaza "otra_pagina.html" con la URL de la página a la que deseas navegar.
    });
    </script>
    <div class="barra">
        <div class="container">
            <div class="row">
                <div class="four columns icono icono1">
                    <p>Menu principal <br>
                    <p>Seleciona el modulo de tu interes</p>
                </div>
                <div class="four columns icono icono2">
                    <p>modifica la onformacion a tu manera <br>
                    <p>Crea,Actualiza,Consulta,Elimina</p>
                </div>
                <div class="four columns icono icono3">
                    <p>Inventario 9524<br>
                    <p> Todos los derechos reservados</p>
                </div>
            </div>
        </div>

    </div>

    <div id="lista-cursos" class="container">
        <h1 id="encabezado" class="encabezado"> Inventario de tecnologia 9524Colombia</h3>
            <div class="row">
                <div class="four columns">
                    <div class="card">
                        <img src="img/equipos.png" class="imagen-curso u-full-width">
                        <div class="info-card">
                            <h4>Gestion de equipos</h4>
                            <a href="equipos.php" class="u-full-width button-primary button input " data-id="1">Gestionar</a>
                        </div>
                    </div> <!--.card-->
                </div>

                <div class="four columns">
                    <div class="card">
                        <img src="img/usuarios.png" class="imagen-usuario u-full-width">
                        <div class="info-card">
                            <h4>Gestion de accesos</h4>

                            <a href="#" class="u-full-width button-primary button" data-id="2">Gestionar</a>
                        </div>
                    </div>
                </div>

                <div class="four columns">
                    <div class="card">
                        <img src="img/moviles.png" class="imagen-curso u-full-width">
                        <div class="info-card">
                            <h4>Gestion de moviles</h4>
                            <a href="menuMoviles.php" class="u-full-width button-primary button " data-id="3">Gestionar</a>
                        </div>
                    </div> <!--.card-->
                </div>

            </div> <!--.row-->
            <div class="row">
                <div class="four columns">
                    <div class="card">
                        <img src="img/proveedores.png" class="imagen-curso u-full-width">
                        <div class="info-card">
                            <h4>Gestion de proveedores</h4>

                            <a href="#" class="u-full-width button-primary button" data-id="4">Gestionar</a>
                        </div>
                    </div> <!--.card-->
                </div>
                <div class="four columns">
                    <div class="card">
                        <img src="img/empleados.png" class="imagen-curso u-full-width">
                        <div class="info-card">
                            <h4>Gestion de usuarios</h4>

                            <a href="PHPusuarios.php/usuarios.php" class="u-full-width button-primary button input " data-id="5">Gestionar</a>
                        </div>
                    </div> <!--.card-->
                </div>
                <div class="four columns">
                    <div class="card">
                        <img src="img/asignaciones.png" class="imagen-curso u-full-width">
                        <div class="info-card">
                            <h4>Asignar equipos</h4>
                            <a href="asignarEquipo.php" class="u-full-width button-primary button input " data-id="6">Gestionar</a>
                        </div>
                    </div> <!--.card-->
                </div>

                <div class="four columns">
                    <div class="card">
                        <img src="img/garantias.png" class="imagen-curso u-full-width">
                        <div class="info-card">
                            <h4>Equipos en garantia</h4>
                            <a href="#" class="u-full-width button-primary button input " data-id="6">Gestionar</a>
                        </div>
                    </div> <!--.card-->
                </div>
            </div> <!--.row-->

    </div> <!--.row-->
    </div>

    <footer id="footer" class="footer">
        <div class="container">
            <div class="row">
                <div class="four columns">
                    <nav id="principal" class="menu">
                        <a class="enlace" href="#">Para tu Negocio</a>
                        <a class="enlace" href="#">Historia de 9524</a>
                        <a class="enlace" href="#">Truper </a>
                        <a class="enlace" href="#">Soporte</a>
                        <a class="enlace" href="#">Temas</a>
                    </nav>
                </div>
                <div class="four columns">
                    <nav id="secundaria" class="menu">
                        <a class="enlace" href="#">¿Quienes Somos?</a>
                        <a class="enlace" href="#">Empleo</a>
                        <a class="enlace" href="#">Blog</a>
                    </nav>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/app.js"></script>

</body>

</html>