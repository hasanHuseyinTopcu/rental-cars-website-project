<?php
	include("config.php");

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	session_start();

	
	$username = $_SESSION['login_user'];

	$sql = "SELECT * FROM user natural join city_manager natural join city WHERE username = '$username'";
	$cityManager = mysqli_query($conn, $sql);
	$cityManager = $cityManager->fetch_assoc();


	$sql = "SELECT username, authorisation_type, login_date FROM last_10_login natural join user natural join authorisation ORDER BY login_date DESC";
	$login_informations = mysqli_query($conn, $sql);

	if( !$cityManager )
		header("location: 404.php");

	$_SESSION["city_id"] = $cityManager["city_id"];


	$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>City Manager Home Page</title>

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
						<li class="active"><a href="cityManagerHomePage.php"><span>Home Page</span> <i class="icon-home3"></i></a></li>
						<li><a href="branch.php"><span>CRUD Branch</span> <i class="icon-settings"></i></a></li>
						<li ><a href="branchManager.php"><span>CRUD Branch Manager</span> <i class="icon-users"></i></a></li>
						

						

					</ul>
					<!-- /main navigation -->
					
				</div>
			</div>
			<!-- /sidebar -->
			
			<!-- Page content -->
	 		<div class="page-content">

	 			<h4>City Manager Home Page</h4>
	 			

	 			<?php echo "Şehir yöneticisi kullanıcı adı : ".$cityManager["username"]."<br/>".
	 			"<br/>".
	 			"Yönettiği şehir ismi : ",$cityManager["name"]."<br/>"; ?>
	 			

	 			<!-- Default datatable inside panel -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Sisteme giriş yapan son 10 kişi</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>username</th>
		                            <th>authorisation type</th>
		                            <th>Information</th>
		                            <th>Login Date and Time</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($login_information = $login_informations->fetch_assoc()){ ?>
			                        <tr>
			                        	
			                        	<td><?php echo $login_information["username"]; ?></td>
			                        	<td><?php echo $login_information["authorisation_type"]; ?></td>
			                        	<td><?php echo "giriş yaptı" ?></td>
			                        	<td><?php echo $login_information["login_date"]; ?></td>
			                        	
			                        </tr>
		                       <?php } ?>	                       
		                        
		                    </tbody>
		                </table>
		                
	                </div>
		        </div>
		        <!-- /default datatable inside panel -->


			</div>
			<!-- /page content -->


		</div>
		<!-- /page container -->

	</body>

	<script type="text/javascript">
		


	</script>

</html>
