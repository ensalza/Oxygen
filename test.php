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

$o = Oxygen();


$o->aaaaaaaa = 2;

$o->bbbbbbbb = 3;
//$o->cccccccc = array("v1"=>1,"v2"=>2);
$o->dddddddd->d1 ="1";
$o->dddddddd->d2 ="2";
$o->dddddddd->d3->a ="3";
$o->dddddddd->d3->b->x->w ="4";
$o->eeeeeeee = array(1,2,3);



$o->addXML("<xml>
 
 <bbbbbbbb>3</bbbbbbbb>
 <wwwwwwww>4</wwwwwwww>
 <cccccccc>
  <v1>1</v1>
  <v2>2</v2>
  <v3>3</v3>
 </cccccccc>
 <dddddddd>
  <d1>1</d1>
  <d2>2</d2>
  <d3>
   <a>3</a>
   <b>
    <x>
     <w>8</w>
     <x>5</x>
    </x>
   </b>
  </d3>
 </dddddddd>
 <eeeeeeee>1</eeeeeeee>
 <eeeeeeee>4</eeeeeeee>
</xml>");


/*

<dddddddd>
  <d1>1</d1>
  <d2>2</d2>
  <d3>
   <a>3</a>
   <b>
    <x>
     <w>4</w>
    </x>
   </b>
  </d3>
 </dddddddd>
 <eeeeeeee>
  <x>1</x>
  <x>2</x>
 </eeeeeeee>

*/

//$json = json_encode($o);

//echo $o->getXML("xml");

//echo $o->getJSON(true,false);

 $o->__CDATA__html ="<p>3</p>";

$o->writeXML("xml");
//$o->writeJSON(true,false);



?>