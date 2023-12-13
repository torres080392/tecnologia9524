<?php
// Conexión a la base de datos SQL Server con PDO (ajusta los detalles de conexión)
$serverName = "carlostorres";
$database = "Inventario9524";
$username = "sa";
$password = "1992";

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Datos del formulario (suponiendo que vienen del POST)
    $id = $_POST['id'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
   
   

    // Llamar al procedimiento almacenado
    $sql = "EXEC crearUsuarios          @tipo_usuario = :tipo_usuario,@username = :username,@password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tipo_usuario', $tipo_usuario);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
   
    $stmt->execute();

    if ($stmt) {
        // Redireccionar al mismo formulario si la consulta fue exitosa
        header('Location: Roles.php?exito=1');
        exit();
    } else {
        echo "Hubo un error al procesar la solicitud.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
