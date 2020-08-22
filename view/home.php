<?php if (!defined("IN_WALLET")) { die("Auth Error"); } ?>
                <h1><?php echo $lang['PAGE_HEADER']; ?></h1>
                <?php
                if (!empty($error))
                {
                    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
                }

?>

<script>
function forceLower(strInput) 
{
strInput.value=strInput.value.toLowerCase();
}
</script>

<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#login"><?php echo $lang['FORM_LOGIN']; ?></a></li>
    <li><a data-toggle="tab" href="#register"><?php echo $lang['FORM_SIGNUP']; ?></a></li>
  </ul>
  <div class="tab-content">
    <div id="login" class="tab-pane fade in active">
                <p><?php echo $lang['FORM_LOGIN']; ?></p>
                <form action="index.php" autocomplete="off" method="POST" class="clearfix">
                    <input type="hidden" name="action" value="login" />
                    <div class="col-md-6">
                
                    <input onkeyup="return forceLower(this);" type="text" class="form-control" name="username" placeholder="<?php echo $lang['FORM_USER']; ?> Ex: <?php echo strtolower($fullname); ?>1">
                
                <input type="password" class="form-control" name="password" placeholder="<?php echo $lang['FORM_PASS']; ?>">
                <input type="text" class="form-control" name="auth" placeholder="<?php echo $lang['FORM_2FA']; ?>">
                
                <button type="submit" class="btn btn-default"><?php echo $lang['FORM_LOGIN']; ?></button>
                    
                   <br />
                    <br />
                    <div class="g-recaptcha" data-sitekey=<?=$public?>></div>
            </div>
                  
                </form>
            </div>
                <br />
    <div id="register" class="tab-pane fade">
                <p><?php echo $lang['FORM_CREATE']; ?></p>
                <form action="index.php" autocomplete="off" method="POST" class="clearfix">
                    <input type="hidden" name="action" value="register" />
                <div class="col-md-6"><input onkeyup="return forceLower(this);" type="text" class="form-control" name="mail"  placeholder="<?php echo $lang['MAIL']; ?> Ex: <?php echo strtolower($fullname)."@gmail.com"; ?>">
                
                   <input onkeyup="return forceLower(this);" type="text" class="form-control" name="username"  placeholder="<?php echo $lang['FORM_USER']; ?> Ex: <?php echo strtolower($fullname); ?>1">
                    <input type="password" class="form-control" name="password" placeholder="<?php echo $lang['FORM_PASS']; ?>">
                    <input type="password" class="form-control" name="confirmPassword" placeholder="<?php echo $lang['FORM_PASSCONF']; ?>">
                    <button type="submit" class="btn btn-default"><?php echo $lang['FORM_SIGNUP']; ?></button>
                    <br />
                    <br />
                <div class="g-recaptcha" data-sitekey=<?=$public?>></div>
                    </div>
                
                </form>
           </div>
     </div>
</div>
<br>
