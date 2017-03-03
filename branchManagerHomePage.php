<?php
	include("config.php");

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	session_start();

	$username = $_SESSION['login_user'];
	
	$sql = "SELECT C.name as city_name, B.name as branch_name, username, user_id, branch_id FROM user natural join branch_manager natural join branch as B inner join city as C ON B.city_id = C.city_id WHERE username = '$username'";
	$branchManager = mysqli_query($conn, $sql);
	

	$sql = "SELECT * FROM car_technical_specification";
	$techSs = mysqli_query($conn, $sql);

	if( !$branchManager )
		header("location: 404.php");

	$branchManager = $branchManager->fetch_assoc();




	if( $_SERVER["REQUEST_METHOD"] == "POST"){

		if( isset($_POST['add']) ){

			

			$c_o_w_id = 0;
			$c_m_id = 0;
			$c_t_id = 0;
			$c_f_id = 0;
			$p_i_id = 0;
			$b_id = $branchManager["branch_id"];
			$c_g_id = 0;
			$color = $_POST["color"];
			$about = $_POST["about"];


			$website_url = $_POST["website_url"];

			$sql = "CALL sp_insert_car_official_website('$website_url')";
			$result = mysqli_query($conn, $sql);

			

			$sql2 = "SELECT (IFNULL(MAX(car_official_website_id), 1)) as id FROM car_official_website";
			$result2 = mysqli_query($conn, $sql2);

			$result2 = $result2->fetch_assoc();
			$c_o_w_id = $result2["id"];
			
			
			


			$brand_name = $_POST["brand_name"];
			$model_name = $_POST["model_name"];
			$model_year = $_POST["model_year"];

			$sql = "CALL sp_insert_car_model('$brand_name', '$model_name', '$model_year', '$website_url')";
			$result = mysqli_query($conn, $sql);

			

			$sql2 = "SELECT (IFNULL(MAX(car_model_id), 1)) as id FROM car_model";
			$result2 = mysqli_query($conn, $sql2);


			$result2 = $result2->fetch_assoc();
			$c_m_id = $result2["id"];
			
			



			$type_name = $_POST["type_name"];
			$seat_number = $_POST["seat_number"];

			$sql = "CALL sp_insert_car_type('$type_name', '$seat_number')";
			$result = mysqli_query($conn, $sql);

			

			$sql2 = "SELECT (IFNULL(MAX(car_type_id), 1)) as id FROM car_type";
			$result2 = mysqli_query($conn, $sql2);

		

			$result2 = $result2->fetch_assoc();
			$c_t_id = $result2["id"];
			



			$fuel_type = $_POST["fuel_type"];
			$average_fuel = $_POST["average_fuel"];

			$sql = "CALL sp_insert_car_fuel('$fuel_type', '$average_fuel')";
			$result = mysqli_query($conn, $sql);

			

			$sql2 = "SELECT (IFNULL(MAX(car_fuel_id), 1)) as id FROM car_fuel";
			$result2 = mysqli_query($conn, $sql2);

			

			$result2 = $result2->fetch_assoc();
			$c_f_id = $result2["id"];
			




			$daily_price = $_POST["daily_price"];
			$weekly_price = $_POST["weekly_price"];

			$sql = "CALL sp_insert_price_information('$daily_price', '$weekly_price')";
			$result = mysqli_query($conn, $sql);


			$sql2 = "SELECT (IFNULL(MAX(price_information_id), 1)) as id FROM price_information";
			$result2 = mysqli_query($conn, $sql2);

			

			$result2 = $result2->fetch_assoc();
			$p_i_id = $result2["id"];
			



			$gear_type = $_POST["gear_type"];
			$gear_number = $_POST["gear_number"];

			$sql = "CALL sp_insert_car_gear('$gear_type', '$gear_number')";
			$result = mysqli_query($conn, $sql);

			

			$sql2 = "SELECT (IFNULL(MAX(car_gear_id), 1)) as id FROM car_gear";
			$result2 = mysqli_query($conn, $sql2);
			
			$result2 = $result2->fetch_assoc();
			$c_g_id = $result2["id"];
			
			
			$c_m_id = (int)$c_m_id;
			$c_t_id = (int)$c_t_id;
			$c_f_id = (int)$c_f_id;
			$p_i_id = (int)$p_i_id;
			$b_id = (int)$b_id;
			$c_g_id = (int)$c_g_id;
			$sql = "CALL sp_insert_car('$c_m_id', '$c_t_id', '$c_f_id', '$p_i_id', '$b_id', '$c_g_id', '$color', '$about')";
			$result = mysqli_query($conn, $sql);

			

			$sql = "SELECT (IFNULL(MAX(car_id), 1)) as id FROM car";
			$result = mysqli_query($conn, $sql);
			$result = $result->fetch_assoc();
			$car_id = $result["id"];

			

			$technicalSpecifications = $_POST["technicalSpecifications"];

			foreach ($technicalSpecifications as $technicalSpecification) {
				$sql = "SELECT car_technical_specification_id FROM car_technical_specification WHERE technical_specification = '$technicalSpecification'";
				$result = mysqli_query($conn, $sql);
				$result = $result->fetch_assoc();
				
				
				$id = $result["car_technical_specification_id"];
				$sql = "CALL sp_insert_car_has_car_technical_specification('$car_id', '$id')";
				$result = mysqli_query($conn, $sql);

				
			}			

			


			//resimleri ekle
			$j = 0;     // Variable for indexing uploaded image.
			$target_path = "pictures/";     // Declaring Path for uploaded images.
			for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
				// Loop to get individual element from the array
				$validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.

				$ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)

				$file_extension = end($ext); // Store extensions in the variable.
				$target_path = $target_path . $_FILES['file']['name'][$i];     // Set the target path with a new name of image.
				$j = $j + 1;      // Increment the number of uploaded images according to the files in array.

				if (($_FILES["file"]["size"][$i] < 10000000) && in_array($file_extension, $validextensions))
				{
					if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
						$picture_name = $_FILES['file']['name'][$i];
						$pictureFolder = "pictures/".$picture_name;
						
						$sql = "CALL sp_insert_car_photo('$car_id', '$pictureFolder')";
						$result = mysqli_query($conn, $sql);
					} 
					
				} 

			}



			


			

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
<title>Branch Manager Home Page</title>

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


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/script.js"></script>
<link rel="stylesheet" type="text/css" href="css/imageUploadStyles.css">

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
						<li class="active"><a href="branchManagerHomePage.php"><span>Home Page</span> <i class="icon-home3"></i></a></li>
						
						
					</ul>
					<!-- /main navigation -->
					
				</div>
			</div>
			<!-- /sidebar -->
			
			<!-- Page content -->
	 		<div class="page-content">

	 			<h4>Branch MAnager Home PAge</h4>

	 			<?php
	 				echo "branch_manager username : ".$branchManager["username"]."<br/><br/>";
	 				echo "branch's name : ".$branchManager["branch_name"]."<br/><br/>";
	 				echo "city's name : ".$branchManager["city_name"]."<br/><br/>";
	 				echo "branch manager's id : ".$branchManager["branch_id"]."<br/><br/>";
	 			?>


	 			<form action="branchManagerHomePage.php" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
			        <div class="panel panel-default">
			            <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-right2"></i>Add new car into your branch</h6></div>
			            <div class="panel-body">

					        <div class="form-group">

					            <div class="form-group">
									<label class="col-sm-2 control-label">brand name: </label>
									<div class="col-sm-4">
										<input type="text" name="brand_name" class="form-control"  >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">model name: </label>
									<div class="col-sm-4">
										<input type="text" name="model_name" class="form-control"  >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">model year: </label>
									<div class="col-sm-4">
										<input type="text" name="model_year" class="form-control"  >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">car officail website: </label>
									<div class="col-sm-4">
										<input type="text" name="website_url" class="form-control" >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">kasa tipi: </label>
									<div class="col-sm-4">
										<input type="text" name="type_name" class="form-control"  >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">seat number: </label>
									<div class="col-sm-4">
										<input type="text" name="seat_number" class="form-control" >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">fuel type: </label>
									<div class="col-sm-4">
										<input type="text" name="fuel_type" class="form-control" >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">average fuel: </label>
									<div class="col-sm-4">
										<input type="text" name="average_fuel" class="form-control" >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">daily price: </label>
									<div class="col-sm-4">
										<input type="text" name="daily_price" class="form-control" >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">weekly pice: </label>
									<div class="col-sm-4">
										<input type="text" name="weekly_price" class="form-control" >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">gear type: </label>
									<div class="col-sm-4">
										<input type="text" name="gear_type" class="form-control" >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">gear number: </label>
									<div class="col-sm-4">
										<input type="text" name="gear_number" class="form-control" >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">color: </label>
									<div class="col-sm-4">
										<input type="text" name="color" class="form-control" >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">about: </label>
									<div class="col-sm-4">
										<input type="text" name="about" class="form-control" >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">Technical Specification: </label>
									<div class="col-sm-9">

										<select multiple="multiple" name="technicalSpecifications[]" class="form-control" title="Seçmek için tıklayın" style="height:150px;">

											<?php while($techS = $techSs->fetch_assoc()){ ?>

												<option><?php echo $techS["technical_specification"]; ?></option>
											<?php } ?>
			                                
			                            </select>

									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">car photos: </label>
									<div class="col-sm-9">
										<div id="maindiv">
											<div id="formdiv">
												
												First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 10000KB.
												<div id="filediv"><input name="file[]" type="file" id="file"/></div>
												<input type="button" id="add_more" class="upload" value="Add More Files"/>
													
												
												
												
											</div>
										</div>
									</div>
								</div>

								

					        </div>

			                <div class="form-actions text-right">
			                	<input type="submit" name="add" class="btn btn-primary" value="ADD CAR"></input>
			                	
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
