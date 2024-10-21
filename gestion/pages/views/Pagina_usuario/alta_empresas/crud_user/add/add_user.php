<?php

  include('../../../../includes/conexion.php');

  $conex = connection();

  // CHECK DE LA CONEXIÓN
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

//if ($result = $mysqli->query("SELECT * FROM empresas LIMIT 10")) {
//    printf("Select returned %d rows.\n", $result->num_rows);
//    $result->close();
//}

//  if($conex){
//    echo"Base de datos conectada";
//  }else{
//    echo "No se ha pudo establecer conexion con la base de datos";
//  }

  //Recibir info del formulario html metodo post

?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>INFOXES Inicio</title>
    <link rel="icon" href="image/x-icon" href="/wamp64/www/Infoxes/Pagina%20Usuario/infoxes.png">
    <link rel="stylesheet" href="../../../../CSS/Pagina_user/alta_empresas/edit/add_user.css" type="text/css">
  </head>
  <body>
  <nav class="menu">
      <section class="menu__container">
        <a href="../../../pagina_principal.php">
          <img src="../../../../Images/infoxes(white).png" class="menu__infoxes">
        </a>

        <ul class="menu__links">
          
          <li class="menu__item">
            <a href="../../../alta_empresas/alta_empresas.php" class="menu__link">Alta empresas</a>
          </li>

  
          <li class="menu__item">
            <a href="../../../registrar_trabajo/registrar_trabajo.php" class="menu__link">Registrar trabajo</a>
          </li>
  
          <li class="menu__item menu__item--show">
            <a href="#" class="menu__link">Resumen<img src="../../../../Images/arrow.svg" class="menu__arrow"></a>
            
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
            <a href="#" class="menu__link"><img src="../../../../Images/user.svg" class="menu__user"> <img src="../../../../Images/arrow.svg" class="menu__arrow"></a>
            
            <ul class="menu__nesting">
              <li class="menu__inside">
                <a href="../../../miperfil_user.php?id_usuario" class="menu__link menu__link--inside">Mi perfil</a>
              </li>
              <li class="menu_inside">
                <a href="../../../../Iniciar_Sesion/inicio_sesion.php" class="menu__link menu__link--inside"><img src="../../../../Images/logout.svg" class="menu__logout">‎ Cerrar sesión</a>
              </li>
            </ul>
          </li>
          
        </ul>
        

        <div class="menu__hamburguer">
          <img src="../../../../Images/menu.svg" class="menu__img">
        </div>
      </section>

    </nav>

    <script src="../../../../includes/JS/app.js"></script>

    <div class="container-form">
      <h1>INGRESE SUS DATOS</h1>
      <form  action="add_user.php" method="post">
        <label for="CIF">CIF</label>
        <input type="text" name="txtCif" value="">
        <br/>
        <label for="Empresa">R.SOCIAL</label>
        <input type="text" name="txtEmpresa" value="">
        <br>
        <div class="btn-container">
          <input type="submit" name="Enviar">
        </div>
        <?php
        if (isset($_POST['txtCif']) && isset($_POST['txtEmpresa'])) {
          if (strlen($_POST['txtCif']) >= 1 && strlen($_POST['txtEmpresa']) >= 1) {
              $cif=trim($_POST['txtCif']);
              $nombre=trim($_POST['txtEmpresa']);
              $sql = "SELECT * FROM empresas WHERE EM_CIF = '$cif'";
              $query = mysqli_query($conex,$sql);
              if ($query->num_rows > 0) {
                ?>
                <h3>El CIF ya se encuentra registrado</h3>
                <?php
              }else{
                $insert = "INSERT INTO empresas(EM_CIF,EM_RSOCIAL) VALUES ('$cif','$nombre')";
                $resultado = mysqli_query($conex,$insert);
                if($resultado){
                  header("Location: ../../alta_empresas.php");
                }else {
                  ?>
                  <h3>¡No te has registrado con exito!</h3>
                  <?php
                }
              }
        }else{
          ?>
          <h3>¡Por favor complete los campos!</h3>
          <?php
        }
      } 
    ?>
      </form>
    </div>
  </body>
</html>

<?php mysqli_close($conex); ?>