<?php
	include("config.php");

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	session_start();

	
	if(isset($_SESSION['user_id'])){
	    $user_id = (int)$_SESSION['user_id'];

	    $sql = "SELECT * FROM user natural join branch_manager natural join branch natural join authorisation WHERE user_id = '$user_id'";
	    $branchManager = $conn->query($sql);
	    $branchManager = $branchManager->fetch_assoc();
	   	   	
	}
	else{
		header("Location: branchManager.php");
	}
	
	
	

	if( $_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['update'])){

		$user_id = (int)$_SESSION['user_id'];
		$username = mysqli_real_escape_string($conn, $_POST['username']);
      	$old_password = md5(mysqli_real_escape_string($conn, $_POST['old_password']));
      	$new_password = md5(mysqli_real_escape_string($conn, $_POST['new_password']));
      	$mail_address = mysqli_real_escape_string($conn, $_POST['mail_address']);
      	$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
      	$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
      	$branch_name = mysqli_real_escape_string($conn, $_POST['branch_name']);

      	//burda bu kullanıcı adı bu eski şifre bunun mu diye kontrol edilecek

      	$sql = "CALL sp_update_branch_manager('$user_id', '$username', '$new_password', '$mail_address', '$first_name', '$last_name', '$branch_name')";

      	if ($conn->query($sql) === TRUE) {

      		unset($_SESSION['user_id']);

		    header("Location: branchManager.php");
   			
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
<title>update branch manager Page</title>

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

			<!-- Navbar -->
		<div class="navbar navbar-inverse" role="navigation">
			<div class="navbar-header">

				<a class="navbar-brand" href="systemManagerHomePage.php"><lable><?php echo $_SESSION['login_user']; ?></lable></a>
				<a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>

			</div>

			<ul class="nav navbar-nav navbar-right collapse" id="navbar-icons" style=" position:absolute; top:14px; right:10px;">

				<li>
					<button type="button">
					<span>Logout</span>
					<i class="icon-exit"></i>
					</button>
				</li>
			</ul>
		</div>
		<!-- /navbar -->


		<!-- Page container -->
	 	<div class="page-container">


			<!-- Sidebar -->
			<div class="sidebar">
				<div class="sidebar-content">


					<!-- Main navigation -->
					<ul class="navigation">
						<li><a href="cityManagerHomePage.php"><span>Home Page</span> <i class="icon-home3"></i></a></li>
						<li><a href="branch.php"><span>CRUD Branch</span> <i class="icon-settings"></i></a></li>
						<li><a href="branchManager.php"><span>CRUD Branch Manager</span> <i class="icon-users"></i></a></li>
						

						

					</ul>
					<!-- /main navigation -->
					
				</div>
			</div>
			<!-- /sidebar -->
			
			<!-- Page content -->
	 		<div class="page-content">

	 			<form action="branchManagerUpdate.php" method="post" role="form" class="form-horizontal">
			        <div class="panel panel-default">
			            <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-right2"></i>Update Branch Manager</h6></div>
			            <div class="panel-body">

					        <div class="form-group">

					            <div class="form-group">
									<label class="col-sm-2 control-label">username: </label>
									<div class="col-sm-4">
										<input type="text" name="username" class="form-control" value=<?php echo $branchManager["username"]; ?> required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">old password: </label>
									<div class="col-sm-4">
										<input type="password" name="old_password" class="form-control" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">new password: </label>
									<div class="col-sm-4">
										<input type="password" name="new_password" class="form-control" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">mail address: </label>
									<div class="col-sm-4">
										<input type="text" name="mail_address" class="form-control" value=<?php echo $branchManager["mail_address"]; ?> required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">first name: </label>
									<div class="col-sm-4">
										<input type="text" name="first_name" class="form-control" value=<?php echo $branchManager["first_name"]; ?> required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">last name: </label>
									<div class="col-sm-4">
										<input type="text" name="last_name" class="form-control" value=<?php echo $branchManager["last_name"]; ?> required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">city_name: </label>
									<div class="col-sm-4">
										<input type="text" name="branch_name" class="form-control" value=<?php echo $branchManager["name"]; ?> required>
									</div>
								</div>


					        </div>

			                <div class="form-actions text-right">
			                	<input type="submit" name="update" class="btn btn-primary" value="UPDATE"></input>
			                	
			                </div>

					    </div>
					</div>

					
				</form>


			</div>
			<!-- /page content -->


		</div>
		<!-- /page container -->

	</body>

	<script type="text/javascript">
		


	</script>

</html>
