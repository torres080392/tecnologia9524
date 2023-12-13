function toggleMenu() {
    var menuList = document.querySelector('.menu-list');
    menuList.style.display = (menuList.style.display === 'block') ? 'none' : 'block';
}

 // Obtén una referencia al botón
 var botonNavegar = document.getElementById("navegarBoton");

 // Agrega un controlador de eventos para el clic en el botón
 botonNavegar.addEventListener("click", function() {
     // Navega a la otra página
     window.location.href =
         "../Menus/MenuAdmin.php"; // Reemplaza "otra_pagina.html" con la URL de la página a la que deseas navegar.
 });

   // Mostrar el mensaje de éxito si la URL tiene el parámetro exito=1
   if (window.location.search.includes('exito=1')) {
    document.getElementById('mensaje-exito').style.display = 'block';
    setTimeout(function() {
        document.getElementById('mensaje-exito').style.display = 'none';
    }, 3000); // Ocultar el mensaje después de 2 segundos (2000 ms)

    var htmlInyectado = "<p>Este es el HTML inyectado.</p>";
}