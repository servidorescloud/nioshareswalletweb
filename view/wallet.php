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
if (!empty($error))
{
    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
}
?>

<?php
if (!empty($genauthdisplay)){
echo "
<div class='alert alert-success' role='alert'>
  $genauthdisplay
</div>
";

}

?>

<?php
if (!empty($disuthdisplay)){

echo "
<div class='alert alert-warning' role='alert'>
  $disuthdisplay
</div>
";
}
?>



<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#homewallet"><?php echo $lang['WALLET_HELLO']; ?></a></li>
  <li><a data-toggle="tab" href="#sendcoinwallet"><?php echo str_replace(":","",$lang['WALLET_SEND']); ?></a></li>
  <li><a data-toggle="tab" href="#listwallets"><?php echo str_replace(":","",$lang['WALLET_USERADDRESSES']); ?></a></li>
  <li><a data-toggle="tab" href="#transationwallets"><?php echo str_replace(":","",$lang['WALLET_LAST10']); ?></a></li>
  <li><a data-toggle="tab" href="#supportwallet"><?php echo str_replace(":","",$lang['WALLET_SUPPORT']); ?></a></li>
  <li><a data-toggle="tab" href="#2fawallet"> 2FA</a></li>
  <li><a data-toggle="tab" href="#passawallet"><?php echo str_replace(":","",$lang['WALLET_PASSUPDATE']); ?></a></li>
  
    <li><a data-toggle="tab" href="#logoutwallet"><?php echo str_replace(":","",$lang['WALLET_LOGOUT']); ?></a></li>
  </ul>

  <div class="tab-content">

  <div id="homewallet" class="tab-pane fade in active">
    <?php
if($withdrawalletuser=="0" or $withdrawalletuser==""){
 ?>
 <div class="alert alert-warning" role="alert">
  
 <?php echo $lang['WALLET_2FAON']; ?> <?php echo $lang['WALLET_SENDCONF']; ?>  <?php echo "$short"; ?>
</div>
  <?php
}
 ?>
  
    <p><?php echo $lang['WALLET_HELLO']; ?>, <strong><?php echo $user_session; ?></strong>!  <?php if ($admin) {?><strong><font color="red">[Admin]</font><?php }?></strong></p>
<p><?php echo $lang['WALLET_BALANCE']; ?> <strong id="balance"><?php echo satoshitize($balance); ?></strong> <?=$short?></p>

  <p><small><?php $amountwalletlg = $lang['WALLET_AMOUNT']; $feewalletlg = $lang['WALLET_FEE']; echo "$amountwalletlg $feewalletlg: $reserve $short"; ?></small></p>


  
  
<form action="index.php" method="POST">
<br />
<?php
if ($admin)
{
  ?>
<p><strong>Admin Links:</strong></p>
  <a href="?a=home" class="btn btn-default">Admin Dashboard</a>


  <?php
}
?>


  </div>
  
  
 <div id="sendcoinwallet" class="tab-pane fade"> 
   <script src="https://www.google.com/recaptcha/api.js"></script>
<script>
       function onSubmit(token) {
         document.getElementById("withdrawform").submit();
       }
     </script>

<p><strong><?php echo $lang['WALLET_SEND']; ?></strong></p>
 <p><?php echo $lang['WALLET_BALANCE']; ?> <strong id="balance"><?php echo satoshitize($balance); ?></strong> <?=$short?></p>
 

 <br />

 <?php
if($withdrawalletuser=="1"){
 ?>
<form action="index.php" method="POST" autocomplete="off" class="clearfix" id="withdrawform">
    <input type="hidden" name="action" value="withdraw" />
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
    <div class="col-md-4"><input type="text" class="form-control" name="address" placeholder="<?php echo $lang['WALLET_ADDRESS']; ?>" onkeypress="return /[a-zA-Z0-9]/i.test(event.key)"></div>
    <div class="col-md-2"><input type="text" class="form-control" name="amount" placeholder="<?php echo $lang['WALLET_AMOUNT']; ?>" onkeypress="return /[0-9_.]/i.test(event.key)"></div>

    <div class="col-md-2"><button  class="btn btn-default"  type="submit"><?php echo $lang['WALLET_SENDCONF']; ?></button></div>
</form>
 <?php
}
 ?>
  <?php
if($withdrawalletuser=="0" or $withdrawalletuser==""){
 ?>
 <div class="alert alert-warning" role="alert">
  
 <?php echo $lang['WALLET_2FAON']; ?> <?php echo $lang['WALLET_SENDCONF']; ?> 
</div>
  <?php
}
 ?>
<p id="withdrawmsg"></p>
<br />
<p> <?php echo $lang['WALLET_FEE']; ?>:<?php echo "$feewithdraw $short"; ?></p>
  </div>
  
  <div id="listwallets" class="tab-pane fade"> 
 

 
  
  
