<?php 
  session_start();
  require('app/init.php');
  
  if(isset($_POST['email'])  && isset($_POST['password'])) {
    if($_POST['email'] == USERNAME && $_POST['password'] == PASSWORD) {
      header('location: index.php'); 
      $_SESSION['loggedIn_'.APP_NAME] = "true";
    } else {
      $msg = "Invalid Credentials. Try again";
    }
  }

?>
<html lang="en"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <title>Login - HondaCarIndia</title>
  <link href="http://apoxymedia.com/hrm/assets/css/login.css" rel="stylesheet">
  <link href="http://apoxymedia.com/hrm/assets/css/default.css" rel="stylesheet" type="text/css">
  
  <link href="http://apoxymedia.com/hrm/assets/css/font-awesome.min.css" type="text/css" rel="stylesheet">
  <link href="http://apoxymedia.com/hrm/assets/css/bootstrap.min.css" type="text/css" rel="stylesheet">
  <link href="http://apoxymedia.com/hrm/assets/css/reset.css" type="text/css" rel="stylesheet">
  <link href="http://apoxymedia.com/hrm/assets/css/defaultTheme.css" type="text/css" rel="stylesheet">
  <link href="http://apoxymedia.com/hrm/assets/css/main.css" type="text/css" rel="stylesheet">
  

  <script type="text/javascript" src="http://apoxymedia.com/hrm/assets/js/jquery.min.js.download"></script>
  <script type="text/javascript" src="http://apoxymedia.com/hrm/assets/js/bootstrap.min.js.download"></script>
  <script type="text/javascript" src="http://apoxymedia.com/hrm/assets/js/respond.js.download"></script>
  
  </head>

  <body class="text-center" style="    background-color: #f5f5f5;">
 
    <form class="form-signin" method="POST" action="#">
      
      <h1 class="h3 mb-3 font-weight-normal" style="margin: 23px 0px">Please Login to Continue</h1>
       <?php if(isset($msg)) {?>
       <div class="alert alert-danger">
         <?=$msg ?> 
       </div>  
       <?php } ?>                
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="email" class="form-control" placeholder="Email address" autofocus="" name="email" required="" value="hondacarindia@admin.com">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="password" class="form-control" placeholder="Password" name="password" required="" value="6105239">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <input id="login_btn" type="submit" class="btn btn-lg  btn-block" value="Log-in" name="login" style="background: #1D62F0; color: white">
      <p style="    color: #6c757d!important; margin-top: 3rem!important; margin-bottom: 1rem!important;
">© Apoxy Media</p>
    </form>
 
</body></html>