<?php
    session_start();
    include('../../includes/conex_emp.php');

    $tiempoSesion = 15 * 60;

    if (!isset($_SESSION['usuario'])) {
        // Redirigir a la página de inicio de sesión si no hay una sesión activa
        header("Location: inicio_sesion.php");
        exit();
    } else {
        if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso']) > $tiempoSesion) {
            // Si ha pasado el tiempo de inactividad, destruir la sesión y redirigir
            session_unset();
            session_destroy();
            header("Location: inicio_sesion.php");
            exit();
        }
    }

    $_SESSION['ultimo_acceso'] = time();
        
    $conex = connection();
    
    $sqlObra = "SELECT * FROM obras WHERE ob_estado = 1";
    $sqlMaquinaria = "SELECT * FROM maquinaria WHERE ma_estado = 1";

    try {
        //ejecución sql sobre tabla obra
        $stmtObra = $conex->query($sqlObra);
        $obras = $stmtObra->fetchAll(PDO::FETCH_ASSOC);

        //ejecución sql sobre tabla maquinaria        
        $stmtMaquinaria = $conex->query($sqlMaquinaria);
        $maquinarias = $stmtMaquinaria->fetchAll((PDO::FETCH_ASSOC));
    } catch (PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/humberto_logo_recortado.png" mce_href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../../includes/css/alta_trabajo.css">
    <title>INFOXES</title>
</head>
<body onload="cargarDia()">
    <img src="../../img/logo_principal.png" alt="Logo de la empresa">
    <h1 id="elementoFecha"></h1>

    <?php
        $trabajador = $_SESSION['usuario']['tr_id'];

        // Preparar y ejecutar la consulta
        $sqlSession = "SELECT tr_nombre FROM trabajadores WHERE tr_id = :trabajador";
        $stmt = $conex->prepare($sqlSession);
        $stmt->bindParam(':trabajador', $trabajador, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Fetch the result as an associative array
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Verifica si se obtuvo algún resultado
            if ($resultado) {
                echo "<h2 class='nombreUsuario'>" . htmlspecialchars($resultado['tr_nombre']) . "</h2>";
            } else {
            header("Location: inicio_sesion.php");
            exit();
            }
        } else {
            header("Location: inicio_sesion.php");
            exit();
        }
    ?>

    <!-- Formulario para el registro de datos -->
    <form action="../../includes/procesar_registro.php" method="POST">
        <select name="obra" id="obras" required>
            <option value="" disabled selected>Selecciona una obra</option>
            <?php
            foreach($obras as $obra) {
                echo "<option value='" . htmlspecialchars($obra['ob_id']) . "'>" . htmlspecialchars($obra['ob_denominacion']) . "</option>";
            }
            ?>
        </select>

        <input type="time" name="horaEntrada" class="horaEntrada" id="horaEntrada" required>
        <input type="time" name="horaSalida" class="horaSalida" id="horaSalida" required>

        <select name="maquinaria" id="maquinas" required>
            <option value="" disabled selected>Selecciona una maquina</option>
            <?php
            foreach($maquinarias as $maquinaria) {
                echo "<option value='" . htmlspecialchars($maquinaria['ma_id']) . "'>" . htmlspecialchars($maquinaria['ma_denominacion']) . "</option>";
            }
            ?>
        </select>

        <input type="hidden" name="observaciones" id="hiddenObservaciones"> <!-- Campo oculto -->

        <button type="button" class="observaciones" id="botonObservaciones">OBSERVACIONES</button>
        <button type="submit" class="enviar">ENVIAR</button>
        
        <!-- Estructura del modal -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <span id="cerrarModal" class="close">&times;</span>
                <h2>OBSERVACIONES</h2>
                <textarea id="textareaObservaciones" name="observaciones" rows="5" placeholder="Escribe tus observaciones aquí..."></textarea>
                <button type="button" id="saveModal" class="saveModal">Guardar</button>
            </div>
        </div>
    </form>

    <!--Estructura modal registro completado/fallido-->
    <div id="modalResultado" class="modal">
        <div class="modal-content">
            <h2 id="mensajeResultado"></h2>
            <p id="descripcionResultado"></p>
            <button id="closeResultado">Cerrar</button>
        </div>
    </div>

    <button type="button" class="cerrarSesion" onclick="window.location.href='../../includes/logout_trabajador.php'">CERRAR SESIÓN</button>
    
    <script src="../../includes/js/alta_trabajo.js"></script>
</body>
</html>