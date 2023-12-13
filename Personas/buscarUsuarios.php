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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Usuarios</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        left: 40px;
    }

    header {
        padding: 100px;
        margin-left: auto;
        background-color: orange;
        color: black;
        padding: 30px;
    }

    table {
        width: 90%;
        /* Ancho total de la tabla */
        border-collapse: collapse;
        /* Borde de celda colapsado */
        margin-bottom: 20px;
        /* Espacio al final de la tabla */
        margin-left: 30px; 
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    form {
        display: inline-block;
        /* Para que los formularios estén en la misma línea */
        margin: 0;
        /* Elimina el margen predeterminado */
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 8px 12px;

        text text-align: center;


        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
        border-radius: 4px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    input[type="text"] {
        padding: 6px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }





    h3 {
        color: #333;
        margin-left: 30px; 
    }
    #buscar{
        color: #333;
        margin-left: 30px; 

    }

    p {
        color: #555;
    }

    .formulario input[type="text"],
    .formulario input[type="date"],
    .formulario input[type="select"] {
        width: calc(20% - 20px);
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    #equipo {
        width: calc(20% - 20px);
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    #usuario {
        width: calc(20% - 20px);
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }


    input[type="submit"] {
        padding: 10px;

        background-color: green;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;

        /* Cambia el color del texto a blanco */
    }

    #navegarBoton {

        padding: 10px;
        background-color: green;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-left: 80%;
        margin-bottom: 50px;
        
        /* Cambia el color del texto a blanco */
    }
    </style>
</head>

<body>

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

// Inicializar variables de búsqueda y actualización
$documentoBuscar = "";
$idUsuarioActualizar = "";
$nombreActualizar = "";

// Procesar el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {

   // $documentoBuscar = limpiarEntrada($_POST["documentoBuscar"]);
   $documentoBuscar = isset($_POST["documentoBuscar"]) ? limpiarEntrada($_POST["documentoBuscar"]) : '';

    // Llamar al procedimiento almacenado para búsqueda
    $sqlBuscar = "{CALL BuscarUsuario (?)}";
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

    // Llamar al procedimiento almacenado para actualización
    $sqlActualizar = "{CALL ActualizarUsuario (?, ?)}";
    $paramsActualizar = array(
        array($idUsuarioActualizar, SQLSRV_PARAM_IN),
        array($nombreActualizar, SQLSRV_PARAM_IN)
    );
    $stmtActualizar = sqlsrv_query($conn, $sqlActualizar, $paramsActualizar);

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
    <button id="navegarBoton">Atras</button>
            <!-- Script JavaScript para la navegación -->
            <script>
            // Obtén una referencia al botón
            var botonNavegar = document.getElementById("navegarBoton");

            // Agrega un controlador de eventos para el clic en el botón
            botonNavegar.addEventListener("click", function() {
                // Navega a la otra página
                window.location.href =
                    "usuarios.php"; // Reemplaza "otra_pagina.html" con la URL de la página a la que deseas navegar.
            });
            </script>
        <h3>Buscar Usuario</h3>

        <form id="buscar" method="post" action="">
            <label for="documentoBuscar">Documento:</label>
            <input type="text" id="documentoBuscar" name="documentoBuscar" value="<?php echo $documentoBuscar; ?> ">
            <input type="submit" value="Buscar">
          
        </form>

        <?php
// Mostrar resultados en una tabla
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($resultados)) {
    if (count($resultados) > 0) {
        echo "<h3>Resultados de la búsqueda:</h3>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Id de usuario</th>
                <th>Nombre usuario</th>
                <th>telefono </th>
                <th>Correo </th>
                <th>Direccion </th>
                <th>Documento </th>
                <th>Acciones</th>
              </tr>";

        foreach ($resultados as $usuario) {
            echo "<tr>";
            echo "<td>" . $usuario["id_usuario"] . "</td>";
            echo "<td>" . $usuario["nom_usuario"] . "</td>";
            echo "<td>" . $usuario["tel_usuario"] . "</td>";
            echo "<td>" . $usuario["corr_usuario"] . "</td>";
            echo "<td>" . $usuario["dir_usuario"] . "</td>";
            echo "<td>" . $usuario["doc_usuario"] . "</td>";
            echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='idUsuarioEliminar' value='" . $usuario["id_usuario"] . "'>
                        <input type='submit' name='eliminar' value='Eliminar'>
                    </form>
                    
                    <form method='post' action=''>
                        <input type='hidden' name='idUsuarioActualizar' value='" . $usuario["id_usuario"] . "'>
                        <input type='submit' name='actualizar' value='Actualizar'>
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