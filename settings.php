<?php


$server_url = "http://localhost/";  // ENTER WEBSITE URL ALONG WITH A TRAILING SLASH

$db_host = "localhost";
$db_user = "";
$db_pass = "";
$db_name = "";

$rpc_host = "127.0.0.1";
$rpc_port = "21391";
$rpc_user = "";
$rpc_pass = "";

$fullname = "NIOSHARE"; //Website Title (Do Not include 'wallet')
$short = "NIO"; //Coin Short (BTC)
$blockchain_tx_url = "https://explorer.nioshares.net/tx/"; //Blockchain Url
$blockchain_wallet_url= "https://explorer.nioshares.net/address/"; //Blockchain Wallet Url
$support = ""; //Your support eMail
$hide_ids = array(1); //Hide account from admin dashboard
$donation_address = "NhbboX34dWrdygHsLhHoVqNPkG693PNioC"; //Donation Address

$reserve = "0.0002"; //This fee acts as a reserve. The users balance will display as the balance in the daemon minus the reserve. We don't reccomend setting this more than the Fee the daemon charges.
//Recaptcha
$feewithdraw="0.0002";
$public = "";
$secret = "";


?>
