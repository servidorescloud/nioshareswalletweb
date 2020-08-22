<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/settings.php");


$ref = $_SERVER["HTTP_REFERER"]; 

$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$server = $_SERVER['SERVER_NAME']; 

$urlpage = $_SERVER['PHP_SELF'];

$sitetop = "https://$server";

$sitetop = str_replace("www.","",$sitetop);


$titulos = explode('//', $sitetop);

$titulosite = $titulos[1];
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header("location: $sitetop/404.php");
    exit;
}



if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
