<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Menú equipos</title>
    <meta name="viewport" content="width=device-width, initial-scale=3.0">
    <link rel="stylesheet" href="Equipos.css">

</head>

<body>
    <header>
        <div class="four columns">
            <img src="../img/logo.PNG" id="logo">

        </div>
        <div class="menu-icon" onclick="toggleMenu()">
            <!-- Ícono de tres líneas (hamburguesa) -->
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <ul class="menu-list">
                <li><a href="../menus/menuAdmin.php">Inicio</a></li>
                <li><a href="equipos.php">Equipos</a></li>
                <li><a href="../Personas/Personas.php">Personas</a></li>
                <li><a href="../Roles/Roles.php">Roles</a></li>
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
        <div class="MenuOpciones">
            <nav>
                <ul>
                    <li><a href="#" data-form="formulario1">Nuevo tipo de equipo</a></li>
                    <li><a href="#" data-form="formulario2">Listado total de equipos</a></li>
                    <li><a href="#" data-form="formulario3">Crear un equipo en el sistema</a></li>
                    <li><a href="#" data-form="formulario5">Imprimir actas</a></li>


                </ul>
            </nav>
        </div>

    </header>
    <main>
        <div id="formulario1" class="formulario hidden">
            <h2>Crear tipo de quipo</h2>
            <form action="crearTipoEquipo.php" method="post">
                <label for="equipo">Tipo de equipo:</label>
                <input type="text" id="equipo" name="equipo" require>
                <input type="submit" value="Enviar">
                <!-- Campos del formulario 1 -->
            </form>

        </div>
        <div id="formulario5" class="formulario hidden">
            <h2>Buscar acta </h2>
            <form action="equipos.php" method="post">
                <?php
    // Establecer la conexión a la base de datos de SQL Server
    $serverName = "carlosTorres";
    $username = "sa";
    $password = "1992";
    $dbName = "Inventario9524";

    $conn = sqlsrv_connect($serverName, array("Database" => $dbName, "Uid" => $username, "PWD" => $password));

    if (!$conn) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Inicializar variables de búsqueda
    $numeroBuscar = "";

    // Procesar el formulario de búsqueda
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numeroBuscar = isset($_POST["numeroBuscar"]) ? limpiarEntrada($_POST["numeroBuscar"]) : '';

        // Llamar al procedimiento almacenado
        $sql = "{CALL ObtenerActa (?)}";
        $params = array(array($numeroBuscar, SQLSRV_PARAM_IN));
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_has_rows($stmt)) {
            // Resultados encontrados
            $resultados = array();
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $resultados[] = $row;
            }
        } else {
            // No se encontraron resultados
            $resultados = array();
        }
    }

    // Función para limpiar las entradas del formulario
    function limpiarEntrada($dato) {
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

    // Cerrar la conexión a la base de datos
    sqlsrv_close($conn);
    ?>

                <h2>Buscar equipo por Id</h2>

                <form method="post" action="">
                    <label for="numeroBuscar">Número del id del equipo:</label>
                    <input type="text" id="numeroBuscar" name="numeroBuscar" value="<?php echo $numeroBuscar; ?>"
                        require>
                    <input type="submit" value="Buscar">
                </form>

                <?php
    // Mostrar resultados en una tabla
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($resultados)) {
        if (count($resultados) > 0) {
            echo "<h3>Resultados de la Búsqueda</h3>";
            echo "<table>";
            echo "<tr>
            <th>Imprimir acta</th>
                    <th>ID Equipo</th>
                    <th>Asignado a</th>
                    <th>Area</th>
                    <th>Referencia equipo</th>
                    <th>Numero/Servitag</th>
                    <th>Tipo equipo</th>
                    <th>Estado equipo</th>
                  
                   
                    <!-- Agrega más columnas según tus necesidades -->
                </tr>";

            foreach ($resultados as $equipo) {
           
                echo "<tr>";
                echo "<td>
                <form method='post' action='listaRolespdf.php'>
                    <input type='hidden' name='idEquipoImprimir' value='" . $equipo["id_equipo"] . "'>
                    <input class='descargar' type='submit' name='imprimir' value=''>
                </form>
            </td>";
                echo "<td>" . $equipo["id_equipo"] . "</td>";
                echo "<td>" . $equipo["nom_persona"] . "</td>";
                echo "<td>" . $equipo["tipo_area"] . "</td>";
                echo "<td>" . $equipo["nom_equipo"] . "</td>";
                echo "<td>" . $equipo["num_equipo"] . "</td>";
                echo "<td>" . $equipo["tipo_equipo"] . "</td>";
                echo "<td>" . $equipo["estado_equipo"] . "</td>";
              
                
                
             
             
                echo "</tr>";
                
                
            }

            echo "</table>";
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }
    }
    ?>


                <!-- Campos del formulario 1 -->
            </form>

        </div>
        <div id="formulario2" class="formulario hidden">
            <form action="listaEquipos.php" method="post">
                <button id="navegarBotonLista">Click aqui</button>
                <!-- Script JavaScript para la navegación -->
                <script>
                // Obtén una referencia al botón
                var botonNavegar = document.getElementById("navegarBoton");

                // Agrega un controlador de eventos para el clic en el botón
                botonNavegar.addEventListener("click", function() {
                    // Navega a la otra página
                    window.location.href =
                        "Menu.php"; // Reemplaza "otra_pagina.html" con la URL de la página a la que deseas navegar.
                });
                </script>

            </form>
        </div>
        <div id="formulario3" class="formulario hidden">
            <h2>Crear un nuevo equipo</h2>
            <form action="crearEquipo.php" method="post">
                <label for="tipo_usuario">Elija a la persona :</label>
                <select name="tipo_usuario" id="tipo_usuario" <?php
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

