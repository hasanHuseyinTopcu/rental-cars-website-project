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

	
	$sql = "SELECT * FROM all_car_list";
	$cars = mysqli_query($conn, $sql);

	$sql2 = "SELECT * FROM all_economically_car_list";
	$economicallycars = mysqli_query($conn, $sql2);

	$sql3 = "SELECT * FROM all_automatic_or_semi_automatic_gearbox_car_list";
	$automaticCars = mysqli_query($conn, $sql3);
		
	$sql4 = "SELECT * FROM all_SUV_or_pickp_up_car_list";
	$suv_or_pickup_cars = mysqli_query($conn, $sql4);

	if ( !$cars || !$economicallycars || !$automaticCars || !$suv_or_pickup_cars){
	    header("location: 404.php");
	}

	$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>Customer Home Page</title>

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

				<a class="navbar-brand" href="index.php"><lable><?php echo $_SESSION['login_user']; ?></lable></a>
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
						<li class="active"><a href="index.php"><span>Customer Home Page</span> <i class="icon-home3"></i></a></li>
						<li><a href="carFiltering.php"><span>Car Filtering</span> <i class="icon-settings"></i></a></li>
						<li><a href="carStatistics.php"><span>Car Statistics</span> <i class="icon-settings"></i></a></li>

					</ul>
					<!-- /main navigation -->
					
				</div>
			</div>
			<!-- /sidebar -->
			
			<!-- Page content -->
	 		<div class="page-content">

	 			<!-- datatable that include all cars -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Tüm arabaların listesi</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>brand name</th>
		                            <th>model name</th>
		                            <th>model year</th>
		                            <th>type name</th>
		                            <th>fuel type</th>
		                            <th>gear type</th>
		                            <th>daily price</th>
		                            <th>Operations</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($car = $cars->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="index.php" method="post">
				                        	<td><?php echo $car["brand_name"]; ?></td>
				                        	<td><?php echo $car["model_name"]; ?></td>
				                        	<td><?php echo $car["model_year"]; ?></td>
				                        	<td><?php echo $car["type_name"]; ?></td>
				                        	<td><?php echo $car["fuel_type"]; ?></td>
				                        	<td><?php echo $car["gear_type"]; ?></td>
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

		        <br/><br/><br/><br/><br/>

		        <!-- datatable that include all cars with selected city_name -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Günlük kiralama fiyatı ortalamadan düşük olan araçların listesi</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                        	<th>city name</th>
		                        	<th>branch name</th>
		                            <th>brand name</th>
		                            <th>model name</th>
		                            <th>model year</th>
		                            <th>type name</th>
		                            <th>seat number</th>
		                            <th>fuel type</th>
		                            <th>gear type</th>
		                            <th>daily price</th>
		                            <th>Operations</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($economicallyCar = $economicallycars->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="index.php" method="post">
				                        	<td><?php echo $economicallyCar["city_name"]; ?></td>
				                        	<td><?php echo $economicallyCar["branch_name"]; ?></td>
				                        	<td><?php echo $economicallyCar["brand_name"]; ?></td>
				                        	<td><?php echo $economicallyCar["model_name"]; ?></td>
				                        	<td><?php echo $economicallyCar["model_year"]; ?></td>
				                        	<td><?php echo $economicallyCar["type_name"]; ?></td>
				                        	<td><?php echo $economicallyCar["seat_number"]; ?></td>
				                        	<td><?php echo $economicallyCar["fuel_type"]; ?></td>
				                        	<td><?php echo $economicallyCar["gear_type"]; ?></td>
				                        	<td><?php echo $economicallyCar["daily_price"]; ?></td>
				                        	<td>
				                        		<input type="text" name="car_id" value=<?php echo $economicallyCar["car_id"]; ?> hidden />
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

		        <br/><br/><br/><br/><br/>

		        <!-- datatable that include all cars with selected city_name -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Otomaitk yada yarı otomatik araçların listesi</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                        	<th>city name</th>
		                        	<th>branch name</th>
		                            <th>brand name</th>
		                            <th>model name</th>
		                            <th>model year</th>
		                            <th>type name</th>
		                            <th>seat number</th>
		                            <th>fuel type</th>
		                            <th>gear type</th>
		                            <th>daily price</th>
		                            <th>Operations</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($automaticCar = $automaticCars->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="index.php" method="post">
				                        	<td><?php echo $automaticCar["city_name"]; ?></td>
				                        	<td><?php echo $automaticCar["branch_name"]; ?></td>
				                        	<td><?php echo $automaticCar["brand_name"]; ?></td>
				                        	<td><?php echo $automaticCar["model_name"]; ?></td>
				                        	<td><?php echo $automaticCar["model_year"]; ?></td>
				                        	<td><?php echo $automaticCar["type_name"]; ?></td>
				                        	<td><?php echo $automaticCar["seat_number"]; ?></td>
				                        	<td><?php echo $automaticCar["fuel_type"]; ?></td>
				                        	<td><?php echo $automaticCar["gear_type"]; ?></td>
				                        	<td><?php echo $automaticCar["daily_price"]; ?></td>
				                        	<td>
				                        		<input type="text" name="car_id" value=<?php echo $automaticCar["car_id"]; ?> hidden />
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

		        <br/><br/><br/><br/><br/>


		        <!-- datatable that include all cars with selected city_name -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Araç kasa tipi SUV veya Pick-up olanlar olan araçların listesi</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                        	<th>city name</th>
		                        	<th>branch name</th>
		                            <th>brand name</th>
		                            <th>model name</th>
		                            <th>model year</th>
		                            <th>type name</th>
		                            <th>seat number</th>
		                            <th>fuel type</th>
		                            <th>gear type</th>
		                            <th>daily price</th>
		                            <th>Operations</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($suv_or_pickup_car = $suv_or_pickup_cars->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="index.php" method="post">
				                        	<td><?php echo $suv_or_pickup_car["city_name"]; ?></td>
				                        	<td><?php echo $suv_or_pickup_car["branch_name"]; ?></td>
				                        	<td><?php echo $suv_or_pickup_car["brand_name"]; ?></td>
				                        	<td><?php echo $suv_or_pickup_car["model_name"]; ?></td>
				                        	<td><?php echo $suv_or_pickup_car["model_year"]; ?></td>
				                        	<td><?php echo $suv_or_pickup_car["type_name"]; ?></td>
				                        	<td><?php echo $suv_or_pickup_car["seat_number"]; ?></td>
				                        	<td><?php echo $suv_or_pickup_car["fuel_type"]; ?></td>
				                        	<td><?php echo $suv_or_pickup_car["gear_type"]; ?></td>
				                        	<td><?php echo $suv_or_pickup_car["daily_price"]; ?></td>
				                        	<td>
				                        		<input type="text" name="car_id" value=<?php echo $suv_or_pickup_car["car_id"]; ?> hidden />
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

		        <br/><br/><br/><br/><br/>

			</div>
			<!-- /page content -->

	 		

		</div>
		<!-- /page container -->

	</body>

	<script type="text/javascript">
		


	</script>

</html>
