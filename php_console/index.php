<?php
//para ejecutar por consola es php -f archivo_php.php

require ("menuVenta.php");

repeticion:
print ("Opción 1: Ingresar un nuevo vendedor y/o Venta" . "\n");
print ("Opción 2: Consultar estadisticas de venta" . "\n");
print ("Opción 3: Salir" . "\n");
$opcionselecionada = readline();

switch ($opcionselecionada)
{
    case 1:
        print ("Favor ingresa el rut del vendedor + mes que realizo la venta + valor de la venta, esto separados por una coma" . "\n");
        $opcionselecionada = readline();

        $venta = explode(",", $opcionselecionada);
        echo $venta[0]; // rut
        echo $venta[1]; // mes
        echo $venta[2]; // valor venta
        $registraventa = new menuVenta();
        $registraventa->ingresaventa(trim($venta[0]) , strtoupper(trim($venta[1])) , trim($venta[2]));
        goto repeticion;
    case 2:
        goto Menu2;
    case 3:
        goto salida;
    default:
        echo "Menu Invalido, favor ingresar un menu correcto" . "\n";
        goto repeticion;
}

Menu2:
print ("Opción 1: RUT del vendedor con las ventas mensuales mas altas" . "\n");
print ("Opción 2: Promedio de las ventas totales del mes de mayo y diciembre" . "\n");
print ("Opción 3: RUT de los dos vendedores con ventas más bajas" . "\n");
print ("Opción 4: Identificar el mes con las ventas totales mas bajas del año" . "\n");
print ("Opción 5: Identificar el mes con las ventas totales mas altas del año" . "\n");
print ("Opción 6: Salir" . "\n");
$opcionselecionada = readline();

switch ($opcionselecionada)
{
    case 1:
        echo ($menu = new menuVenta())->obtieneVendedorMax();
        goto repeticion;

    case 2:
        echo ($menu = new menuVenta())->obtienePromMD();
        goto repeticion;

    case 3:
        echo ($menu = new menuVenta())->obtieneVenB();
        goto repeticion;

    case 4:
        echo ($menu = new menuVenta())->obtieneBaja();
        goto repeticion;

    case 5:
        echo ($menu = new menuVenta())->obtieneAlta();
        goto repeticion;

    default:
        echo "Menu Invalido, favor ingresar un menu correcto" . "\n";
        goto Menu2;
}

salida:
?>
