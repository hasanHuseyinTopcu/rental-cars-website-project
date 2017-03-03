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
	
	$sql = "SELECT * FROM all_car_list WHERE daily_price = (SELECT max(daily_price) FROM all_car_list)";
	$cars = mysqli_query($conn, $sql);

	$sql = "SELECT * FROM all_car_list WHERE daily_price = (SELECT min(daily_price) FROM all_car_list)";
	$cars2 = mysqli_query($conn, $sql);

	$sql = "SELECT avg(average_fuel) as average_fuel FROM all_car_list";
	$cars3 = mysqli_query($conn, $sql);

	$sql = "SELECT city_name, count(car_id) as car_count FROM all_car_list GROUP BY city_name";
	$cars4 = mysqli_query($conn, $sql);

	$sql = "SELECT * FROM all_car_list ORDER BY car_id ASC LIMIT 1";
	$cars5 = mysqli_query($conn, $sql);

	$sql = "SELECT * FROM all_car_list ORDER BY car_id DESC LIMIT 1";
	$cars6 = mysqli_query($conn, $sql);

	$sql = "SELECT city_name, avg(daily_price) as daily_price FROM all_car_list GROUP BY city_name ";
	$cars7 = mysqli_query($conn, $sql);

	$sql = "SELECT city_name, sum(daily_price) as daily_price FROM all_car_list GROUP BY city_name ";
	$cars8 = mysqli_query($conn, $sql);

	$sql = "SELECT color, count(car_id) as car_number FROM all_car_list GROUP BY color ORDER BY color ASC";
	$cars9 = mysqli_query($conn, $sql);

	$sql = "SELECT brand_name, count(car_id) as car_number FROM all_car_list GROUP BY brand_name";
	$cars10 = mysqli_query($conn, $sql);

	if( !$cars || !$cars2 || !$cars3 || !$cars4 || !$cars5 || !$cars6 || !$cars7 || !$cars8 || !$cars9 || !$cars10 )
		header("location: 404.php");


	$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>Car Statistics Page</title>

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
						<li><a href="carFiltering.php"><span>Car Filtering</span> <i class="icon-settings"></i></a></li>
						<li class="active"><a href="carStatistics.php"><span>Car Statistics</span> <i class="icon-settings"></i></a></li>
						

						

					</ul>
					<!-- /main navigation -->
					
				</div>
			</div>
			<!-- /sidebar -->
			
			<!-- Page content -->
	 		<div class="page-content">

	 			<!-- datatable that include all cars -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Günlük Kiralama Fiyatı en fazla olan araba</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>car id</th>
		                            <th>Brand</th>
		                            <th>Model</th>
		                            <th>Result</th>
		                            <th>Operations</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($car = $cars->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="carStatistics.php" method="post">
				                        	<td><?php echo $car["car_id"]; ?></td>
				                        	<td><?php echo $car["brand_name"]; ?></td>
				                        	<td><?php echo $car["model_name"]; ?></td>
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

		        <br/><br/><br/><br/>

		        <!-- datatable that include all cars -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Günlük Kiralama Fiyatı en az olan araba</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>car id</th>
		                            <th>Brand</th>
		                            <th>Model</th>
		                            <th>Result</th>
		                            <th>Operations</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($car = $cars2->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="carStatistics.php" method="post">
				                        	<td><?php echo $car["car_id"]; ?></td>
				                        	<td><?php echo $car["brand_name"]; ?></td>
				                        	<td><?php echo $car["model_name"]; ?></td>
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

		        <br/><br/><br/><br/>

		        <!-- datatable that include all cars -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Araçların ortalama yakıt tüketimi</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>                           
		                            <th>Result</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($car = $cars3->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="carStatistics.php" method="post">
				                        	<td><?php echo $car["average_fuel"]; ?></td>
				                        	
			                        	</form>
			                        </tr>
		                       <?php } ?>	                       
		                        
		                    </tbody>
		                </table>
		                
	                </div>
		        </div>
		        <!-- /default datatable inside panel -->

		        <br/><br/><br/><br/>

		        <!-- datatable that include all cars -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Şehre göre araç sayısı</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>city name</th>
		                            <th>Result</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($car = $cars4->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="carStatistics.php" method="post">
				                        	<td><?php echo $car["city_name"]; ?></td>
				                        	<td><?php echo $car["car_count"]; ?></td>
			                        	</form>
			                        </tr>
		                       <?php } ?>	                       
		                        
		                    </tbody>
		                </table>
		                
	                </div>
		        </div>
		        <!-- /default datatable inside panel -->

		        <br/><br/><br/><br/>

		        <!-- datatable that include all cars -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Siteye eklenen ilk araba</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>Brand Name</th>
		                            <th>Model Name</th>
		                            <th>Model year</th>
		                            <th>Operations</th>
		                        </tr>		
		                    </thead>
		                    <tbody>

		                    	<?php while($car = $cars5->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="carStatistics.php" method="post">
				                        	
				                        	<td><?php echo $car["brand_name"]; ?></td>
				                        	<td><?php echo $car["model_name"]; ?></td>
				                        	<td><?php echo $car["model_year"]; ?></td>
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

		        <br/><br/><br/><br/>

		        <!-- datatable that include all cars -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Siteye eklenen son araba</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>Brand Name</th>
		                            <th>Model Name</th>
		                            <th>Model year</th>
		                            <th>Operations</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($car = $cars6->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="carStatistics.php" method="post">
				                        	<td><?php echo $car["brand_name"]; ?></td>
				                        	<td><?php echo $car["model_name"]; ?></td>
				                        	<td><?php echo $car["model_year"]; ?></td>
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

		        <br/><br/><br/><br/>

		        <!-- datatable that include all cars -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Şehre göre ortalama araç kirlama fiyatı</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>city name</th>
		                            <th>Result</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($car = $cars7->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="carStatistics.php" method="post">
				                        	<td><?php echo $car["city_name"]; ?></td>
				                        	<td><?php echo $car["daily_price"]; ?></td>
			                        	</form>
			                        </tr>
		                       <?php } ?>	                       
		                        
		                    </tbody>
		                </table>
		                
	                </div>
		        </div>
		        <!-- /default datatable inside panel -->

		        <!-- datatable that include all cars -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Şehre göre araçların günlük kira fiyatlarının toplamı</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>city name</th>
		                            <th>Result</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($car = $cars8->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="carStatistics.php" method="post">
				                        	<td><?php echo $car["city_name"]; ?></td>
				                        	<td><?php echo $car["daily_price"]; ?></td>
			                        	</form>
			                        </tr>
		                       <?php } ?>	                       
		                        
		                    </tbody>
		                </table>
		                
	                </div>
		        </div>
		        <!-- /default datatable inside panel -->

		        <!-- datatable that include all cars -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Renge göre araçların sayısı</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>Color</th>
		                            <th>car number</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($car = $cars9->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="carStatistics.php" method="post">
				                        	<td><?php echo $car["color"]; ?></td>
				                        	<td><?php echo $car["car_number"]; ?></td>
			                        	</form>
			                        </tr>
		                       <?php } ?>	                       
		                        
		                    </tbody>
		                </table>
		                
	                </div>
		        </div>
		        <!-- /default datatable inside panel -->

		        <!-- datatable that include all cars -->
	            <div class="panel panel-default">
	                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Modeline göre araç sayısı</h6></div>
	                <div class="datatable">
	                	
		                <table class="table">
		                    <thead>
		                        <tr>
		                            <th>brand name</th>
		                            <th>car number</th>
		                        </tr>
		                    </thead>
		                    <tbody>

		                    	<?php while($car = $cars10->fetch_assoc()){ ?>
			                        <tr>
			                        	<form action="carStatistics.php" method="post">
				                        	<td><?php echo $car["brand_name"]; ?></td>
				                        	<td><?php echo $car["car_number"]; ?></td>
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
