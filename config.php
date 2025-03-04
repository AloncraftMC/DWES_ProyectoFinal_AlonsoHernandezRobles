<?php

    // Base de datos (debería ser reemplazado por el $_ENV, pero no me funciona Composer)

    define('DB_HOST', 'localhost');     // define('DB_HOST', $_ENV['DB_HOST']);
    define('DB_NAME', 'tienda');        // define('DB_NAME', $_ENV['DB_NAME']);
    define('DB_USER', 'root');          // define('DB_USER', $_ENV['DB_USER']);
    define('DB_PASSWORD', '');          // define('DB_PASSWORD', $_ENV['DB_PASSWORD']);

    // Controlador y acción por defecto

    define('CONTROLLER_DEFAULT', 'Producto');
    define('ACTION_DEFAULT', 'recomendados');

    // Rutas

    define('BASE_URL', 'http://localhost/DWES/Proyecto%20Final%20DWES/');

    // Paginación

    define('ITEMS_PER_PAGE', 10);   // Usuarios y Categorías
    define('PRODUCTS_PER_PAGE', 6); // Conviene que sea un múltiplo de 3 para obtener la vista más óptima

?>