<p><strong><?php echo $lang['WALLET_USERADDRESSES']; ?></strong></p>
<form action="index.php" method="POST" id="newaddressform">
	<input type="hidden" name="action" value="new_address" />
	<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_NEWADDRESS']; ?></button>
</form>
<p id="newaddressmsg"></p>
<br />
<table class="table table-bordered table-striped" id="alist">
<thead>
<tr>
<td><?php echo $lang['WALLET_ADDRESS']; ?>:</td>
<td><?php echo $lang['WALLET_QRCODE']; ?>:</td>
</tr>
</thead>
<tbody>
<?php
foreach ($addressList as $address)
{
echo "<tr><td>".$address."</t>";?>
<td><a href="qrgen/?address=<?php echo $address;?>">
 <a class="photo" href="qrgen/?address=<?php echo $address;?>" class="thumbnail img-responsive">
 <img id="imageresource" src="qrgen/?address=<?php echo $address;?>" alt="<?php echo $address;?>" style="width:100px;border:0;"></a>
 

 
 </td><tr>
<?php
}
?>
</tbody>
</table>

    <script>
        $(".photo").frydBox();
    </script>

  
  
  </div>
  
<div id="transationwallets" class="tab-pane fade"> 
    


<p><?php echo $lang['WALLET_LAST10']; ?></p>
<table class="table table-bordered table-striped" id="txlist">
<thead>
   <tr>
      <td nowrap><?php echo $lang['WALLET_DATE']; ?></td>
      <td nowrap><?php echo $lang['WALLET_ADDRESS']; ?></td>
      <td nowrap><?php echo $lang['WALLET_TYPE']; ?></td>
      <td nowrap><?php echo $lang['WALLET_AMOUNT']; ?></td>
      <td nowrap><?php echo $lang['WALLET_FEE']; ?></td>
      <td nowrap><?php echo $lang['WALLET_CONFS']; ?></td>
      <td nowrap><?php echo $lang['WALLET_INFO']; ?></td>
   </tr>
</thead>
<tbody>
   <?php
   $bold_txxs = "";
   foreach($transactionList as $transaction) {
      if($transaction['category']=="send") { $tx_type = '<b style="color: #FF0000;">Sent</b>'; } else { $tx_type = '<b style="color: #01DF01;">Received</b>'; }
      echo '<tr>
               <td>'.date('Y-d-m h:i a',$transaction['time']).'</td>
               <td>'.$transaction['address'].'</td>
               <td>'.$tx_type.'</td>
               <td>'.abs($transaction['amount']).'</td>
               <td>'.$transaction['fee'].'</td>
               <td>'.$transaction['confirmations'].'</td>
               <td><a href="' . $blockchain_tx_url,  $transaction['txid'] . '" target="_blank">Info</a></td>
            </tr>';
   }
   ?>
   </tbody>
</table>

</div>

 
 <div id="supportwallet" class="tab-pane fade"> 
 <form action="index.php" method="POST">
<input type="hidden" name="action" value="support" action="index.php"/>
<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_SUPPORT']; ?></button>
</form> 
  </div>
  
<div id="2fawallet" class="tab-pane fade">

  <script src="https://www.google.com/recaptcha/api.js"></script>
  <script>
       function onSubmit(token) {
         document.getElementById("2fa").submit();
       }
     </script>


  <form action="index.php" method="POST" id="2fa">
  
 
 <?php
if($withdrawalletuser=="0" or $withdrawalletuser==""){
 ?> 
  <h3>1 - Download - <a target="_blank" href="https://authy.com/download/">Authy</a></h3>
  <br />
  2 - CLICK <?php echo $lang['WALLET_2FAON']; ?>
 <br />
<form>
<input type="hidden" name="action" value="authgen" />
<button  class="g-recaptcha" data-sitekey="6Lcig60UAAAAAKrrVRzibcx1cbq3SwqF96R-fn8s" data-callback="onSubmit"  class="btn btn-default"><?php echo $lang['WALLET_2FAON']; ?></button>
</form><p>
 
<?php
}
 ?> 
 
 <?php
if($withdrawalletuser=="1"){
 ?> 
  
 <div class="alert alert-danger" role="alert">
  <?php echo $lang['WALLET_SENDCONF']; ?>  <?php echo "$short"; ?> LOCKED
</div>
<form action="index.php" method="post">
<form>
<input type="hidden" name="action" value="disauth" />
<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_2FAOFF']; ?></button>
</form>
<?php
}
 ?> 
</div>
  
  <div id="passawallet" class="tab-pane fade"> 
  
