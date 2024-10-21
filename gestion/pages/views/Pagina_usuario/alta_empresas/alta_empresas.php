<?php
  include('../../includes/conexion.php');

  $conex = connection();
  // CHECK DE LA CONEXIÓN
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
  
  $sql = "SELECT * FROM empresas";
  $query = mysqli_query($conex, $sql);
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>INFOXES Inicio</title>
    <link rel="icon" href="image/x-icon" href="../Images/infoxes(white).png">
    <link rel="stylesheet" href="../../CSS/Pagina_user/alta_empresas/alta_empresas.css" type="text/css">
  </head>
  <body>
    <nav class="menu">
      <section class="menu__container">
        <a href="../pagina_principal.php">
          <img src="../../Images/infoxes(white).png" class="menu__infoxes">
        </a>

        <ul class="menu__links">
          
          <li class="menu__item">
            <a href="./alta_empresas.php" class="menu__link">Alta empresas</a>
          </li>

  
          <li class="menu__item">
            <a href="../registrar_trabajo/registrar_trabajo.php" class="menu__link">Registrar trabajo</a>
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
      <h2>EMPRESAS REGISTRADAS</h2>
      <table>
          <thead>
              <tr>
                  <th>ID</th>
                  <th>CIF</th>
                  <th>R.SOCIAL</th>
                  <th></th>
                  <th><a href="./crud_user/add/add_user.php" class="add">Añadir</a></th>
              </tr>
          </thead>
          <tbody>
              <?php while($row = mysqli_fetch_array($query)): ?>
              <tr>
                  <th> <?= $row['EM_ID']?> </th>
                  <th> <?= $row['EM_CIF']?> </th>
                  <th> <?= $row['EM_RSOCIAL']?> </th>
  
                  <th><a href="./crud_user/edit/update.php?id=<?= $row['EM_ID'] ?>" class="edit_blue">Editar</a></th>
                  <th><a href="./crud_user/delete/delete_user.php?id=<?= $row['EM_ID'] ?>" class="delete_red">Eliminar</a></th>
              </tr>
              <?php endwhile; ?>
          </tbody>
      </table>  
    </div>
  </body>
</html>

<?php mysqli_close($conex); ?>