<?php
// Funciones de ayuda reutilizables (helpers)

function redirect($url) {
    header('Location: ' . $url);
    exit();
}

function sanitize_input($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Puedes agregar más funciones útiles aquí.