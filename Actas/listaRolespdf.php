<?php

require('../fpdf/fpdf.php');

// Establecer la conexión a la base de datos de SQL Server
$serverName = "carlosTorres";
$username = "sa";
$password = "1992";
$dbName = "Inventario9524";

$conn = sqlsrv_connect($serverName, array("Database" => $dbName, "Uid" => $username, "PWD" => $password));

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

// Inicializar variables de búsqueda
$numeroBuscar = "";

// Procesar el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroBuscar = isset($_POST["numeroBuscar"]) ? limpiarEntrada($_POST["numeroBuscar"]) : '';

    // Llamar al procedimiento almacenado
    $sql = "{CALL ObtenerActa (?)}";
    $params = array(array($numeroBuscar, SQLSRV_PARAM_IN));
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

// Generar el PDF con FPDF
class PDF extends FPDF {
    function Header() {

         // Ruta de la imagen del logo
         $logoPath = '../img/logo.png';
         // Establece la posición y tamaño del logo
         $this->Image($logoPath, 5, 5, 30);
        $this->SetFont('Arial', '', 12);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0,15, '95/24COLOMBIA S.A.S', 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 15, 'ACTA DE ENTREGA DE EQUIPO DE COMPUTO O EQUIPO CELULAR', 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(40, 0, 'Al momento de la firma de la siguiente acta responsiva, acusa recibo del equipo ', 0, 1, 'L'); // Justificar a la izquierda
        $this->Cell(40, 10, 'de computo descrito mas adelante entregado por la empresa 95/24Colombia S.A.S,', 0, 1, 'L'); // Justificar a la izquierda
        $this->Cell(40, 0, 'quien es representada por el Sr Luis Andres Barrios Torres en lo sucesivo el PROVEEDOR', 0, 1, 'L');
        $this->Cell(40, 10, 'CORPORATIVO,hace entrega del equipo de computo con las siguientes carapteristicas:', 0, 1, 'L'); // Justificar a la izquierda



    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, '9524ColombiaSAS' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Mostrar resultados en el PDF
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($resultados)) {
    if (count($resultados) > 0) {
        $pdf->SetFont('Arial', '', 10);

        // Asumiendo que 'idEquipoBuscar' es el campo único que identifica al equipo
        $idEquipoBuscar = isset($_POST['id_equipo']) ? $_POST['id_equipo'] : null;

       // Buscar el equipo específico
$idEquipoImprimir = isset($_POST['idEquipoImprimir']) ? $_POST['idEquipoImprimir'] : null;
$equipoEncontrado = null;

foreach ($resultados as $equipo) {
    if ($equipo["id_equipo"] == $idEquipoImprimir) {
        $equipoEncontrado = $equipo;
        break;
    }
}

        // Imprimir el equipo encontrado en el PDF
        if ($equipoEncontrado) {
            //$pdf->Cell(40, 10, 'ID Equipo: ' . $equipoEncontrado["id_equipo"], 0, 1);
            $pdf->Cell(40, 10, 'Asignado a: ' . $equipoEncontrado["nom_persona"], 0, 1, 'L');
            $pdf->Cell(40, 0, 'Cargo: ' . $equipoEncontrado["tipo_cargo"], 0, 1, 'L');
            $pdf->Cell(40, 10, 'Area: ' . $equipoEncontrado["tipo_area"], 0, 1, 'L');
            $pdf->Cell(40, 0, 'Marca Equipo: ' . $equipoEncontrado["nom_equipo"], 0, 1, 'L');
            $pdf->Cell(40, 10, 'Numero de celular o Servitag: ' . $equipoEncontrado["num_equipo"], 0, 1, 'L');
            $pdf->Cell(40, 0, 'Tipo de equipo: ' . $equipoEncontrado["tipo_equipo"], 0, 1, 'L');
            $pdf->Cell(40, 10, 'Estado del equipo: ' . $equipoEncontrado["estado_equipo"], 0, 1, 'L');
            $pdf->Cell(40, 0, 'Imei 1: ' . $equipoEncontrado["imei1"], 0, 1, 'L');
            $pdf->Cell(40, 10, 'Imei 2: ' . $equipoEncontrado["imei2"], 0, 1, 'L');


            // Agrega más líneas según tus necesidades
            // Agregar líneas de texto después de la tabla
        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(5); // Espacio entre la tabla y el texto

        // Puedes usar MultiCell para imprimir bloques de texto
        $texto4 = "El USUARIO declara:";
      
        $texto1 = "A.Utilizar dicho equipo de computo exclusivamente para el desarrollo de sus responsabilidades";
        $texto2 = "laborales en la razon social 95/24Colombia S.A.S,obligandome a no instalar y/o desistalar ";
        $texto3 = "programas de computo alguno, sin la previa autorizacion del departamento de Sistemas";
        $texto5 = "B.El usuario reconoce que el equipo de computo asignado es de propiedad de 95/24ColombiaS.A.S";
        $texto6 = "C.Haber revisado por su propia cuenta el equipo de computo en cuestion y a su entera";
        $texto7 = "satisfaccion y en buenas condiciones de uso";
      

        $pdf->MultiCell(0, 0, $texto4, 0, 'L');
        $pdf->MultiCell(0, 10, $texto1, 0, 'L');
        $pdf->MultiCell(0, 0, $texto2, 0, 'L');
        $pdf->MultiCell(0, 10, $texto3, 0, 'L');
        $pdf->MultiCell(0, 10, $texto5, 0, 'L');
        $pdf->MultiCell(0, 10, $texto6, 0, 'L');
        $pdf->MultiCell(0, 0, $texto7, 0, 'L');
       

        $pdf->Ln(10); // Espacio entre el texto y el footer
            $pdf->Ln(20);
            $pdf->Cell(0, 10, 'Firma                         Nombre                              Documento                                Huella  ', 0, 1, 'C');

            $pdf->Output();
        } else {
            $pdf->Cell(0, 10, 'No se encontraron resultados para el ID especificado.', 0, 1);
            $pdf->Output();
        }
    } else {
        $pdf->Cell(0, 10, 'No se encontraron resultados.', 0, 1);
        $pdf->Output();
    }
}
?>