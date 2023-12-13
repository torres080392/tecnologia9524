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
    $tipo_area= $_POST['tipo_area'];
    $tipo_cargo = $_POST['tipo_cargo'];
    $tipo_estado = $_POST['tipo_estado'];
    $tipo_rol = $_POST['tipo_rol'];
    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
  
   
   

    // Llamar al procedimiento almacenado
    $sql = "EXEC crearPersonas @tipo_area = :tipo_area,@tipo_cargo = :tipo_cargo,
    @tipo_estado = :tipo_estado,@tipo_rol = :tipo_rol, @documento = :documento,@nombre = :nombre,@telefono = :telefono, @correo= :correo, @direccion = :direccion";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tipo_area', $tipo_area);
    $stmt->bindParam(':tipo_cargo', $tipo_cargo);
    $stmt->bindParam(':tipo_estado', $tipo_estado);
    $stmt->bindParam(':tipo_rol', $tipo_rol);
    $stmt->bindParam(':documento', $documento);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':direccion', $direccion);
 
   
   
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
