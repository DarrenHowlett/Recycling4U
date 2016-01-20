<?php

	// Include/Required files
	/*
	 * This required file will load the config file for staff members.  The reason this is needed is because
	 * staff members have more permissions than a normal/registered user.  These extra permissions are needed to
	 * be able to add/remove a product to the web site.  At the moment a normal user is able to access the page, but
	 * I am working on restricting the access/what is seen on this page depending on the users access level.  To start
	 * though I am just working on the functionality of the page first.
	 */
	require_once ('../admin/config/staffMember.php');
	// /. Include/Required files

	// Open database connection
	$conn = new mysqli($host, $user, $pass, $dbase);
	if (mysqli_connect_errno()) {
		printf("Database connection failed due to: %s\n", mysqli_connect_error());
		exit();
	}
	// /. Open database connection

	// PHP for form processing

	// While this form will only be used by members of staff, it is still best practice to complete form checks.
	// It is ALWAYS recommended to perform security checks on ALL user input whomever is entering the information.

	if (isset($_POST['addProductConfirmation'])) {

		$make 			= $_POST['make'];
		$model 			= $_POST['model'];
		$name 			= $_POST['name'];
		$price 			= $_POST['price'];
		$qtyAvailable 	= $_POST['qtyAvailable'];
		$description 	= $_POST['description'];
		$tags 			= $_POST['tags'];
		$warrantyID 	= $_POST['warrantyID'];

		$insert = "INSERT INTO `product`
				   (`make`, `model`, `name`, `price`, `qtyAvailable`, `description`, `tags`, `warrantyID`)
				   VALUES
				   ('".$make."', '".$model."', '".$name."', '".$price."', '".$qtyAvailable."', '".$description."', '".$tags."', '".$warrantyID."')";

		$result = $conn -> query($insert) or die($conn.__LINE__);

		if (!$result) {
			?>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<p class="lead">
							There was a problem entering the product details, please contact you system administrator to report the problem.
						</p>
					</div>
				</div>
			</div>
			<?php
		} else {

			$select = "SELECT `id` FROM `product` WHERE
		   	   		   `make` LIKE BINARY '".$make."' AND
					   `model` LIKE BINARY '".$model."' AND
					   `name` LIKE BINARY '".$name."' AND
					   `price` LIKE BINARY '".$price."' AND
					   `qtyAvailable` LIKE BINARY '".$qtyAvailable."' AND
					   `description` LIKE BINARY '".$description."' AND
					   `tags` LIKE BINARY '".$tags."' AND
					   `warrantyID` LIKE BINARY '".$warrantyID."'";

			$result = $conn -> query($select) or die($conn.__LINE__);

			while ($row = $result -> fetch_assoc()) {
				?>
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<p class="lead">
								Your product was entered successfully, now you can add a photo.
							</p>
							<form action="productPhotoUpload.php" method="post">
								<input id="productID" name="productID" type="text" hidden="hidden" readonly="readonly" value="<?php echo $row['id']; ?>">
								<input id="addPhoto" name="addPhoto" type="submit">
							</form>
						</div>
					</div>
				</div>
				<?php
			} // /. End of while
		}
	} // /. End of if (isset($_POST['addProduct']))

	// /. End of form processing

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Recycling Old Goods To Keep Britain Tidy">
	<meta name="author" content="Darren Howlett">

	<title>Recycling 4 U</title>

	<!-- Bootstrap Core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<style>
		body {
			padding-top: 70px;
			/* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
		}
	</style>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Site Specific CSS -->
	<link rel="stylesheet" type="text/css" href="../css/r4ustyles.css">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="../index.php">Recycling 4 U</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li>
					<a href="productGallery.php">Products</a>
				</li>
				<li>
					<a href="productUpload.php">Product Upload</a>
				</li>
				<li>
					<a href="register.php">Register</a>
				</li>
				<li>
					<a href="contact.php">Contact</a>
				</li>
				<li>
					<a href="login.php">Log In</a>
				</li>
				<li>
					<a href="profile.php">My Profile</a>
				</li>
				<li>
					<a href="logout.php">Log Out</a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>
<!-- /.nav -->

<!-- Page Content -->
<div class="container">

</div>
<!-- /.container -->

<div class="container">

	<hr>

	<!-- Footer -->
	<footer>
		<div class="row">
			<div class="col-lg-4">
				<h3>Recycling For U Policies</h3>
				<ul>
					<li><a href="#" target="_blank">Privacy Policy</a></li>
					<li><a href="#" target="_blank">Warranties policy</a></li>
				</ul>
			</div>
			<div class="col-lg-4">
				<h3>Site Map</h3>
				<ul>
					<li><a href="../index.php">Home</a></li>
					<li><a href="#">Products</a>
						<ul>
							<li><a href="#">White Goods</a>
								<ul>
									<li><a href="#">Washing Machines</a></li>
									<li><a href="#">Dishwashers</a></li>
									<li><a href="#">Fridges</a></li>
									<li><a href="#">Freezers</a></li>
									<li><a href="#">Chest Freezers</a></li>
									<li><a href="#">Fridge Freezers</a></li>
									<li><a href="#">Microwaves</a></li>
									<li><a href="#">Cookers</a></li>
								</ul>
							</li>
							<li><a href="#">Gardening Equipment</a>
								<ul>
									<li><a href="#">Lawn Mowers</a></li>
									<li><a href="#">Ride-on Mowers</a></li>
									<li><a href="#">Strimmers</a></li>
									<li><a href="#">Cultivators</a></li>
									<li><a href="#">Hedge Trimmers</a></li>
									<li><a href="#">Electric Tools</a></li>
									<li><a href="#">Manual Tools</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li><a href="contact.php">Contact Us</a></li>
					<li><a href="register.php">Register</a></li>
					<li><a href="login.php">Log In</a></li>
					<li><a href="logout.php">Log Out</a></li>
				</ul>
			</div>
			<div class="col-lg-4">
				<h3>External Sites</h3>
				<ul>
					<li><a href="https://www.gov.uk/government/publications/2010-to-2015-government-policy-waste-and-recycling/2010-to-2015-government-policy-waste-and-recycling" target="_blank">2010 to 2015 government policy: waste and recycling</a></li>
					<li><a href="http://northdevon.gov.uk/bins-and-recycling/find-a-tip/" target="_blank">North Devon District Council - Find a tip</a></li>
					<li><a href="http://northdevon.gov.uk/bins-and-recycling/" target="_blank">North Devon District Council - Bins and recycling</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<p class="text-center">Copyright &copy; Recycling 4 U <?php echo date("Y"); ?></p>
			</div>
		</div>
	</footer>

</div>
<!-- /.container -->

<!-- jQuery Version 1.11.1 -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

</body>

</html>
<?php
	// Close database connection
	mysqli_close($conn);
	// /. Close database connection
?>
