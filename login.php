<?php
   	include("config.php");

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['login'])) {
      
      	$username = mysqli_real_escape_string($conn, $_POST['username']);
      	$password = mysqli_real_escape_string($conn, $_POST['password']); 
      	
      	$password = md5($password);

      	$sql = "SELECT user_id FROM user WHERE username = '$username' and password = '$password'";
      	$result = mysqli_query($conn, $sql);
      	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      	$active = $row['active'];
      
      	$count = mysqli_num_rows($result);
		
      	if($count == 1) {

         	$sql = "SELECT * FROM user natural join authorisation WHERE username = '$username' and password = '$password'";
      		$result = $conn->query($sql);
      		$result = $result->fetch_assoc();

      		$user_authorisation_type =  $result["authorisation_type"];

            $user = $result;

      		$_SESSION['login_user'] = $username;

      		switch ($user_authorisation_type) {
      			case 'system manager':
      				header("location: systemManagerHomePage.php");
      				break;
      			case 'city manager':
      				header("location: cityManagerHomePage.php");
      				break;
      			case 'branch manager':
      				header("location: branchManagerHomePage.php");
      				break;
      			case 'customer':
      				header("location: index.php");
      				break;
      			default:
      				header("location: 404.php");
      				break;
      		}

            $sql = "SELECT count(last_10_login_id) as row_number FROM last_10_login";
            $result = mysqli_query($conn, $sql);
            $result = $result->fetch_assoc();

            if( ((int)$result["row_number"]) >= 10){
               $sql = "CALL sp_delete_last_10_login()";
               $result = mysqli_query($conn, $sql);
            }

            $user_id = $user["user_id"];
            $login_date = date('Y-m-d H:i:s');
            $sql = "CALL sp_insert_last_10_login('$user_id', '$login_date')";
            $result = mysqli_query($conn, $sql);

        	
      	}else {
         	$error = "Your Login Name or Password is invalid";
         	echo $error;
      	}
   }

	if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['register'])) {


		header("location: customerRegister.php");
	}


	$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>Login Page</title>

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/londinium-theme.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/icons.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="js/plugins/charts/sparkline.min.js"></script>

<script type="text/javascript" src="js/plugins/forms/uniform.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/select2.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/inputmask.js"></script>
<script type="text/javascript" src="js/plugins/forms/autosize.js"></script>
<script type="text/javascript" src="js/plugins/forms/inputlimit.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/listbox.js"></script>
<script type="text/javascript" src="js/plugins/forms/multiselect.js"></script>
<script type="text/javascript" src="js/plugins/forms/validate.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/tags.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/switch.min.js"></script>

<script type="text/javascript" src="js/plugins/forms/uploader/plupload.full.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/uploader/plupload.queue.min.js"></script>

<script type="text/javascript" src="js/plugins/forms/wysihtml5/wysihtml5.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/wysihtml5/toolbar.js"></script>

<script type="text/javascript" src="js/plugins/interface/daterangepicker.js"></script>
<script type="text/javascript" src="js/plugins/interface/fancybox.min.js"></script>
<script type="text/javascript" src="js/plugins/interface/moment.js"></script>
<script type="text/javascript" src="js/plugins/interface/jgrowl.min.js"></script>
<script type="text/javascript" src="js/plugins/interface/datatables.min.js"></script>
<script type="text/javascript" src="js/plugins/interface/colorpicker.js"></script>
<script type="text/javascript" src="js/plugins/interface/fullcalendar.min.js"></script>
<script type="text/javascript" src="js/plugins/interface/timepicker.min.js"></script>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/application.js"></script>

</head>

<body class="full-width page-condensed">


	<!-- Login wrapper -->
	<div class="login-wrapper">
    	<form action="login.php" method="post" role="form">
			<div class="well">

				<div class="form-group has-feedback has-feedback-no-label">
					<input type="text" name="username" class="form-control" placeholder="username">
					<i class="icon-users form-control-feedback"></i>
				</div>
				<div class="form-group has-feedback has-feedback-no-label">
					<input type="password" name="password" class="form-control" placeholder="password">
					<i class="icon-lock form-control-feedback"></i>
				</div>

				<div class="row form-actions">
					<div class="col-xs-6">
						<button type="submit" name="register" class="btn btn-danger pull-right"><i class="icon-menu2"></i>Register</button>
					</div>

					<div class="col-xs-6">
						<button type="submit" name="login" class="btn btn-primary pull-right"><i class="icon-menu2"></i>Login</button>
					</div>
				</div>

			</div>
    	</form>
	</div>
	<!-- /login wrapper -->


	</body>

</html>

