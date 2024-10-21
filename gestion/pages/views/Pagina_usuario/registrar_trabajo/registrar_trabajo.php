<?php
session_start();

include('../../includes/conexion.php');

$conex = connection();
// CHECK DE LA CONEXIÓN
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

echo "Datos del formulario: <br>";
var_dump($_POST); // Imprimir los datos del formulario para depuración

// Procesamiento del formulario
if(isset($_POST['empresa']) && isset($_POST['dia_trabajo']) && isset($_POST['hora_entrada']) && isset($_POST['hora_salida']) && isset($_POST['descripcion_tarea'])) {
    $id_empleado = $_SESSION['UserOREmail'];
    $empresa = $_POST['empresa'];
    $dia_trabajo = $_POST['dia_trabajo'];
    $hora_entrada = $_POST['hora_entrada'];
    $hora_salida = $_POST['hora_salida'];
    $descripcion_tarea = $_POST['descripcion_tarea'];

    // Consulta para insertar el registro de trabajo
    $sql_insert = "INSERT INTO registro_trabajo (ID_EM, EM_RSOCIAL, DIA_TRABAJO, HORA_ENTRADA, HORA_SALIDA, DESCRIPCION) 
                   VALUES ('$id_empleado', '$empresa', '$dia_trabajo', '$hora_entrada', '$hora_salida', '$descripcion_tarea')";

    echo "Consulta SQL: " . $sql_insert . "<br>";

    if(mysqli_query($conex, $sql_insert)) {
        echo "Registro de trabajo exitoso";
    } else {
        echo "Error al registrar el trabajo: " . mysqli_error($conex);
    }
}

// Consulta para obtener la lista de empresas
$sql = "SELECT * FROM empresas";
$query = mysqli_query($conex, $sql);
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>INFOXES Inicio</title>
    <link rel="icon" href="image/x-icon" href="../Images/infoxes(white).png">
    <link rel="stylesheet" href="../../CSS/Pagina_user/registrar_trabajo/registrar_trabajo.css" type="text/css">
  </head>
  <body>
    <nav class="menu">
      <section class="menu__container">
        <a href="../pagina_principal.php">
          <img src="../../Images/infoxes(white).png" class="menu__infoxes">
        </a>

        <ul class="menu__links">
          
          <li class="menu__item">
            <a href="../alta_empresas/alta_empresas.php" class="menu__link">Alta empresas</a>
          </li>

  
          <li class="menu__item">
            <a href="#" class="menu__link">Registrar trabajo</a>
          </li>
  
          <li class="menu__item menu__item--show">
            <a href="#" class="menu__link">Resumen<img src="../../Images/arrow.svg" class="menu__arrow"></a>
            
            <ul class="menu__nesting">
              <li class="menu__inside">
                <a href="#" class="menu__link menu__link--inside">Mensual</a>
              </li>
              <li class="menu_inside">
                <a href="#" class="menu__link menu__link--inside">Anual</a>
              </li>
            </ul>
          </li>

          <li class="menu__item menu__item--show">
            <a href="#" class="menu__link"><img src="../../Images/user.svg" class="menu__user"> <img src="../../Images/arrow.svg" class="menu__arrow"></a>
            
            <ul class="menu__nesting">
              <li class="menu__inside">
                <a href="../miperfil_user.php?id_usuario" class="menu__link menu__link--inside">Mi perfil</a>
              </li>
              <li class="menu_inside">
                <a href="../../Iniciar_Sesion/inicio_sesion.php" class="menu__link menu__link--inside"><img src="../../Images/logout.svg" class="menu__logout">‎ Cerrar sesión</a>
              </li>
            </ul>
          </li>
          
        </ul>
        

        <div class="menu__hamburguer">
          <img src="../../Images/menu.svg" class="menu__img">
        </div>
      </section>

    </nav>

    <script src="../../includes/JS/app.js"></script>

    <div class="table">
      <h2>REGISTRAR TRABAJO</h2>
      <br>
      <form method="post">
        <input list="Empresas" placeholder="Empresas" name="empresa" required>
        <datalist id="Empresas">
          <?php
          while($row = mysqli_fetch_assoc($query)) {
            echo "<option value='".$row['EM_RSOCIAL']."'>";
          }
          ?>
        </datalist>
        <input type="date" name="dia_trabajo" id="dia_trabajo" required>
        <input type="time" id="hora_entrada" name="Hora entrada" required>
        <input type="time" id="hora_salida" name="Hora salida" required>
        <br>
        <textarea id="descripcion_tarea" name="descripcion_tarea" placeholder="Introduzca la descripción de su tarea"></textarea>
        <br>
        <input type="submit" value="Registrar">
      </form>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>EMPLEADO</th>
            <th>EMPRESA</th>
            <th>HORA ENTRADA</th>
            <th>HORA SALIDA</th>
            <th>MAS INFO.</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_array($query)): ?>
          <tr>
            <th> <?= $row['ID_TAREA'] ?> </th>
            <th> <?= $row['USUARIO'] ?> </th>
            <th> <?= $row['EM_RSOCIAL'] ?> </th>
            <th> <?= $row['HORA_ENTRADA'] ?> </th>
            <th> <?= $row['HORA_SALIDA'] ?> </th>
            <th> <?= $row['DESCRIPCION'] ?> </th>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </body>
</html>

<?php mysqli_close($conex); ?>