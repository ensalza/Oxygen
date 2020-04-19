<?php 

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);

require("class.Oxygen.php");

/*
$o1 = new stdClass();
$o1->almacen ="frutas";
$o1->frutas[]="pera";
$o1->frutas[]="manzana";
$o1->recetas = new stdClass();
$o1->recetas->postres = new stdClass();
$o1->recetas->postres->tarta_de_manzana = new stdClass();

$o1->recetas->postres->tarta_de_manzana->nombre = "Tarta de manzana";
$o1->recetas->postres->tarta_de_manzana->fruta = "manzana";
$o1->recetas->postres->tarta_de_manzana->ingredientes[] = "harina";
$o1->recetas->postres->tarta_de_manzana->ingredientes[] = "levadura";
$o1->recetas->postres->tarta_de_manzana->ingredientes[] = "azucar";
$o1->recetas->platos = new stdClass();


$o2 = new stdClass();
$o2->frutas[]="platano";
$o2->frutas[]="cereza";
$o2->recetas = new stdClass();
$o2->recetas->postres = new stdClass();
$o2->recetas->postres->tarta_de_cereza = new stdClass();

$o2->recetas->postres->tarta_de_cereza->nombre = "Tarta de cereza";
$o2->recetas->postres->tarta_de_cereza->fruta = "cereza";
$o2->recetas->postres->tarta_de_cereza->ingredientes[] = "harina";
$o2->recetas->postres->tarta_de_cereza->ingredientes[] = "levadura";
$o2->recetas->postres->tarta_de_cereza->ingredientes[] = "azucar";


$o2->recetas->postres->tarta_de_manzana->ingredientes[] = "gelatina";

$ret = (new Oxygen($o1))->addO($o2)->getO();

var_dump($ret);

*/

$o = new stdClass();

$o->aaaaaaaa = 1;
$o->ccccc = 3;
$o->dddd = array("v1"=>1,"v2"=>2);

//$json = json_encode($o);

$o2 = Oxygen($o);

echo $o2->getJSON();



?>