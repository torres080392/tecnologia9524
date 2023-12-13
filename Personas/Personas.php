<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Menú usuarios</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="personas.css">

</head>

<body>
    <header>
        <div class="four columns">
            <img src="logo.PNG" id="logo">

        </div>
        <div class="menu-icon" onclick="toggleMenu()">
            <!-- Ícono de tres líneas (hamburguesa) -->
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <ul class="menu-list">
                <li><a href="../menus/menuAdmin.php">Inicio</a></li>
                <li><a href="Personas.php">Personas</a></li>
                <li><a href="../Equipos/equipos.php">Equipos </a></li>
                <li><a href="../Roles/Roles.php">Roles </a></li>
                <li><a href="../login.php">Salir</a></li>
                <!-- Agrega más opciones según sea necesario -->
            </ul>
        </div>

        <script src="script.js"></script>

        <div id="mensaje-exito" style="display: none; color: green;">Operación exitosa</div>

        <script>
        // Mostrar el mensaje de éxito si la URL tiene el parámetro exito=1
        if (window.location.search.includes('exito=1')) {
            document.getElementById('mensaje-exito').style.display = 'block';
            setTimeout(function() {
                document.getElementById('mensaje-exito').style.display = 'none';
            }, 3000); // Ocultar el mensaje después de 2 segundos (2000 ms)
        }
        </script>
        <di class="MenuOpciones">
            <nav>
                <ul>
                    <li><a href="#" data-form="formulario1">Crear nuevo cargo</a></li>
                    <li><a href="#" data-form="formulario5">Crear nueva area</a></li>
                    <li><a href="#" data-form="formulario2">Listado de personas</a></li>
                    <li><a href="#" data-form="formulario3">Crear nueva persona</a></li>
                    <li><a href="#" data-form="formulario4">Buscar persona</a></li>

                </ul>
            </nav>

        </di>




    </header>
    <main>
        <div id="formulario1" class="formulario hidden">
            <h2>Crear tipo de usuario</h2>
            <form action="crearTipoPersona.php" method="post">
                <label for="nombre">Crear nuevo cargo:</label>
                <input type="text" id="nombre" name="nombre" require>
                <input type="submit" value="Enviar">
                <!-- Campos del formulario 1 -->
            </form>

        </div>
        <div id="formulario5" class="formulario hidden">
            <h2>Crear nueva area</h2>
            <form action="crearTipoArea.php" method="post">
                <label for="nombre">Crear nueva area:</label>
                <input type="text" id="nombre" name="nombre" require>
                <input type="submit" value="Enviar">
                <!-- Campos del formulario 1 -->
            </form>

        </div>
        <div id="formulario2" class="formulario hidden">
            <form action="listaPersonas.php" method="post">
                <button id="navegarBotonLista">Click aqui</button>
                <!-- Script JavaScript para la navegación -->
                <script>
                // Obtén una referencia al botón
                var botonNavegar = document.getElementById("navegarBoton");

                // Agrega un controlador de eventos para el clic en el botón
                botonNavegar.addEventListener("click", function() {
                    // Navega a la otra página
                    window.location.href =
                        "listaPersonas.php"; // Reemplaza "otra_pagina.html" con la URL de la página a la que deseas navegar.
                });
                </script>


            </form>
        </div>
        <div id="formulario3" class="formulario hidden">
            <h2>Crear una nueva persona</h2>
            <form action="crearPersona.php" method="post">
                <label for="tipo_area">Elejir el area a la que pertenece :</label>
                <select name="tipo_area" id="tipo_area">
                    <?php
                $serverName = "carlosTorres";
                $connectionOptions = array(
                    "Database" => "Inventario9524",
                    "Uid" => "sa",
                    "PWD" => "1992"
                );
                
                $conn = sqlsrv_connect($serverName, $connectionOptions);
                
                if (!$conn) {
                    die(print_r(sqlsrv_errors(), true));
                }
                // Llama al procedimiento almacenado ObtenerArea
                $sql = "EXEC ObtenerTipoArea";
                $query = sqlsrv_query($conn, $sql);
                
                if ($query === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                if (sqlsrv_has_rows($query)) {
                    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                        echo "<option value='" . $row['id_area'] . "'>"  .  $row['tipo_area'] . "</option>";
                    }
                } else {
                    echo "0 resultados";
                }
                // Cierra la conexión a SQL Server
                sqlsrv_close($conn);
                ?>
                </select>


                <label for="tipo_cargo">Elija el cargo de la persona :</label>
                <select name="tipo_cargo" id="tipo_cargo">
                    <?php
                $serverName = "carlosTorres";
                $connectionOptions = array(
                    "Database" => "Inventario9524",
                    "Uid" => "sa",
                    "PWD" => "1992"
                );
                $conn = sqlsrv_connect($serverName, $connectionOptions);
                
                if (!$conn) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                // Llama al procedimiento almacenado ObtenerArea
                $sql = "EXEC ObtenerTipoCargo";
                $query = sqlsrv_query($conn, $sql);
                
                if ($query === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                if (sqlsrv_has_rows($query)) {
                    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                        echo "<option value='" . $row['id_cargo'] . "'>"  .  $row['tipo_cargo'] . "</option>";
                    }
                } else {
                    echo "0 resultados";
                }
                
                // Cierra la conexión a SQL Server
                sqlsrv_close($conn);
                ?>
                </select>




                <label for="tipo_estado">Elija el estado de la persona :</label>
                <select name="tipo_estado" id="tipo_estado">
                    <?php
                $serverName = "carlosTorres";
                $connectionOptions = array(
                    "Database" => "Inventario9524",
                    "Uid" => "sa",
                    "PWD" => "1992"
                );
                
                $conn = sqlsrv_connect($serverName, $connectionOptions);
                
                if (!$conn) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                // Llama al procedimiento almacenado ObtenerArea
                $sql = "EXEC ObtenerTipoEstado";
                $query = sqlsrv_query($conn, $sql);
                
                if ($query === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                if (sqlsrv_has_rows($query)) {
                    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                        echo "<option value='" . $row['id_estado'] . "'>"  .  $row['estado_persona'] . "</option>";
                    }
                } else {
                    echo "0 resultados";
                }
                
                // Cierra la conexión a SQL Server
                sqlsrv_close($conn);
                ?>

                </select>

                <label for="tipo_rol">Elija el rol de la persona :</label>
                <select name="tipo_rol" id="tipo_rol">
                    <?php
                $serverName = "carlosTorres";
                $connectionOptions = array(
                    "Database" => "Inventario9524",
                    "Uid" => "sa",
                    "PWD" => "1992"
                );
                
                $conn = sqlsrv_connect($serverName, $connectionOptions);
                
                if (!$conn) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                // Llama al procedimiento almacenado ObtenerArea
                $sql = "EXEC ObtenerTipoRol";
                $query = sqlsrv_query($conn, $sql);
                
                if ($query === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                if (sqlsrv_has_rows($query)) {
                    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                        echo "<option value='" . $row['id_permisos'] . "'>"  .  $row['tipo_permiso'] . "</option>";
                    }
                } else {
                    echo "0 resultados";
                }
                
                // Cierra la conexión a SQL Server
                sqlsrv_close($conn);
                ?>
                </select>

                <label for="documento">Documento o NIT:</label>
                <input type="text" id="documento" name="documento" require>
                <label for="nombre">Nombre de la persona:</label>
                <input type="text" id="nombre" name="nombre" required>
                <label for="telefono">Telefono:</label>
                <input type="text" id="telefono" name="telefono" require>
                <label for="correo">Correo:</label>
                <input type="text" id="correo" name="correo" require>
                <label for="direccion">Direccion:</label>
                <input type="text" id="direccion" name="direccion" require>

                <input type="submit" value="Enviar">

                <!-- Campos del formulario 3 -->
            </form>
        </div>

        <div id="formulario4" class="formulario hidden">

            <form method="POST" action="buscarUsuarios.php">

                <input type="submit" value="Buscar  " id="buscar">


                <body>

            </form>



        </div>
    </main>


    <script>
    // Mostrar el formulario correspondiente al hacer clic en una opción del menú
    document.querySelectorAll('nav a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const formId = this.getAttribute('data-form');
            document.querySelectorAll('.formulario').forEach(form => {
                form.classList.add('hidden');
            });
            document.getElementById(formId).classList.remove('hidden');
        });
    });
    </script>

</body>

</html>