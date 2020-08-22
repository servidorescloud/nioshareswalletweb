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

<?php
/*
 <td nowrap>Delete</td>
       <td>' . '<a href="?a=home&m=del&i=' . $user['id'] . '" onclick="return confirm(\'Are you sure you really want to delete user ' . $user['username'] . ' (id=' . $user['id'] . ')?\');">Delete</a>' . '</td>
*/

?>
<?php
if (!empty($error))
{
    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
}
if (!empty($msg))
{
    echo "<p style='font-weight: bold; color: green;'>" . $msg['message']; "</p>";
}
?>
<a href="" class="btn btn-default">Go back to wallet</a>
<br /><br />
<p>List of all users:</p>
<table class="table table-bordered table-striped" id="userlist">
<thead>
   <tr>
      <td nowrap>Username</td>
      <td nowrap>Created</td>
      <td nowrap>Is admin?</td>
      <td nowrap>Is locked?</td>
      <td nowrap>IP</td>
      <td nowrap>Info</td>
     
   </tr>
</thead>
<tbody>
   <?php
   foreach($userList as $user) {
      echo '<tr>
               <td>' . $user['username'] . '</td>
               <td>' . $user['date'] . '</td>
               <td>' . ($user['admin'] ? '<strong>Yes</strong> <a href="?a=home&m=deadmin&i=' . $user['id'] . '">De-admin</a>' : 'No <a href="?a=home&m=admin&i=' . $user['id'] . '">Make admin</a>') . '</td>
               <td>' . ($user['locked'] ? '<strong>Yes</strong> <a href="?a=home&m=unlock&i=' . $user['id'] . '">Unlock</a>' : 'No <a href="?a=home&m=lock&i=' . $user['id'] . '">Lock</a>') . '</td>
               <td>' . $user['ip'] . '</td>
               <td>' . '<a href="?a=info&i=' . $user['id'] . '">Info</a>' . '</td>
               
            
            </tr>';
   }
   ?>
   </tbody>
</table>
