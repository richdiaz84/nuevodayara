<?php
// Punto de entrada principal del sistema

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/autoload.php';
require_once __DIR__ . '/../core/helpers.php';
require_once __DIR__ . '/../core/security.php';

// Router simple: determina qué módulo cargar según la URL
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'admin':
        require_once __DIR__ . '/../modules/admin/index.php';
        break;
    case 'productos':
        require_once __DIR__ . '/../modules/products/index.php';
        break;
    // Agrega más módulos aquí...
    default:
        require_once __DIR__ . '/../templates/header.php';
        echo "<h1>Bienvenido a Nueva Dayara</h1>";
        require_once __DIR__ . '/../templates/footer.php';
        break;
}