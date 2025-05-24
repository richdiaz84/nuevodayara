<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/security.php';
require_once __DIR__ . '/../core/helpers.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $db = db_connect();
    $stmt = $db->prepare("SELECT u.id, u.nombre, u.email, u.password, u.rol_id, r.nombre as rol
                          FROM users u
                          INNER JOIN roles r ON u.rol_id = r.id
                          WHERE u.email = ? AND u.activo = 1 LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && verify_password($password, $user['password'])) {
        // Guardar datos en la sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_rol'] = $user['rol'];
        // Redirigir al panel de admin si es admin
        if ($user['rol'] === 'admin') {
            redirect('/index.php?page=admin');
        } else {
            redirect('/index.php');
        }
    } else {
        $error = 'Correo o contraseña incorrectos.';
    }
}
?>

<?php require_once __DIR__ . '/../templates/header.php'; ?>
<h2>Iniciar Sesión</h2>
<?php if ($error): ?>
    <div style="color: red;"><?= $error ?></div>
<?php endif; ?>
<form method="post" action="">
    <label for="email">Correo electrónico:</label><br>
    <input type="email" name="email" id="email" required><br><br>
    <label for="password">Contraseña:</label><br>
    <input type="password" name="password" id="password" required><br><br>
    <button type="submit">Ingresar</button>
</form>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>