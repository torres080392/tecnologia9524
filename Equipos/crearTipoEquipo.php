<?php
// Obtener la conexión
include '../ConexionBD/conexion.php';

try {
    $conn = obtenerConexion();

    if ($conn !== null) {
        // Datos del formulario (suponiendo que vienen del POST)
        $equipo = $_POST['equipo'];

        // Llamar al procedimiento almacenado
        $sql = "EXEC crearTipoEquipo @nombreEquipo = :nombreEquipo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombreEquipo', $equipo, PDO::PARAM_STR); // Asegurarse de que el tipo de dato sea el correcto
        $stmt->execute();

        if ($stmt) {
            // Redireccionar al mismo formulario si la consulta fue exitosa
            header('Location: equipos.php?exito=1');
            exit();
        } else {
            echo "Hubo un error al procesar la solicitud.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Cerrar la conexión
    $conn = null;
}
?>

