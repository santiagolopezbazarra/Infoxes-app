<?php
  session_start();

  include('../../includes/conex_gestion.php');

  // Asumiendo que la función connection() en conex_gestion.php devuelve una instancia de PDO
  $conex = connection();

  // Verificar la conexión
  if (!$conex) {
      echo "Connection failed";
      exit();
  }

  $sql = "SELECT * FROM empresas";
  $query = $conex->query($sql);
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>INFOXES Inicio</title>
    <link rel="icon" href="image/x-icon" href="../Images/infoxes(white).png">
    <link rel="stylesheet" href="../CSS/Pagina_user/pagina_principal.css" type="text/css">
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

    <!--<div class="main-content">
      <section class="welcome-section">
        <h1>Bienvenido a Infoxes</h1>
        <p>Plataforma para la gestión del trabajo en la empresa</p>
      </section>

      <section class="work-management">
        <h2>Gestión del Trabajo</h2>
        <p>Esta sección te permite organizar y gestionar las tareas y proyectos de la empresa de manera eficiente.</p>
        <img src="../Images/work_image1.jpg" alt="Imagen de trabajo 1">
        <img src="../Images/work_image2.jpg" alt="Imagen de trabajo 2">
      </section>
    </div>-->

  </body>
</html>
