<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="actas.css">
    <title>Buscar Producto por Número</title>
   
</head>
<header>
<div class="menu-icon" onclick="toggleMenu()">
            <!-- Ícono de tres líneas (hamburguesa) -->
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <ul class="menu-list">
                <li><a href="../menus/menuAdmin.php">Inicio</a></li>
                <li><a href="../Equipos/equipos.php">Equipos</a></li>
                <li><a href="../Personas/Personas.php">Personas</a></li>
                <li><a href="../Roles/Roles.php">Roles</a></li>
                <li><a href="../login.php">Salir</a></li>
                <!-- Agrega más opciones según sea necesario -->
            </ul>
        </div>
        <script src="script.js"></script>
</header>
<body>

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
        <input type="text" id="numeroBuscar" name="numeroBuscar" value="<?php echo $numeroBuscar; ?>" require>
        <input type="submit" value="Buscar">
    </form>

    <?php
    // Mostrar resultados en una tabla
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($resultados)) {
        if (count($resultados) > 0) {
            echo "<h3>Resultados de la Búsqueda</h3>";
            echo "<table>";
            echo "<tr>
                    <th>ID Equipo</th>
                    <th>Asignado a</th>
                    <th>Area</th>
                    <th>Referencia equipo</th>
                    <th>Numero/Servitag</th>
                    <th>Tipo equipo</th>
                    <th>Estado equipo</th>
                    <th>Imprimir acta</th>
                   
                    <!-- Agrega más columnas según tus necesidades -->
                </tr>";

            foreach ($resultados as $equipo) {
                echo "<tr>";
                echo "<td>" . $equipo["id_equipo"] . "</td>";
                echo "<td>" . $equipo["nom_persona"] . "</td>";
                echo "<td>" . $equipo["tipo_area"] . "</td>";
                echo "<td>" . $equipo["nom_equipo"] . "</td>";
                echo "<td>" . $equipo["num_equipo"] . "</td>";
                echo "<td>" . $equipo["tipo_equipo"] . "</td>";
                echo "<td>" . $equipo["estado_equipo"] . "</td>";
              
                
                
                echo "<td>
                <form method='post' action='listaRolespdf.php'>
                    <input type='hidden' name='idEquipoImprimir' value='" . $equipo["id_equipo"] . "'>
                    <input type='submit' name='imprimir' value='Desacargar'>
                </form>
            </td>";
             
                echo "</tr>";
                
                
            }

            echo "</table>";
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }
    }
    ?>

</body>
</html>
