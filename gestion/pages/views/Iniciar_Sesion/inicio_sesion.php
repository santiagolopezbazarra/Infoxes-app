<?php
session_start();

include('../../../includes/conex_gestion.php');

$conex = connection();

// Verificar la conexión
if (!$conex) {
    die("Connection failed: " . $conex->errorInfo());
}

if (isset($_POST['UserOREmail']) && isset($_POST['Contrasena'])) {
    if (strlen($_POST['UserOREmail']) >= 1 && strlen($_POST['Contrasena']) >= 1) {
        $useroremail = trim($_POST['UserOREmail']);
        $password = trim($_POST['Contrasena']);
        
        // Preparar la consulta usando una consulta preparada de PDO
        $stmt = $conex->prepare('SELECT * FROM cuentas_registro WHERE cr_mail = :useroremail OR cr_usuario = :useroremail');
        
        // Enlazar el parámetro de la consulta para evitar inyección SQL
        $stmt->bindParam(':useroremail', $useroremail, PDO::PARAM_STR);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener el resultado
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user_data) {
            // Verificar la contraseña usando password_verify
            if (password_verify($password, $user_data['cr_password'])) {
                $_SESSION['UserOREmail'] = $user_data['cr_id'];
                header("Location: ../Pagina_usuario/pagina_usuario.php");
                exit();
            } else {
                echo "<h3>¡La contraseña es incorrecta!</h3>";
            }
        } else {
            echo "<h3>¡El usuario o correo electrónico no existe!</h3>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../includes/css/Iniciar_Sesion/style_inicio_sesion.css" type="text/css">
    <title>Infoxes</title>
</head>
<body>
    <div class="container">
        <h2>Iniciar sesión</h2>
        <h3>Introduce tus datos</h3>
        <form action="inicio_sesion.php" method="post" class="formulario">
            <input spellcheck="false" class="control" type="text" placeholder="Usuario" name="UserOREmail">
            <div class="contrasena">
                <input spellcheck="false" class="control" id="password" type="password" placeholder="Contraseña" name="Contrasena">
                <button class="toggle" type="button" onclick="togglePassword(this)"></button>
            </div>
            <button class="control" type="submit">
                SIGUIENTE
            </button>
        </form><br>
        <a href="register.php">¿Todavía no tienes cuenta? Registrate aquí</a>
    </div>
    <script type="text/javascript" src="main.js"></script>
</body>
</html>