<br />
<p><strong><?php echo $lang['WALLET_PASSUPDATE']; ?></strong></p>

  
<form action="index.php" method="POST" autocomplete="off" class="clearfix" id="pwdform">
    <input type="hidden" name="action" value="password" />
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
    <div class="col-md-2"><input type="password" class="form-control" name="oldpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATEOLD']; ?>"></div>
    <div class="col-md-2"><input type="password" class="form-control" name="newpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATENEW']; ?>"></div>
    <div class="col-md-2"><input type="password" class="form-control" name="confirmpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATENEWCONF']; ?>"></div>
    <div class="col-md-2">
    <button type="submit" class="btn btn-default"><?php echo $lang['WALLET_PASSUPDATECONF']; ?></button>
</div>
</form>
<p id="pwdmsg"></p>
<br />
<p style="font-size:1em;"><?php echo $lang['WALLET_SUPPORTNOTE']; ?></p>
<br />
  
  </div>
  
  
  
  
<div id="logoutwallet" class="tab-pane fade">



<form action="index.php" method="POST">
        <input type="hidden" name="action" value="logout" />
        <button type="submit" class="btn btn-default"><?php echo $lang['WALLET_LOGOUT']; ?></button>
</form>

    </div>
  
  
  
</div>
</div> 
  



<script type="text/javascript">
var blockchain_tx_url = "<?=$blockchain_tx_url?>";
$("#withdrawform input[name='action']").first().attr("name", "jsaction");
$("#newaddressform input[name='action']").first().attr("name", "jsaction");
$("#pwdform input[name='action']").first().attr("name", "jsaction");
$("#donate").click(function (e){
  $("#donateinfo").show();
  $("#withdrawform input[name='address']").val("<?=$donation_address?>");
  $("#withdrawform input[name='amount']").val("0.01");
});
$("#withdrawform").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {
            var json = $.parseJSON(data);
            if (json.success)
            {
              $("#withdrawform input.form-control").val("");
            	$("#withdrawmsg").text(json.message);
            	$("#withdrawmsg").css("color", "green");
            	$("#withdrawmsg").show();
            	updateTables(json);
            } else {
            	$("#withdrawmsg").text(json.message);
            	$("#withdrawmsg").css("color", "red");
            	$("#withdrawmsg").show();
            }
            if (json.newtoken)
            {
              $('input[name="token"]').val(json.newtoken);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //ugh, gtfo    
        }
    });
    e.preventDefault();
});
$("#newaddressform").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {
            var json = $.parseJSON(data);
            if (json.success)
            {
            	$("#newaddressmsg").text(json.message);
            	$("#newaddressmsg").css("color", "green");
            	$("#newaddressmsg").show();
            	updateTables(json);
            } else {
            	$("#newaddressmsg").text(json.message);
            	$("#newaddressmsg").css("color", "red");
            	$("#newaddressmsg").show();
            }
            if (json.newtoken)
            {
              $('input[name="token"]').val(json.newtoken);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //ugh, gtfo    
        }
    });
    e.preventDefault();
});
$("#pwdform").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {
            var json = $.parseJSON(data);
            if (json.success)
            {
               $("#pwdform input.form-control").val("");
               $("#pwdmsg").text(json.message);
               $("#pwdmsg").css("color", "green");
               $("#pwdmsg").show();
            } else {
               $("#pwdmsg").text(json.message);
               $("#pwdmsg").css("color", "red");
               $("#pwdmsg").show();
            }
            if (json.newtoken)
            {
              $('input[name="token"]').val(json.newtoken);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //ugh, gtfo    
        }
    });
    e.preventDefault();
});

function updateTables(json)
{
	$("#balance").text(json.balance.toFixed(8));
	$("#alist tbody tr").remove();
	for (var i = json.addressList.length - 1; i >= 0; i--) {
		$("#alist tbody").prepend("<tr><td>" + json.addressList[i] + "</td></tr>");
	}
	$("#txlist tbody tr").remove();
	for (var i = json.transactionList.length - 1; i >= 0; i--) {
		var tx_type = '<b style="color: #01DF01;">Received</b>';
		if(json.transactionList[i]['category']=="send")
		{
			tx_type = '<b style="color: #FF0000;">Sent</b>';
		}
		$("#txlist tbody").prepend('<tr> \
               <td>' + moment(json.transactionList[i]['time'], "X").format('l hh:mm a') + '</td> \
               <td>' + json.transactionList[i]['address'] + '</td> \
               <td>' + tx_type + '</td> \
               <td>' + Math.abs(json.transactionList[i]['amount']) + '</td> \
               <td>' + (json.transactionList[i]['fee']?json.transactionList[i]['fee']:'') + '</td> \
               <td>' + json.transactionList[i]['confirmations'] + '</td> \
               <td><a href="' + blockchain_tx_url.replace("%s", json.transactionList[i]['txid']) + '" target="_blank">Info</a></td> \
            </tr>');
	}
}
</script>