// Llama al procedimiento almacenado ObtenerUsuarios
$sql = "EXEC ObtenerTipoUsuario";
$query = sqlsrv_query($conn, $sql);

if ($query === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($query)) {
    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
        echo "<option value='" . $row['id_persona'] . "'>" . $row['nom_persona'] . "</option>";
    }
} else {
    echo "0 resultados";
}

// Cierra la conexión a SQL Server
sqlsrv_close($conn);
?> </select>
                    <form action="crearEquipo.php" method="post">
                        <label for="estado_equipo">Estado del equipo:</label>
                        <select name="estado_equipo" id="estado_equipo">
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

// Llama al procedimiento almacenado ObtenerTiposEquipo
$sql = "EXEC ObtenerEstadoEquipo";
$query = sqlsrv_query($conn, $sql);

if ($query === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($query)) {
    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
        echo "<option value='" . $row['id_estado'] . "'>" . $row['estado_equipo'] . "</option>";
    }
} else {
    echo "0 resultados";
}

// Cierra la conexión a SQL Server
sqlsrv_close($conn);
?>


                        </select>


                        <form action="crearEquipo.php" method="post">
                            <label for="tipo_equipo">Tipo de equipo :</label>
                            <select name="tipo_equipo" id="tipo_equipo">
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
                
                // Llama al procedimiento almacenado ObtenerUsuarios
                $sql = "EXEC ObtenerTipoEquipo";
                $query = sqlsrv_query($conn, $sql);
                
                if ($query === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                if (sqlsrv_has_rows($query)) {
                    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                        echo "<option value='" . $row['id_equipo'] . "'>" . $row['tipo_equipo'] . "</option>";
                    }
                } else {
                    echo "0 resultados";
                }
                
                // Cierra la conexión a SQL Server
                sqlsrv_close($conn);
                ?>


                            </select>

                            <label for="nombre">Referencia del equipo:</label>
                            <input type="text" id="nombre" name="nombre" required>
                            <label for="numero">Numero o serial:</label>
                            <input type="text" id="numero" name="numero" require>
                            <label for="fecha_compra">Fecha de compra:</label>
                            <input type="date" id="fecha_compra" name="fecha_compra" require>
                            <label for="fecha_inicio">Fecha inicio grantia:</label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" require>
                            <label for="fecha_final">Fecha final grantia:</label>
                            <input type="date" id="fecha_final" name="fecha_final" require>
                            <label for="imei1">Imei:1:</label>
                            <input type="text" id="imei1" name="imei1" require>
                            <label for="imei2">Imei:2:</label>
                            <input type="text" id="imei2" name="imei2" require>
                            <input type="submit" value="Enviar">

                            <!-- Campos del formulario 3 -->
                        </form>
        </div>

        <div id="formulario4" class="formulario hidden">

            <form method="POST" action="buscarEmpleado.php">

                <input type="submit" value="Buscar  " id="buscar">
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