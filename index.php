<?php
include_once dirname(__FILE__).'/dashboard/System/System.php';
$sys = new System();

if($sys->checkLoginState()){
	$sys->deleteCookie();
}

if(isset($_POST['username']) && isset($_POST['pass'])){
	$u = $sys->escape_data($_POST['username']);
	$p = $sys->escape_data($_POST['pass']);
	if($u && $p){
		$sys->setEmail($u);
		$sys->setPassword($p);
		$login = $sys->login();
		if($login['success'] == true){
			$userToken = $login['token']; 
			$sys->createRecord($sys->getEmail(), $userToken);
			header("location:".$sys->domain().'/dashboard');
		}else{
		    if ($login['error']['message']){
                $err = '<div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                     <strong>Error!</strong> '.$login["error"]["message"].'
                  </div>';
            }else{
                $err = '<div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                     <strong>Error!</strong> Could not connect to resource. Please contact admin if problem persist
                  </div>';
            }

		}
	}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Velocity Health</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo $sys->domain() ?>/images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $sys->domain() ?>/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $sys->domain() ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $sys->domain() ?>/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $sys->domain() ?>/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo $sys->domain() ?>/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $sys->domain() ?>/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $sys->domain() ?>/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo $sys->domain() ?>/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo $sys->domain() ?>/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $sys->domain() ?>/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(<?php echo $sys->domain() ?>/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						<img src="<?php echo $sys->domain() ?>/images/icons/logo.png" width="150" style="margin-top: 70px;" alt="">
					</span>
				</div>
                <?php   if ($err){ echo $err;} ?>
				<form class="login100-form validate-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username" required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password" required>
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="<?php echo $sys->domain() ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $sys->domain() ?>/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $sys->domain() ?>/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo $sys->domain() ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $sys->domain() ?>/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $sys->domain() ?>/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo $sys->domain() ?>/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $sys->domain() ?>/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $sys->domain() ?>/js/main.js"></script>

</body>
</html>