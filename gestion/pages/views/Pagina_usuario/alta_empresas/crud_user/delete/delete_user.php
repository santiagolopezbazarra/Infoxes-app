<?php
    include('..\..\..\..\includes\conexion.php');

    $conex = connection();
    $id= $_GET['id'];

    $sql = "DELETE FROM empresas WHERE EM_ID='$id'";
    $query = mysqli_query($conex,$sql);
    if($query){
        Header("Location: ../../alta_empresas.php");
    }

    mysqli_close($conex);
?>