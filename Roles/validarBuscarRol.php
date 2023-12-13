<?php
// Establecer la conexión a la base de datos de SQL Server
$serverName = "carlosTorres"; // Reemplaza con el nombre de tu servidor SQL Server
$username = "sa"; // Reemplaza con tu nombre de usuario
$password = "1992"; // Reemplaza con tu contraseña
$dbName = "9524colombia"; // Reemplaza con el nombre de tu base de datos

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
    $sql = "{CALL BuscarUsuario (?)}";
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

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="validarRoles.css">
    <title>Buscar Usuarios y Roles</title>

</head>

<body>

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
    $modoActualizar = isset($_POST['modoActualizar']) ? true : false;

    // Llamar al procedimiento almacenado para actualización
    $sqlActualizar = "{CALL ActualizarUsuario (?, ?, ?)}"; // Ajusta el procedimiento almacenado según tus necesidades
    $paramsActualizar = array(
        array($idUsuarioActualizar, SQLSRV_PARAM_IN),
        array($nombreActualizar, SQLSRV_PARAM_IN),
        array($passwordActualizar, SQLSRV_PARAM_IN)
    );
    $stmtActualizar = sqlsrv_query($conn, $sqlActualizar, $paramsActualizar);
    header('Location: validarBuscarRol.php?exito=1');
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
    header('Location: validarBuscarRol.php?exito=1');
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buscar Usuarios</title>
    </head>

    <body>



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

        <h3>Buscar Usuario</h3>
        <button id="navegarBoton">Atras</button>
        <!-- Script JavaScript para la navegación -->
        <script>
        // Obtén una referencia al botón
        var botonNavegar = document.getElementById("navegarBoton");

        // Agrega un controlador de eventos para el clic en el botón
        botonNavegar.addEventListener("click", function() {
            // Navega a la otra página
            window.location.href =
                "Roles.php"; // Reemplaza "otra_pagina.html" con la URL de la página a la que deseas navegar.
        });
        </script>

        <form id="buscar" method="post" action="">
            <label for="documentoBuscar">Escriba el nombre:</label>
            <input type="text" id="documentoBuscar" name="documentoBuscar" value="<?php echo $documentoBuscar; ?> ">
            <input type="submit" value="Buscar">

        </form>



        <?php
// Mostrar resultados en una tabla
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($resultados)) {
    if (count($resultados) > 0) {
        echo "<h3>Resultados de la búsqueda:</h3>";
        echo "<table border='2'>";
        echo "<tr>
                <th>Id de rol</th>
                <th>Tipo de usuario</th>
                <th>username </th>
                <th>Password </th>
                <th>Tipo </th>
                <th>Operaciones </th>
              </tr>";
            
        foreach ($resultados as $usuario) {
            echo "<tr>";
            echo "<td>" . $usuario["id_rol"] . "</td>";
            echo "<td>" . $usuario["permisos_id_permisos"] . "</td>";
            echo "<td>" . $usuario["username"] . "</td>";
            echo "<td>" . $usuario["password_2"] . "</td>";
            echo "<td>" . $usuario["tipo_permiso"] . "</td>";
        
            echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='idUsuarioEliminar' value='" . $usuario["id_rol"] . "'>
                        <input  type='submit' name='eliminar' value='Eliminar'>
                    </form>
                    
                    <form method='post' action=''>
                    <input type='submit' name='actualizar' value='Actualizar'>
                        <input type='hidden' name='idUsuarioActualizar' value='" . $usuario["id_rol"] . "'>
                        <input type='text' name='nombreActualizar' value='" . $usuario["username"] . "'>
                        <input type='text' name='passwordActualizar' value='" . $usuario["password_2"] . "'>
                        <input type='text' name='passwordActualizar' value='" . $usuario["tipo_permiso"] . "'>


                      
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