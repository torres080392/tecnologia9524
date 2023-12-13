





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
    <button id="navegarBoton">Salir </button>
    <!-- Script JavaScript para la navegación -->


    <div class="barra">

        <div class="container">
            <h3>INVENTARIO 9524 TECNOLOGIA</h3>
            <div class="row">
                <div class="four columns icono icono1">

                </div>
            </div>
        </div>

    </div>

    <div id="lista-cursos" class="container">

        <div class="row">
            <div class="four columns">
                <div class="card">
                    <img src="img/equipos.png" class="imagen-curso u-full-width">
                    <div class="info-card">
                        <h4>EQUIPOS</h4>
                        <a href="../Equipos/equipos.php" class="u-full-width button-primary button input "
                            data-id="1">Gestionar</a>
                    </div>
                </div>
                <!--.card-->
            </div>

            <div class="four columns">
                <div class="card">
                    <img src="img/usuarios.png" class="imagen-usuario u-full-width">
                    <div class="info-card">
                        <h4>USUARIOS</h4>

                        <a href="../roles/roles.php" class="u-full-width button-primary button"
                            data-id="2">Gestionar</a>
                    </div>
                </div>
            </div>


            <div class="four columns">
                <div class="card">
                    <img src="img/garantias.png" class="imagen-curso u-full-width">
                    <div class="info-card">
                        <h4>PAGOS </h4>
                        <a href="#" class="u-full-width button-primary button input " data-id="3">Gestionar</a>

                    </div>
                </div>
                <!--.card-->
            </div>


        </div>
        <!--.row-->
        <div class="row">
            <div class="four columns">
                <div class="card">
                    <img src="img/proveedores.png" class="imagen-curso u-full-width">
                    <div class="info-card">
                        <h4>PERSONAS</h4>

                        <a href="../Personas/Personas.php" class="u-full-width button-primary button"
                            data-id="4">Gestionar</a>
                    </div>
                </div>
                <!--.card-->
            </div>

            <div class="four columns">
                <div class="card">
                    <img src="img/asignaciones.png" class="imagen-curso u-full-width">
                    <div class="info-card">
                        <h4>ACTAS DE EQUIPOS</h4>
                        <a href="../Actas/buscarActa.php" class=" u-full-width button-primary button  "
                            data-id="5">Gestionar</a>
                    </div>
                </div>
                <!--.card-->
            </div>

        </div>
        <!--.row-->

    </div>
    <!--.row-->
    </div>

    <footer id="footer" class="footer">
        <div class="container">
            <div class="row">
                <div class="four columns">
                    <nav id="principal" class="menu">
                        <a class="enlace" href="#">Historia de 9524Colombia SAS</a>
                        <a class="enlace" href="#">Truper </a>
                        <a class="enlace" href="#">Soporte</a>
                        <a class="enlace" href="#">Contacto</a>
                    </nav>
                </div>
                <div class="four columns">
                    <nav id="secundaria" class="menu">
                        <a class="enlace" href="#">¿Quienes Somos?</a>
                        <a class="enlace" href="#">Ir a sitios relacionados</a>
                    </nav>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/app.js"></script>
    <script src="script.js"></script>
</body>

</html>