<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("phpqrcode/qrlib.php");
$address = trim($_GET['address']);
QRcode::png($address);

