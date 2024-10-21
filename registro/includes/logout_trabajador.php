<?php
    session_start(); // Inicia la sesión para poder destruirla
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión actual

    // Redirigir al usuario a la página de inicio de sesión o cualquier otra página
    header("Location: ../pages/views/inicio_sesion.php");
    exit();
?>