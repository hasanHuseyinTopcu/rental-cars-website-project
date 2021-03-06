<?php
	include("config.php");

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	session_start();

	
	if(isset($_SESSION['branch_id'])){
	    $branch_id = (int)$_SESSION['branch_id'];
	    $city_id = (int)$_SESSION['city_id'];

	    $sql = "SELECT * FROM branch WHERE branch_id = '$branch_id'";
	    $branch = $conn->query($sql);
	    $branch = $branch->fetch_assoc();

	    $sql = "SELECT name FROM city WHERE city_id = '$city_id'";
		$city_name = mysqli_query($conn, $sql);
		$city_name = $city_name->fetch_assoc();
		$city_name = $city_name["name"];
	   	   	
	}
	else{
		header("Location: branch.php");
	}
	
	
	

	if( $_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['update'])){

		$branch_id = (int)$_SESSION['branch_id'];
      	$city_name = mysqli_real_escape_string($conn, $_POST['city_name']);
      	$branch_name = mysqli_real_escape_string($conn, $_POST['branch_name']);
      	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
      	$address = mysqli_real_escape_string($conn, $_POST['address']);

      	$sql = "CALL sp_update_branch('$branch_id', '$city_name', '$branch_name', '$phone', '$address')";

      	if ($conn->query($sql) === TRUE) {

      		unset($_SESSION['branch_id']);

		    header("Location: branch.php");
   			
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
<title>Branch Update Page</title>

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
						<li ><a href="branchManager.php"><span>CRUD Branch Manager</span> <i class="icon-users"></i></a></li>
						

						

					</ul>
					<!-- /main navigation -->
					
				</div>
			</div>
			<!-- /sidebar -->
			
			<!-- Page content -->
	 		<div class="page-content">

	 			<h4>update Branch page</h4>

	 			<form action="" method="post" role="form" class="form-horizontal">
			        <div class="panel panel-default">
			            <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-right2"></i>update branch</h6></div>
			            <div class="panel-body">

					        <div class="form-group">

					            <div class="form-group">
									<label class="col-sm-2 control-label">city name: </label>
									<div class="col-sm-4">
										<input type="text" name="city_name" class="form-control" value=<?php echo $city_name; ?> readonly required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">branch name: </label>
									<div class="col-sm-4">
										<input type="text" name="branch_name" class="form-control" value=<?php echo $branch['name']; ?> required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">phone: </label>
									<div class="col-sm-4">
										<input type="text" name="phone" class="form-control" value=<?php echo $branch['phone']; ?> required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">address: </label>
									<div class="col-sm-4">
										<input type="text" name="address" class="form-control" value=<?php echo $branch['address']; ?> required>
									</div>
								</div>

					        </div>

			                <div class="form-actions text-right">
			                	<button type="submit" name="update" class="btn btn-primary">UPDATE</button>
			                	
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
