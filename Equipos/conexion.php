<?php

$serverName = "carlosTorres"; // Reemplaza con el nombre o la dirección IP del servidor SQL Server
$connectionOptions = array(
    "Database" => "9524colombia", // Reemplaza con el nombre de la base de datos a la que deseas conectarte
    "UID" => "sa", // Reemplaza con el nombre de usuario de SQL Server
    "PWD" => "192" // Reemplaza con la contraseña del usuario
);

// Establece la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

