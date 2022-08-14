<?php
function conectar(){
    $user="root";
    $pass="";
    $server="localhost";
    $db="ventas";

    $con = new mysqli($server, $user, $pass, $db);
    $con->set_charset("utf8");

    return $con;
}

?>