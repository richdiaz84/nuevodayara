<?php
// Funciones de seguridad básicas

function hash_password($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function verify_password($password, $hash) {
    return password_verify($password, $hash);
}

// Prevenir CSRF, XSS, etc. se irán agregando más adelante.