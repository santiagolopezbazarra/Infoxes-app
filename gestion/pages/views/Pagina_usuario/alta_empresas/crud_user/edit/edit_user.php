<?php
  include('..\..\..\..\includes\conexion.php');
  $conex = connection();

  $id = trim($_POST['id']);
  $cif = trim($_POST['cif']);
  $nombre = trim($_POST['rsocial']);
  $sql = "UPDATE empresas SET EM_CIF='$cif', EM_RSOCIAL='$nombre' WHERE EM_ID='$id'";
  $query = mysqli_query($conex,$sql);
  if($query){
    Header("Location: ../../alta_empresas.php");
  }
  mysqli_close($conex);
?>