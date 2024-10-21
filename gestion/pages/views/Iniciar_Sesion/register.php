<?php
    include('../../../includes/conex_gestion.php');

    $conex = connection();

    // CHECK DE LA CONEXIÓN
    if (!$conex) {
        die("Connection failed: " . $conex->errorInfo());
    }

    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['user']) && isset($_POST['contrasena']) && isset($_POST['confirmacion'])) {
        if (strlen($_POST['nombre']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['user']) >= 1 && strlen($_POST['contrasena']) >= 1 && strlen($_POST['confirmacion']) >= 1) {
            $nombre = trim($_POST['nombre']);
            $apellidos = trim($_POST['apellido']);
            $correo = trim($_POST['email']);
            $usuario = trim($_POST['user']);
            $password = trim($_POST['contrasena']);
            $confirmacion = trim($_POST['confirmacion']);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Verificar formato del correo
            if (!strpos($correo, '@')) {
                echo "<h3>El correo tiene un formato erroneo</h3>";
            } else {
                // Verificar que las contraseñas coincidan
                if ($password != $confirmacion) {
                    echo "<h3>Las contraseñas no coinciden</h3>";
                } else {
                    // Verificar si el correo o usuario ya existen
                    $stmt = $conex->prepare("SELECT * FROM cuentas_registro WHERE cr_mail = :correo OR cr_usuario = :usuario");
                    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        header("Location: http://localhost/Infoxes/Iniciar_Sesion/inicio_sesion.php");
                    } else {
                        // Insertar nuevo registro
                        $stmt = $conex->prepare("INSERT INTO cuentas_registro (cr_nombre, cr_apellidos, cr_mail, cr_usuario, cr_password) VALUES (:nombre, :apellidos, :correo, :usuario, :hashed_password)");
                        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                        $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
                        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
                        $stmt->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);

                        if ($stmt->execute()) {
                            echo "<h3>Registro exitoso</h3>";
                        } else {
                            echo "<h3>Error al registrar</h3>";
                        }
                    }
                }
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
        <link rel="stylesheet" href="../../../includes/css/Iniciar_Sesion/style_register.css" type="text/css">
        <title>Infoxes</title>
    </head>
    <body>
        <div class="container">
            <h2>Crear una cuenta</h2>
            <h3>Introduce tus datos</h3>
            <form action="Register.php" class="formulario" method="post">
                    <div class="name_form">
                        <input spellcheck="false" class="control" type="text" placeholder="Nombre" name="nombre">
                    </div>
                    <div class="apellido_form">
                        <input spellcheck="false" class="control" type="text" placeholder="Apellidos" name="apellido">
                    </div>
                    <input spellcheck="false" class="control" type="text" placeholder="Correo Electronico" name="email">
                    <input spellcheck="false" class="control" type="text" placeholder="Nombre de usuario" name="user">
                    <input spellcheck="false" class="control" id="password" type="password" placeholder="Contraseña" name="contrasena">
                    <input spellcheck="false" class="control" id="password" type="password" placeholder="Confirmación" name="confirmacion">
                    <button class="control" type="submit">SIGUIENTE</button>
            </form><br>
        </div>
    </body>
</html>