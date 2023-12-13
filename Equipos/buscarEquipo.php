<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
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

        /* Estilos para la tabla */
        table {
            width: 100%;
            /* Ancho total de la tabla */
            border-collapse: collapse;
            /* Borde de celda colapsado */
            margin-bottom: 20px;
            /* Espacio al final de la tabla */
        }

        /* Estilos para las celdas de la tabla */
        th,
        td {
            border: 1px solid #ccc;
            /* Borde de celda */
            padding: 8px;
            /* Espaciado interno de celda */
            text-align: left;
            /* Alineación del texto */
        }

        /* Estilos para la fila de encabezados (th) */
        th {
            background-color: #f2f2f2;
            /* Color de fondo de los encabezados */
        }

        /* Estilos alternados para filas impares */
        tr:nth-child(odd) {
            background-color: #e8e8e8;
            /* Color de fondo para filas impares */
        }


        .boton {


            cursor: pointer;

            margin-left: 80%;
            /* Cambia el color del texto a blanco */

        }

        .formulario {
            margin: 5px;
            padding: 30px;
            border: 5px solid #ccc;
            border-radius: 5px;
        }

        .formulario input[type="text"] {
            width: calc(15% - 10px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .formulario input[type="submit"] {
            width: calc(5% - 10px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;

        }

       

        #navegarBoton {

            padding: 10px;
            background-color: green;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 80%;
            /* Cambia el color del texto a blanco */
        }
    </style>
    <meta charset="UTF-8">
    <title>Menú empleados</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=3.0">


</head>

<body>
    <header>
        <div class="four columns">
            <img src="img/logo.PNG" id="logo">
        </div>
        <button id="navegarBoton">Atras</button>
        <!-- Script JavaScript para la navegación -->
        <script>
            // Obtén una referencia al botón
            var botonNavegar = document.getElementById("navegarBoton");

            // Agrega un controlador de eventos para el clic en el botón
            botonNavegar.addEventListener("click", function() {
                // Navega a la otra página
                window.location.href = "equipos.php"; // Reemplaza "otra_pagina.html" con la URL de la página a la que deseas navegar.
            });
        </script>

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


    </header>
    <main>


        <div id="formulario4" class="formulario hidden">

            <h3>Buscar equipo por nombre</h2>
                <form method="POST" action="buscarEquipo.php">
                    <input type="text" name="busqueda" placeholder="Buscar ">
                    <input type="submit" value="Buscar" id="buscar">
                </form>

                <?php
                if (isset($_POST['busqueda'])) {
                    $busqueda = $_POST['busqueda'];


                    // Conexión a la base de datos (archivo 'conexion.php')
                    include 'conexion.php';

                    $registros = array(
                        array("id" => 1, "nombre" => "Registro 1")
                        // Agrega más registros según tus datos
                    );

                    // Llama al procedimiento almacenado
                    $stmt = $conn->prepare("CALL BuscarEmpleado(?,?,?,?,?,?,?,?)");
                    $stmt->bind_param("ssssssss", $busqueda, $id, $nombre, $apellido, $area, $documento, $telefono, $correo);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo "<h3>Resultados de la búsqueda:</h3>";
                        echo "<table>";
                        echo "<tr>
                        
                        <th>ID</th>
                        <th>Nombre </th>
                        <th>Apellido</th>
                        <th>Area</th>
                        <th>Documento</th>
                        <th>Telefono</th>
                        <th>correo</th>
                        <th>Eliminar</th>
                        <th>Actualizar</th>
                        </tr>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id_empleados'] . "</td>";
                            echo "<td>" . $row['nom_empleado'] . "</td>";
                            echo "<td>" . $row['apell_empleado'] . "</td>";
                            echo "<td>" . $row['area_empleado'] . "</td>";
                            echo "<td>" . $row['doc_empleado'] . "</td>";
                            echo "<td>" . $row['tel_empleado'] . "</td>";
                            echo "<td>" . $row['corr_empleado'] . "</td>";

                            foreach ($registros as $registro) {
                                echo "<tr>";
                                echo "<td>";
                                echo "<a href='eliminar.php?id=" . $registro['id'] . "'>Eliminar</a>";
                                echo " | ";
                                echo "<a href='actualizar.php?id=" . $registro['id'] . "'>Actualizar</a>";
                                echo "</td>";
                                echo "</tr>";
                            }

                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "No se encontraron productos que coincidan con la búsqueda.";
                    }

                    // Cerrar la conexión a la base de datos
                    $conn->close();
                }
                ?>


        </div>
    </main>


    <script>
        // Mostrar el formulario correspondiente al hacer clic en una opción del menú
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const formId = this.getAttribute('data-form');
                document.querySelectorAll('.formulario').forEach(form => {
                    form.classList.add('hidden');
                });
                document.getElementById(formId).classList.remove('hidden');
            });
        });
    </script>

</body>

</html>