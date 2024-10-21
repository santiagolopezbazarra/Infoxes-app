<?php
  include('../../../../includes/conexion.php');
  $conex = connection();

  $id= $_GET['id'];
  $sql = "SELECT * FROM empresas WHERE EM_ID='$id'";
  $query = mysqli_query($conex,$sql);
  $row = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../CSS/Pagina_user/alta_empresas/edit/edit_user.css" type="text/css">
    <title>Editar datos</title>
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
        <h1>EDITAR DATOS</h1>
        <form action="edit_user.php" method="POST">
            <input type="hidden" name="id" value="<?= $row['EM_ID'] ?>">
            <label for="CIF">CIF</label>
            <input type="text" name="cif" value="<?= $row['EM_CIF'] ?>">
            <br/>
            <label for="Empresa">R.SOCIAL</label>
            <input type="text" name="rsocial" value="<?= $row['EM_RSOCIAL'] ?>">
            <br>
            <div class="btn-container">
                <input type="submit" name="Enviar">
            </div>
        </form>
    </div>
</body>
</html>

<?php mysqli_close($conex); ?>