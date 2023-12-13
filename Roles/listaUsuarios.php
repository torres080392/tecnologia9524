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
    $sql = "{CALL ObtenerDatosRoles (?)}";
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
    $sqlBuscar = "{CALL ObtenerDatosRoles (?)}";
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
    $nombreActualizar = limpiarEntrada($_POST["nombreActualizar"]);
    $passwordActualizar = limpiarEntrada($_POST["passwordActualizar"]);
   


    // Si el campo 'modoActualizar' está presente, establecer el modo actualizar
  

    // Llamar al procedimiento almacenado para actualización
    $sqlActualizar = "{CALL ActualizarUsuario (?, ?, ?)}"; // Ajusta el procedimiento almacenado según tus necesidades
    $paramsActualizar = array(
        array($idUsuarioActualizar, SQLSRV_PARAM_IN),
        array($nombreActualizar, SQLSRV_PARAM_IN),
        array($passwordActualizar, SQLSRV_PARAM_IN)
      
  
    );
    $stmtActualizar = sqlsrv_query($conn, $sqlActualizar, $paramsActualizar);
    header('Location: listaUsuarios.php?exito=1');
    if ($stmtActualizar === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}




// Procesar el formulario de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $idUsuarioEliminar = limpiarEntrada($_POST["idUsuarioEliminar"]);

    // Llamar al procedimiento almacenado para eliminación
    $sqlEliminar = "{CALL EliminarUsuario (?)}";
    $paramsEliminar = array(array($idUsuarioEliminar, SQLSRV_PARAM_IN));
    $stmtEliminar = sqlsrv_query($conn, $sqlEliminar, $paramsEliminar);
    header('Location: listaUsuarios.php?exito=1');
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
    <title>Menú roles</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Usuarios</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="listaUsuarios.css">
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
        <li><a href="Roles.php">Roles</a></li>
        <li><a href="../Personas/Personas.php">Personas</a></li>
        <li><a href="../Equipos/Equipos.php">Equipos</a></li>
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
        <label for="documentoBuscar">Escriba el nombre o Email </label>
        <input type="text" id="documentoBuscar" name="documentoBuscar" value="<?php echo $documentoBuscar; ?> ">
        <input type="submit" value="Buscar">

    </form>
</header>


    <?php

// ... (tu código anterior)

// Lógica de paginación
$registrosPorPagina = 10;
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Verificar si hay resultados antes de la paginación
if (isset($resultados)) {
    // Dividir el array de resultados en bloques de 10 registros
    $bloquesResultados = array_chunk($resultados, $registrosPorPagina);

    // Obtener el bloque de resultados para la página actual
    $resultadosPagina = isset($bloquesResultados[$paginaActual - 1]) ? $bloquesResultados[$paginaActual - 1] : [];
}

// Mostrar resultados en una tabla
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($resultadosPagina)) {
    if (count($resultadosPagina) > 0) {
        echo "<h4>Tabla de usuarios y roles </h3>";
        echo "<table border='2'>";
        echo "<tr>
                <th>Id de rol</th>
                <th>Tipo de usuario</th>
                <th>username </th>
                <th>Password </th>
                <th>Operaciones </th>
                <th>Actualizar contraseña</th>
              </tr>";

        foreach ($resultadosPagina as $usuario) {
            echo "<tr>";
            echo "<td>" . $usuario["id_rol"] . "</td>";
            echo "<td>" . $usuario["tipo_permiso"] . "</td>";
            echo "<td>" . $usuario["username"] . "</td>";
            echo "<td>" . $usuario["password_2"] . "</td>";
         

            echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='idUsuarioEliminar' value='" . $usuario["id_rol"] . "'>
                        <input type='submit' name='eliminar' value='Eliminar'>
                    </form>
                    
                    <form method='post' action=''>
                        <td>
                        <input type='submit' name='actualizar' value='Actualizar'>
                        <input type='hidden' name='idUsuarioActualizar' value='" . $usuario["id_rol"] . "'>
                     
                        <input type='text' name='passwordActualizar' value='" . $usuario["password_2"] . "'>
                    
                        </td>
                    </form>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";

        // Mostrar la paginación
        echo "<div class='pagination'>";
        for ($i = 1; $i <= count($bloquesResultados); $i++) {
            echo "<a  href='?pagina=$i'>$i</a> ";
        }
        
        //echo "</div>";
    } else {
        echo "<p>No se encontraron resultados.</p>";
    }
}

?>




</body>

</html>