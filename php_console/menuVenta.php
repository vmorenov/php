<?php
include("conexion.php");
class menuVenta
{
    public function ingresaventa($rut, $mes,$valor){

        $con=conectar();
        if (!$con) {
            echo "Error: No se pudo conectar a MySQL. Error " . mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
            die;
        }

        $sql = "INSERT INTO v_ventas (rut, mes, venta) VALUES ('$rut','$mes','$valor')";


        if (($result = mysqli_query($con,$sql)) === false) {
            die(mysqli_error($con));
        }else{
            echo  "\n"."Registro correctamente almacenado". "\n";
        }

        mysqli_close($con);
    }

    public function obtieneVendedorMax(){
        $con=conectar();
        if (!$con) {
            echo "Error: No se pudo conectar a MySQL. Error " . mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
            die;
        }
        $resultado = $con->query("Select * from (SELECT 	sum(venta) as total,    rut FROM `v_ventas` group by rut order by sum(venta) desc) a limit 1");

        for ($num_fila = $resultado->num_rows - 1; $num_fila >= 0; $num_fila--) {
            $resultado->data_seek($num_fila);
            $fila = $resultado->fetch_assoc();
            echo " El vendedor con total de ventas más altas es: " . $fila['rut'] ." Con un total de: ".$fila['total']. "\n";

        }


        mysqli_close($con);
    }
    public function obtienePromMD(){
        $con=conectar();
        if (!$con) {
            echo "Error: No se pudo conectar a MySQL. Error " . mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
            die;
        }
        $resultado = $con->query("select SUM(VENTA)/COUNT(1) AS PROMEDIO FROM `v_ventas` where mes in ('MAYO','DICIEMBRE')");

        for ($num_fila = $resultado->num_rows - 1; $num_fila >= 0; $num_fila--) {
            $resultado->data_seek($num_fila);
            $fila = $resultado->fetch_assoc();
            echo " El promedio de ventas en los meses de Mayo y Diciembre es: " . $fila['PROMEDIO'] . "\n";

        }
        mysqli_close($con);
    }
    public function obtieneVenB(){
        $con=conectar();
        if (!$con) {
            echo "Error: No se pudo conectar a MySQL. Error " . mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
            die;
        }
        $resultado = $con->query("Select * from (SELECT 	sum(venta) as total,    rut FROM `v_ventas` group by rut order by sum(venta) asc) a limit 2");
        $num_vendedor = 0;
        for ($num_fila = $resultado->num_rows - 1; $num_fila >= 0; $num_fila--) {
            $num_vendedor++;
            $resultado->data_seek($num_fila);
            $fila = $resultado->fetch_assoc();
            echo " El vendedor N°".$num_vendedor." con ventas más baja es : " . $fila['rut'] . " con un promedio de: ".$fila['total']. "\n";

        }
        mysqli_close($con);
    }
    public function obtieneBaja(){
        $con=conectar();
        if (!$con) {
            echo "Error: No se pudo conectar a MySQL. Error " . mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
            die;
        }
        $resultado = $con->query("select * from (Select mes, sum(venta)  as total from `v_ventas` group by mes order by sum(venta) asc) a limit 1");

        for ($num_fila = $resultado->num_rows - 1; $num_fila >= 0; $num_fila--) {

            $resultado->data_seek($num_fila);
            $fila = $resultado->fetch_assoc();
            echo " El mes con ventas más bajas es: " . $fila['mes'] . " con un promedio de ventas de: ".$fila['total']. "\n";

        }
        mysqli_close($con);
    }
    public function obtieneAlta(){
        $con=conectar();
        if (!$con) {
            echo "Error: No se pudo conectar a MySQL. Error " . mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
            die;
        }
        $resultado = $con->query("select * from (Select mes, sum(venta) as total from `v_ventas` group by mes order by sum(venta) desc) a limit 1");

        for ($num_fila = $resultado->num_rows - 1; $num_fila >= 0; $num_fila--) {

            $resultado->data_seek($num_fila);
            $fila = $resultado->fetch_assoc();
            echo " El mes con ventas más altas es: " . $fila['mes'] . " con un promedio de ventas de: ".$fila['total']. "\n";

        }
        mysqli_close($con);
    }

}