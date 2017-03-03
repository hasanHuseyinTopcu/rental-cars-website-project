<?php
	include("config.php");

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	session_start();

	
	if( $_SERVER["REQUEST_METHOD"] == "POST"){

		if( isset($_POST['update']) ){

			$user_id = $_POST['user_id'];

			$_SESSION['user_id'] = $user_id;

			header("location: systemManagerUpdate.php");
		}

		else if( isset($_POST['delete']) ){

			$user_id = $_POST['user_id'];
			$sql = "CALL sp_delete_system_manager('$user_id')";

			if ($conn->query($sql) === TRUE) {

			    header("Location: " . $_SERVER['REQUEST_URI']);
	   			exit();
			} else {

			    header("location: 404.php");
			}
		}

		else if( isset($_POST['add']) ){

			$username = mysqli_real_escape_string($conn, $_POST['username']);
	      	$password = md5(mysqli_real_escape_string($conn, $_POST['password']));
	      	$mail_address = mysqli_real_escape_string($conn, $_POST['mail_address']);
	      	$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
	      	$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
	      	$authorisation_type = $_POST['selected_authorisation_type'];

	      	$sql = "CALL sp_insert_system_manager('$username', '$password', '$mail_address', '$first_name', '$last_name', '$authorisation_type')";

	      	if ($conn->query($sql) === TRUE) {

			    header("Location: " . $_SERVER['REQUEST_URI']);
	   			exit();

			} else {

			    header("location: 404.php");
			}
		}

		
	}


	$sql = "SELECT * FROM user natural join system_manager";
	$systemManagers = mysqli_query($conn, $sql);

	$sql = "SELECT * FROM authorisation";
	$authorisationTypes = mysqli_query($conn, $sql);

	if( !$systemManagers || !$authorisationTypes)
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
						<li class="active"><a href="systemManagerHomePage.php"><span>Home Page</span> <i class="icon-home3"></i></a></li>
						<li><a href="authorisation.php"><span>CRUD Authorisation</span> <i class="icon-settings"></i></a></li>
						<li><a href="city.php"><span>CRUD City</span> <i class="icon-settings"></i></a></li>
						<li ><a href="cityManager.php"><span>CRUD City Manager</span> <i class="icon-users"></i></a></li>
						

						

					</ul>
					<!-- /main navigation -->
					
				</div>
			</div>
			<!-- /sidebar -->
			
			<!-- Page content -->
	 		<div class="page-content">

	 			<h4>System Manager Home Page</h4>
	 			<br/>Bu sayfada sistem manger ekleme, silme, güncelleme ve görüntüleme işlmleri yapılıyor.<br/><br/>

	 			<form action="systemManagerHomePage.php" method="post" role="form" class="form-horizontal">
			        <div class="panel panel-default">
			            <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-right2"></i>Add System Manager</h6></div>
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
									<label class="col-sm-2 control-label">authorisation type: </label>
									<div class="col-sm-4">
										<div class="col-sm-12">
			                                <select name="selected_authorisation_type" id="selected_authorisation_type" class="form-control input-lg">			                                   	
                       							<?php while($authorisationType = $authorisationTypes->fetch_assoc()){ ?>
                       								<option><?php echo $authorisationType["authorisation_type"]; ?></option>
                       							<?php } ?>

			                                </select>
			                            </div>
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
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>System Managers List</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>username</th>
		                            <th>password</th>
		                            <th>mail address</th>
		                            <th>first name</th>
		                            <th>last name</th>
		                            <th>Operations</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($systemManager = $systemManagers->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="systemManagerHomePage.php" method="post">
			                        	<td name="username"><?php echo $systemManager["username"]; ?></td>
			                        	<td><?php echo $systemManager["password"]; ?></td>
			                        	<td><?php echo $systemManager["mail_address"]; ?></td>
			                        	<td><?php echo $systemManager["first_name"]; ?></td>
			                        	<td><?php echo $systemManager["last_name"]; ?></td>
			                        	<td>
			                        		<input type="text" name="user_id" value=<?php echo $systemManager["user_id"]; ?> hidden />
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

	<script type="text/javascript">
		


	</script>

</html>
