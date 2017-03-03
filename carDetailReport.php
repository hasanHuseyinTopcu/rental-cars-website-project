<?php
	include("config.php");

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	session_start();

	if( $_SERVER["REQUEST_METHOD"] == "POST"){

		if( isset($_POST['take_report']) ){

			$report_type = $_POST["selected_report_type"];

			if($report_type == "PDF"){

			}
			else if ($report_type == "HTML") {
				

			}else if($report_type == "TEXT FILE"){

				
			}

		}

	}

	
	$car_id = $_SESSION["car_id"];
	
	$sql = "SELECT * from car_detail WHERE car_id = '$car_id'";
	$car = mysqli_query($conn, $sql);
	$car = $car->fetch_assoc();
	$carx = $car;
	$sql = "SELECT * from car_has_car_technical_specification natural join car_technical_specification WHERE car_id = '$car_id'";
	$car2 = mysqli_query($conn, $sql);

	$sql = "SELECT * from car_photo WHERE car_id = '$car_id'";
	$car3 = mysqli_query($conn, $sql);


	$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>Car Detail Report Page</title>

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
						<li><a href="index.php"><span>Customer Home Page</span> <i class="icon-home3"></i></a></li>
						<li><a href="carFiltering.php"><span>Car Filtering</span> <i class="icon-settings"></i></a></li>
						<li><a href="carStatistics.php"><span>Car Statistics</span> <i class="icon-settings"></i></a></li>
						

						

					</ul>
					<!-- /main navigation -->
					
				</div>
			</div>
			<!-- /sidebar -->
			
			<!-- Page content -->
	 		<div class="page-content">

				<div>
				<form action="carDetailReport.php" method="post" role="form" class="form-horizontal">
				        <div class="panel panel-default">
				            <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-right2"></i>Araç Detay Sayfası</h6></div>
				            <div class="panel-body">

						        <div class="form-group">

						        	<div class="form-group">
										<label class="col-sm-2 control-label">city: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["city_name"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">branch: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["branch_name"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">branch address: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["address"]; ?></label>
										</div>
									</div>

						            <div class="form-group">
										<label class="col-sm-2 control-label">brand: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["brand_name"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">model: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["model_name"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">year: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["model_year"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">car officail website: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["website_url"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">kasa tipi: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["type_name"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">seat number: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["seat_number"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">fuel type: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["fuel_type"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">average fuel: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["average_fuel"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">daily price: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["daily_price"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">weekly pice: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["weekly_price"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">gear type: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["gear_type"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">gear number: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $car["gear_number"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Technical Specification: </label>
										<div class="col-sm-4">
											<?php while($car = $car2->fetch_assoc()){ ?>

												<label class="control-label"><?php echo $car["technical_specification"]; ?></label>
												<br/>
											<?php } ?>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">car photos: </label>
										<div class="col-sm-10">
											<?php while($car = $car3->fetch_assoc()){ ?>

												<img src=<?php echo $car["url"]; ?> style="width:304px;height:228px;">
												<br/>
												<br/>
											<?php } ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">start date: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $_SESSION["start_date"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">end date: </label>
										<div class="col-sm-4">
											<label class="control-label"><?php echo $_SESSION["end_date"]; ?></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Select Report Type: </label>
										<div class="col-sm-4">
											<select name="selected_report_type" class="form-control input-lg">			    
				                            	<option>PDF</option>                    	
				       							<option>HTML</option>
				       							<option>TEXT FILE</option>
				                            </select>
			                            </div>

									</div>
									

						        </div>

				                <div class="form-actions text-right">
				                	<input type="submit" name="take_report" class="btn btn-primary" value="Take Report"></input>
				                	
				                </div>

						    </div>
						</div>

						
					</form>
				</div>	 			

			</div>
			<!-- /page content -->


		</div>
		<!-- /page container -->

	</body>

	<script type="text/javascript">
		


	</script>

</html>
