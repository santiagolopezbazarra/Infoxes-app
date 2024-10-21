<?php
  include('../includes/conexion.php');
  $conex = connection();

  session_start();
  if (!isset($_SESSION['UserOREmail'])) {
      // El usuario no está autenticado, redirigir a la página de inicio de sesión
      header("Location: ../Iniciar_Sesion/inicio_sesion.php");
      exit();
  }

  $id = $_SESSION['UserOREmail'];

  $sql = "SELECT * FROM cuentas_registro WHERE ID_USUARIO='$id'";
  $query = mysqli_query($conex,$sql);
  $row = mysqli_fetch_array($query);

?> 
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>INFOXES Inicio</title>
    <link rel="icon" href="image/x-icon" href="/wamp64/www/Infoxes/Pagina%20Usuario/infoxes.png">
    <link rel="stylesheet" href="../CSS/Pagina_user/miperfil_user.css" type="text/css">
  </head>
  <body>
  <nav class="menu">
      <section class="menu__container">
        <a href="./pagina_principal.php">
          <img src="../Images/infoxes(white).png" class="menu__infoxes">
        </a>

        <ul class="menu__links">
          
          <li class="menu__item">
            <a href="./alta_empresas/alta_empresas.php" class="menu__link">Alta empresas</a>
          </li>

  
          <li class="menu__item">
            <a href="./registrar_trabajo/registrar_trabajo.php" class="menu__link">Registrar trabajo</a>
          </li>
  
          <li class="menu__item menu__item--show">
            <a href="#" class="menu__link">Resumen<img src="../Images/arrow.svg" class="menu__arrow"></a>
            
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
            <a href="#" class="menu__link"><img src="../Images/user.svg" class="menu__user"> <img src="../Images/arrow.svg" class="menu__arrow"></a>
            
            <ul class="menu__nesting">
              <li class="menu__inside">
                <a href="./miperfil_user.php?id_usuario" class="menu__link menu__link--inside">Mi perfil</a>
              </li>
              <li class="menu_inside">
                <a href="../Iniciar_Sesion/inicio_sesion.php" class="menu__link menu__link--inside"><img src="../Images/logout.svg" class="menu__logout">‎ Cerrar sesión</a>
              </li>
            </ul>
          </li>
          
        </ul>
        

        <div class="menu__hamburguer">
          <img src="../Images/menu.svg" class="menu__img">
        </div>
      </section>

    </nav>

    <script src="../includes/JS/app.js"></script>

    <div class="container__perfil">
      <h1 class="mi__perfil">Mi perfil</h1>
      <table>
        <thead>
          <tr class="nombre__perfil">
            <th class="informacion">Nombre</th>
            <th class="datos"><?= $row['NOMBRE']?><?= $row['APELLIDOS']?></th>
          </tr>
          <tr class="email__perfil">
            <th class="informacion">Email</th>
            <th class="datos"><?= $row['EMAIL']?></th>
          </tr>
          <tr class="usuario__perfil">
            <th class="informacion">Usuario</th>
            <th class="datos"><?= $row['USUARIO']?></th>
          </tr>
          <tr class="contrasena__perfil">
            <th class="informacion">Contraseña</th>
            <td class="datos">
              <input type="password" value="<?= $row['CONTRASENA'] ?>" disabled>
            </td>
          </tr>
        </thead>
      </table>
      <button class="logout__perfil">
        <a href="../Iniciar_Sesion/inicio_sesion.php">Cerrar sesión</a>
      </button>
    </div>
  </body>
</html>