<?php
include '../ConexionBD/conexion.php';

// Obtener la conexión
$conn = obtenerConexion();

if ($conn !== null) {
    // Datos del formulario (suponiendo que vienen del POST)
    $nombre = $_POST['nombre'];

    try {
        // Llamar al procedimiento almacenado
        $sql = "EXEC crearTipoArea @nombreArea = :nombreArea";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombreArea', $nombre, PDO::PARAM_STR); // Asegurarse de que el tipo de dato sea el correcto
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
    } finally {
        // Cerrar la conexión
        $conn = null;
    }
}
?>
