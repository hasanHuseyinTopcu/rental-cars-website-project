<?php
	include("config.php");
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	session_start();

	if( $_SERVER["REQUEST_METHOD"] == "POST"){

		if( isset($_POST['update']) ){

			$city_id = $_POST['city_id'];

			$_SESSION['city_id'] = $city_id;

			header("location: cityUpdate.php");
		}

		else if( isset($_POST['delete']) ){

			$city_id = $_POST['city_id'];
			$sql = "CALL sp_delete_city('$city_id')";

			if ($conn->query($sql) === TRUE) {

			    header("Location: " . $_SERVER['REQUEST_URI']);
	   			exit();
			} else {

			    header("location: 404.php");
			}
		}

		else if( isset($_POST['add']) ){

			$city_name = mysqli_real_escape_string($conn, $_POST['city_name']);

	      	$sql = "CALL sp_insert_city('$city_name')";

	      	if ($conn->query($sql) === TRUE) {

			    header("Location: " . $_SERVER['REQUEST_URI']);
	   			exit();

			} else {

			    header("location: 404.php");
			}
		}

		
	}


	$sql = "SELECT * FROM city";
	$cities = mysqli_query($conn, $sql);

	if( !$cities )
		header("location: 404.php");

	$conn->close();



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>System Manager Home Page</title>

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
				<!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons">
					<span class="sr-only">asdasdasd</span>
					<i class="icon-grid3"></i>
				</button>
				<button type="button" class="navbar-toggle offcanvas">
					<span class="sr-only">Tasdasdasd</span>
					<i class="icon-paragraph-justify2"></i>
				</button>-->
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
						<li><a href="systemManagerHomePage.php"><span>Home Page</span> <i class="icon-home3"></i></a></li>
						<li><a href="authorisation.php"><span>CRUD Authorisation</span> <i class="icon-settings"></i></a></li>
						<li class="active"><a href="city.php"><span>CRUD City</span> <i class="icon-settings"></i></a></li>
						<li><a href="cityManager.php"><span>CRUD City Manager</span> <i class="icon-users"></i></a></li>
						

						

					</ul>
					<!-- /main navigation -->
					
				</div>
			</div>
			<!-- /sidebar -->
			
			<!-- Page content -->
	 		<div class="page-content">
	 			Burada şehir CRUD işlemleri yapılacak

	 			<form action="city.php" method="post" role="form" class="form-horizontal">
			        <div class="panel panel-default">
			            <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-right2"></i>Add City</h6></div>
			            <div class="panel-body">

					        <div class="form-group">

					            <div class="form-group">
									<label class="col-sm-2 control-label">city name: </label>
									<div class="col-sm-4">
										<input type="text" name="city_name" class="form-control" required>
									</div>
								</div>

					        </div>

			                <div class="form-actions text-right">
			                	<input type="submit" name="add" class="btn btn-primary" value="SAVE"></input>
			                	
			                </div>

					    </div>
					</div>

					
				</form>


	 			<!-- Default datatable inside panel -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>City List</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>city name</th>
		                            <th>Operations</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($city = $cities->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="city.php" method="post">
			                        	<td name="city_name"><?php echo $city["name"]; ?>
			                        	</td>
			                        	<td>
			                        		<input type="text" name="city_id" value=<?php echo $city["city_id"]; ?> hidden />
			                        		<button type="submit" name="update" class="update" title="UPDATE"><i class="icon-info"></i></button>
			                        		<button type="submit" name="delete" class="delete" title="DELETE"><i class="icon-remove"></i></button>
			                        	</td>
			                        	</form>
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

</html>

