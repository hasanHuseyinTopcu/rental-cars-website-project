<?php
	include("config.php");

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	session_start();

	if( $_SERVER["REQUEST_METHOD"] == "POST"){

		if( isset($_POST['car_detail']) ){

			$car_id = $_POST['car_id'];

			$_SESSION['car_id'] = $car_id;

			header("location: carDetail.php");
		}

		else if( isset($_POST['rent']) ){

			$car_id = $_POST['car_id'];

			$_SESSION['car_id'] = $car_id;

			header("location: carDetail.php");
		}

	}

	if( $_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['filter']) ){

		$car_color = $_POST["selected_car_color"];
		$city_name = $_POST["selected_city_name"];
		$seat_number = $_POST["selected_seat_number"];

		if($car_color == "Empty" AND $city_name == "Empty" AND $seat_number == "Empty"){
			$sql = "SELECT * FROM all_car_list";
			$cars = mysqli_query($conn, $sql);
		}
		else if($car_color != "Empty" AND $city_name != "Empty" AND $seat_number != "Empty"){
			$sql = "SELECT * FROM all_car_list WHERE color='$car_color' AND city_name='$city_name' AND seat_number='$seat_number'";
			$cars = mysqli_query($conn, $sql);
		}
		else if($car_color != "Empty" AND $city_name == "Empty" AND $seat_number == "Empty"){
			$sql = "SELECT * FROM all_car_list WHERE color='$car_color'";
			$cars = mysqli_query($conn, $sql);
		}
		else if($car_color == "Empty" AND $city_name != "Empty" AND $seat_number == "Empty"){
			$sql = "SELECT * FROM all_car_list WHERE city_name='$city_name'";
			$cars = mysqli_query($conn, $sql);
		}
		else if($car_color == "Empty" AND $city_name == "Empty" AND $seat_number != "Empty"){
			$sql = "SELECT * FROM all_car_list WHERE seat_number='$seat_number'";
			$cars = mysqli_query($conn, $sql);
		}
		else if($car_color != "Empty" AND $city_name != "Empty" AND $seat_number == "Empty"){
			$sql = "SELECT * FROM all_car_list WHERE color='$car_color' AND city_name='$city_name'";
			$cars = mysqli_query($conn, $sql);
		}
		else if($car_color != "Empty" AND $city_name == "Empty" AND $seat_number != "Empty"){
			$sql = "SELECT * FROM all_car_list WHERE color='$car_color' AND seat_number='$seat_number'";
			$cars = mysqli_query($conn, $sql);
		}
		else if($car_color == "Empty" AND $city_name != "Empty" AND $seat_number != "Empty"){
			$sql = "SELECT * FROM all_car_list WHERE city_name='$city_name' AND seat_number='$seat_number'";
			$cars = mysqli_query($conn, $sql);
		}

	}

	
	
	$sql = "SELECT distinct(color) FROM car";
	$colors = mysqli_query($conn, $sql);

	$sql = "SELECT name FROM city";
	$cities = mysqli_query($conn, $sql);

	$sql = "SELECT distinct(seat_number) FROM car_type";
	$seat_numbers = mysqli_query($conn, $sql);

	if( !$colors || !$cities || !$seat_numbers )
		header("location: 404.php");

	$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>Car Filtering Page</title>

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
						<li ><a href="index.php"><span>Customer Home Page</span> <i class="icon-home3"></i></a></li>
						<li class="active"><a href="carFiltering.php"><span>Car Filtering</span> <i class="icon-settings"></i></a></li>
						<li><a href="carStatistics.php"><span>Car Statistics</span> <i class="icon-settings"></i></a></li>

					</ul>
					<!-- /main navigation -->
					
				</div>
			</div>
			<!-- /sidebar -->
			
			<!-- Page content -->
	 		<div class="page-content">

	 			<form action="carFiltering.php" method="post" role="form" class="form-horizontal">
			        <div class="panel panel-default">
			            <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-right2"></i>Filtreleme</h6></div>
			            <div class="panel-body">

				 			<div class="form-group">
								<label class="col-sm-2 control-label">select city: </label>
								<div class="col-sm-4">
									<div class="col-sm-12">
			                            <select name="selected_city_name" id="selected_city_name" class="form-control input-lg">
			                            	<option>Empty</option>                               	
			       							<?php while($city = $cities->fetch_assoc()){ ?>
			       								<option><?php echo $city["name"]; ?></option>
			       							<?php } ?>

			                            </select>
			                        </div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">select color: </label>
								<div class="col-sm-4">
									<div class="col-sm-12">
			                            <select name="selected_car_color" id="selected_car_color" class="form-control input-lg">		
			                            	<option>Empty</option>                        	
			       							<?php while($color = $colors->fetch_assoc()){ ?>
			       								<option><?php echo $color["color"]; ?></option>
			       							<?php } ?>

			                            </select>
			                        </div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">select seat number: </label>
								<div class="col-sm-4">
									<div class="col-sm-12">
			                            <select name="selected_seat_number" id="selected_seat_number" class="form-control input-lg">			    
			                            	<option>Empty</option>                               	
			       							<?php while($seat_number = $seat_numbers->fetch_assoc()){ ?>
			       								<option><?php echo $seat_number["seat_number"]; ?></option>
			       							<?php } ?>

			                            </select>
			                        </div>
								</div>
							</div>

							<div class="form-actions text-right">
			                	<input type="submit" name="filter" class="btn btn-primary" value="FILTER"></input>
			                	
			                </div>

						</div>
					</div>
				</form>

				<!-- datatable that include all cars -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Filtelenmiş araç listesi</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                        	<th>city name</th>
		                            <th>brand name</th>
		                            <th>model name</th>
		                            <th>model year</th>
		                            <th>type name</th>
		                            <th>color</th>
		                            <th>fuel type</th>
		                            <th>seat number</th>
		                            <th>daily price</th>
		                            <th>Operations</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($car = $cars->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="index.php" method="post">
			                        	<td><?php echo $car["city_name"]; ?></td>
			                        	<td><?php echo $car["brand_name"]; ?></td>
			                        	<td><?php echo $car["model_name"]; ?></td>
			                        	<td><?php echo $car["model_year"]; ?></td>
			                        	<td><?php echo $car["type_name"]; ?></td>
			                        	<td><?php echo $car["color"]; ?></td>
			                        	<td><?php echo $car["fuel_type"]; ?></td>
			                        	<td><?php echo $car["seat_number"]; ?></td>
			                        	<td><?php echo $car["daily_price"]; ?></td>
			                        	<td>
			                        		<input type="text" name="car_id" value=<?php echo $car["car_id"]; ?> hidden />
			                        		<button type="submit" name="car_detail" class="car_detail" title="CAR DETAIL"><i class="icon-info"></i></button>
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
