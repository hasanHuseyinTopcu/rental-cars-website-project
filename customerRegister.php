<?php
	include("config.php");

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	session_start();

	if( $_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['add'])){

		$username = mysqli_real_escape_string($conn, $_POST['username']);
      	$password = md5(mysqli_real_escape_string($conn, $_POST['password']));
      	$mail_address = mysqli_real_escape_string($conn, $_POST['mail_address']);
      	$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
      	$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
      	$authorisation_type = "customer";
      	$phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
      	$age = mysqli_real_escape_string($conn, $_POST['age']);
      	$age=(int)$age;
      	$address = mysqli_real_escape_string($conn, $_POST['address']);
      	$balance = 500;

  		$sql = "CALL sp_insert_customer('$username', '$password', '$mail_address', '$first_name', '$last_name', '$authorisation_type', '$phone_number', '$age', '$address', '$balance')";

      	if ($conn->query($sql) === TRUE) {

      		$_SESSION['login_user'] = $username;

		    header("location: index.php");
   			exit();

		} else {

		    header("location: 404.php");
		}

	}
	


	$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>Kullanıcı Kayıt Sayfası</title>

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

	<body>

		<!-- Page container -->
	 	<div class="page-container">


			<h4>Kullanıcı Kayıt Sayfası</h4>
 			<br/><br/>

 			<form action="customerRegister.php" method="post" role="form" class="form-horizontal">
		        <div class="panel panel-default">
		            <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-right2"></i>Bilgileri Giriniz</h6></div>
		            <div class="panel-body">

				        <div class="form-group">

				            <div class="form-group">
								<label class="col-sm-2 control-label">username: </label>
								<div class="col-sm-4">
									<input type="text" name="username" class="form-control" required>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">password: </label>
								<div class="col-sm-4">
									<input type="password" name="password" class="form-control" required>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">mail address: </label>
								<div class="col-sm-4">
									<input type="text" name="mail_address" class="form-control" required>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">first name: </label>
								<div class="col-sm-4">
									<input type="text" name="first_name" class="form-control" required>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">last name: </label>
								<div class="col-sm-4">
									<input type="text" name="last_name" class="form-control" required>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">phone number: </label>
								<div class="col-sm-4">
									<input type="text" name="phone_number" class="form-control" required>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">age: </label>
								<div class="col-sm-4">
									<input type="text" name="age" class="form-control" required>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">address: </label>
								<div class="col-sm-4">
									<input type="text" name="address" class="form-control">
								</div>
							</div>

				        </div>

		                <div class="form-actions text-right">
		                	<input type="submit" name="add" class="btn btn-primary" value="KAYIT OL"></input>
		                	
		                </div>

				    </div>
				</div>

				
			</form>


		</div>
		<!-- /page container -->

	</body>

	<script type="text/javascript">
		


	</script>

</html>
