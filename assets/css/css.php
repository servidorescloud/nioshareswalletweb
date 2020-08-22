<?php

if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<?php
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
    header("location: $sitetop");
    exit;
}

header("Content-type: text/css");

echo'
body {
	background-color: #000000;
	
}

.langselect {
	padding-right: 8px;
}

.navbar-default {
	background-color: #0041FD;
	border-color: #0041FD;
}
.navbar-default .navbar-brand {
	color: #ffffff;
}
.navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus {
	color: #ffbbbc;
}
.navbar-default .navbar-text {
	color: #ffffff;
}
.navbar-default .navbar-nav > li > a {
	color: #ffffff;
}
.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
	color: #ffbbbc;
}
.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
	color: #ffbbbc;
	background-color: #b9392b;
}
.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {
	color: #ffbbbc;
	background-color: #b9392b;
}
.navbar-default .navbar-toggle {
	border-color: #b9392b;
}
.navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {
	background-color: #b9392b;
}
.navbar-default .navbar-toggle .icon-bar {
	background-color: #ffffff;
}
.navbar-default .navbar-collapse,
.navbar-default .navbar-form {
	border-color: #ffffff;
}
.navbar-default .navbar-link {
	color: #ffffff;
}
.navbar-default .navbar-link:hover {
	color: #ffbbbc;
}

.table {
	background-color: #ffffff;
}

@media (max-width: 767px) {
	.navbar-default .navbar-nav .open .dropdown-menu > li > a {
		color: #ffffff;
	}
	.navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
		color: #ffbbbc;
	}
	.navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
		color: #ffbbbc;
		background-color: #b9392b;
	}
	#txlist td:nth-of-type(1), #txlist td:nth-of-type(2), #txlist td:nth-of-type(5), #txlist td:nth-of-type(6) {
		display: none;
	}
}
form { display: block; }

footer p{color: #FFFFFF;}
footer{color: #FFFFFF; text-align: center;}

';


?>