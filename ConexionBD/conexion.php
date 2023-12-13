<?php

function obtenerConexion() {
    $serverName = "carlosTorres";
    $database = "Inventario9524";
    $username = "sa";
    $password = "1992";

    try {
        $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (PDOException $e) {
        echo "Error en la conexión: " . $e->getMessage();
        return null;
    }
}

?>
