<?php
// Establecer la conexión a la base de datos de SQL Server
$serverName = "carlosTorres"; // Reemplaza con el nombre de tu servidor SQL Server
$username = "sa"; // Reemplaza con tu nombre de usuario
$password = "1992"; // Reemplaza con tu contraseña
$dbName = "Inventario9524"; // Reemplaza con el nombre de tu base de datos

$conn = sqlsrv_connect($serverName, array("Database" => $dbName, "Uid" => $username, "PWD" => $password));

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

// Inicializar variables de búsqueda
$documentoBuscar = "";

// Procesar el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //$documentoBuscar = limpiarEntrada($_POST["documentoBuscar"]);

    // Llamar al procedimiento almacenado
    $sql = "{CALL ObtenerDatosPersonas (?)}";
    $params = array(array($documentoBuscar, SQLSRV_PARAM_IN));
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

<?php
// Establecer la conexión a la base de datos de SQL Server
$serverName = "carlosTorres"; // Reemplaza con el nombre de tu servidor SQL Server
$username = "sa"; // Reemplaza con tu nombre de usuario
$password = "1992"; // Reemplaza con tu contraseña
$dbName = "Inventario9524"; // Reemplaza con el nombre de tu base de datos

$conn = sqlsrv_connect($serverName, array("Database" => $dbName, "Uid" => $username, "PWD" => $password));

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

// Inicializar variables de búsqueda y actualización
$documentoBuscar = "";
$idUsuarioActualizar = "";
$nombreActualizar = "";

// Procesar el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {

   // $documentoBuscar = limpiarEntrada($_POST["documentoBuscar"]);
   $documentoBuscar = isset($_POST["documentoBuscar"]) ? limpiarEntrada($_POST["documentoBuscar"]) : '';

    // Llamar al procedimiento almacenado para búsqueda
    $sqlBuscar = "{CALL ObtenerDatosPersonas (?)}";
    $paramsBuscar = array(array($documentoBuscar, SQLSRV_PARAM_IN));
    $stmtBuscar = sqlsrv_query($conn, $sqlBuscar, $paramsBuscar);

    if ($stmtBuscar === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_has_rows($stmtBuscar)) {
        // Resultados encontrados
        $resultados = array();
        while ($row = sqlsrv_fetch_array($stmtBuscar, SQLSRV_FETCH_ASSOC)) {
            $resultados[] = $row;
        }
    } else {
        // No se encontraron resultados
        $resultados = array();
    }
}

// Procesar el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actualizar"])) {
    $idUsuarioActualizar = limpiarEntrada($_POST["idUsuarioActualizar"]);
    $documentoActualizar = limpiarEntrada($_POST["documentoActualizar"]);
    $nombreActualizar = limpiarEntrada($_POST["nombreActualizar"]);
    $telefonoActualizar = limpiarEntrada($_POST["telefonoActualizar"]);
    $correoActualizar= limpiarEntrada($_POST["correoActualizar"]);
    $direccionActualizar = limpiarEntrada($_POST["direccionActualizar"]);


    // Si el campo 'modoActualizar' está presente, establecer el modo actualizar
    $modoActualizar = isset($_POST['modoActualizar']) ? true : false;

    // Llamar al procedimiento almacenado para actualización
    $sqlActualizar = "{CALL ActualizarPersona (?, ?, ?,?,?,?)}"; // Ajusta el procedimiento almacenado según tus necesidades
    $paramsActualizar = array(
        array($idUsuarioActualizar, SQLSRV_PARAM_IN),
        array($documentoActualizar, SQLSRV_PARAM_IN),
        array($nombreActualizar, SQLSRV_PARAM_IN),
        array($telefonoActualizar, SQLSRV_PARAM_IN),
        array($correoActualizar, SQLSRV_PARAM_IN),
        array($direccionActualizar, SQLSRV_PARAM_IN)
  
    );
    $stmtActualizar = sqlsrv_query($conn, $sqlActualizar, $paramsActualizar);
    header('Location: listaPersonas.php?exito=1');
    if ($stmtActualizar === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}




// Procesar el formulario de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $idUsuarioEliminar = limpiarEntrada($_POST["idUsuarioEliminar"]);

    // Llamar al procedimiento almacenado para eliminación
    $sqlEliminar = "{CALL EliminarPersona (?)}";
    $paramsEliminar = array(array($idUsuarioEliminar, SQLSRV_PARAM_IN));
    $stmtEliminar = sqlsrv_query($conn, $sqlEliminar, $paramsEliminar);
    header('Location: listaPersonas.php?exito=1');
    if ($stmtEliminar === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}

// Función para limpiar las entradas del formulario

// Cerrar la conexión a la base de datos
sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar personas</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="listaPersonas.css">
</head>

<body>
    <header>
        <div class="menu-icon" onclick="toggleMenu()">
            <!-- Ícono de tres líneas (hamburguesa) -->
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <ul class="menu-list">
                <li><a href="../menus/menuAdmin.php">Inicio</a></li>
                <li><a href="Personas.php">Personas</a></li>
                <li><a href="../Equipos/equipos.php">Equipos</a></li>
                <li><a href="../Roles/Roles.php">Roles</a></li>
                <li><a href="../login.php">Salir</a></li>
                <!-- Agrega más opciones según sea necesario -->
            </ul>
        </div>

        <script src="script.js"></script>




        <div class="four columns">
            <img src="../img/logo.PNG" id="logo">

        </div>

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



        <form id="buscar" method="post" action="">
            <label for="documentoBuscar">Escriba el nombre:</label>
            <input type="text" id="documentoBuscar" name="documentoBuscar" value="<?php echo $documentoBuscar; ?> ">
            <input type="submit" value="Buscar">

        </form>
    </header>


    <?php
// Mostrar resultados en una tabla
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($resultados)) {
    if (count($resultados) > 0) {
        echo "<h4>Tabla de personas</h3>";
        echo "<table border='2'>";
        echo "<tr>
                <th>Id</th>
                <th>Area</th>
                <th>Cargo</th>
                <th>Estado </th>
                <th>Documento/NIT</th>
                <th>Nombre </th>
                <th>Telefono </th>
                <th>Correo </th>
                <th>Direccion </th>
                <th>Operacion </th>
                <th>Actualizar  </th>
           
              </tr>";
            
            
        foreach ($resultados as $usuario) {
            echo "<tr>";
            echo "<td>" . $usuario["id_persona"] . "</td>";
            echo "<td>" . $usuario["tipo_area"] . "</td>";
            echo "<td>" . $usuario["tipo_cargo"] . "</td>";
            echo "<td>" . $usuario["estado_persona"] . "</td>";
            echo "<td>" . $usuario["doc_persona"] . "</td>";
            echo "<td>" . $usuario["nom_persona"] . "</td>";
            echo "<td>" . $usuario["tel_persona"] . "</td>";
            echo "<td>" . $usuario["corr_persona"] . "</td>";
            echo "<td>" . $usuario["dir_persona"] . "</td>";
        
            echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='idUsuarioEliminar' value='" . $usuario["id_persona"] . "'>
                        <input  type='submit' name='eliminar' value='Eliminar'>
                    </form>
                    
                    <form method='post' action=''>
                        <td>
                        <input type='submit' name='actualizar' value='Actualizar'>
                        <input type='hidden' name='idUsuarioActualizar' value='" . $usuario["id_persona"] . "'></br>
                        
                     
                     
                        </td>


                      
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