

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <title>Menú roles</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Roles.css">
</head>

<body>
    <header>
        <div class="four columns">
            <img src="../img/logo.PNG" id="logo">

        </div>
        <div class="menu-icon" onclick="toggleMenu()">
    <!-- Ícono de tres líneas (hamburguesa) -->
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <ul class="menu-list">
        <li><a href="../menus/menuAdmin.php">Inicio</a></li>
        <li><a href="Roles.php">Roles</a></li>
        <li><a href="../Personas/Personas.php">Personas</a></li>
        <li><a href="../Equipos/equipos.php">Equipos</a></li>
        <li><a href="../login.php">Salir</a></li>
        <!-- Agrega más opciones según sea necesario -->
    </ul>
</div>
       <script src="script.js"></script>

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
        <div  class="MenuOpciones">
        <nav>
            <ul>
                <li><a href="#" data-form="formulario2">Listado de usuarios</a></li>
                <li><a href="#" data-form="formulario3">Crear nuevo usuario</a></li>
                <li><a href="#" data-form="formulario4">Buscar usuario</a></li>

            </ul>
        </nav>

        </div>
     

    </header>
    <main>
        <div id="formulario2" class="formulario hidden">
            <form action="listaUsuarios.php" method="post">
                <button id="navegarBotonLista">Clik Aqui</button>
                <!-- Script JavaScript para la navegación -->

            </form>
        </div>
        <div id="formulario3" class="formulario hidden">
            <h2>Crear un nuevo usuario</h2>
            <form action="crearUsuario.php" method="post">
                <label for="tipo_usuario">Selecciones el tipo de usuario :</label>
                <select name="tipo_usuario" id="tipo_usuario">
                    <?php
                $serverName = "carlosTorres";
                $connectionOptions = array(
                    "Database" => "Inventario9524",
                    "Uid" => "sa",
                    "PWD" => "1992"
                );
                
                $conn = sqlsrv_connect($serverName, $connectionOptions);
                
                if (!$conn) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                // Llama al procedimiento almacenado ObtenerUsuarios
                $sql = "EXEC SelecionarTipoUsuario";
                $query = sqlsrv_query($conn, $sql);
                
                if ($query === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                if (sqlsrv_has_rows($query)) {
                    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                        echo "<option value='" . $row['id_permisos'] . "'>"  .  $row['tipo_permiso'] . "</option>";
                    }
                } else {
                    echo "0 resultados";
                }
                
                // Cierra la conexión a SQL Server
                sqlsrv_close($conn);
                ?>

                </select>
                <label for="username">Selecciones el nombre del usuario :</label>
                <select name="username" id="username">
                    <?php
                $serverName = "carlosTorres";
                $connectionOptions = array(
                    "Database" => "Inventario9524",
                    "Uid" => "sa",
                    "PWD" => "1992"
                );
                
                $conn = sqlsrv_connect($serverName, $connectionOptions);
                
                if (!$conn) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                // Llama al procedimiento almacenado ObtenerUsuarios
                $sql = "EXEC SelecionarTipoPersona";
                $query = sqlsrv_query($conn, $sql);
                
                if ($query === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                if (sqlsrv_has_rows($query)) {
                    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                        echo "<option value='" . $row['corr_persona'] . "'>"  .  $row['corr_persona'] . "</option>";
                    }
                } else {
                    echo "0 resultados";
                }
                
                // Cierra la conexión a SQL Server
                sqlsrv_close($conn);
                ?>

                </select>
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" require>
                <input type="submit" value="Enviar">

                <!-- Campos del formulario 3 -->
            </form>
        </div>

        <div id="formulario4" class="formulario hidden">

            <form method="POST" action="validarBuscarRol.php">

                <input type="submit" value="Buscar  " id="buscar">


                <body>
    
            </form>



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
    
<script src="script.js"></script>
</body>

</html>