<?php
// Conexión a la base de datos SQL Server con PDO
$serverName = "carlosTorres";
$database = "Inventario9524";
$username = "sa";
$password = "1992";

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Datos del formulario (suponiendo que vienen del POST)
    $nombre = $_POST['nombre'];

    // Llamar al procedimiento almacenado
    $sql = "EXEC crearTipoPersona @nombreCargo = :nombreCargo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombreCargo', $nombre, PDO::PARAM_STR); // Asegurarse de que el tipo de dato sea el correcto
    $stmt->execute();

    if ($stmt) {
        // Redireccionar al mismo formulario si la consulta fue exitosa
        header('Location: Personas.php?exito=1');
        exit();
    } else {
        echo "Hubo un error al procesar la solicitud.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>