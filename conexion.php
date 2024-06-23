<?php
    $servidor="localhost";
    $usuario="root";
    $clave= "";
    $bd="citaweb";

    $conexion=mysqli_connect($servidor, $usuario, $clave) or die ("Server was not found.");
    mysqli_select_db($conexion, $bd) or die ("DataBase was not found");
    mysqli_set_charset($conexion, "utf8");
    //echo "successful connection";
?>