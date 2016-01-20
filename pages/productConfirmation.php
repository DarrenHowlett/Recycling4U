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

	if (isset($_POST['addProduct'])) {

		/* --------------------------------------------
		 * Variables From User Input
		-------------------------------------------- */

		$make 			= $_POST['make'];
		$model 			= $_POST['model'];
		$name 			= $_POST['name'];
		$price 			= $_POST['price'];
		$qtyAvailable 	= $_POST['qtyAvailable'];
		$description 	= $_POST['description'];
		$tags 			= $_POST['tags']; // Returns the value of the checkbox, not what is displayed to the user. This is then
		// Placed in to an array as the name of the checkboxes in the tag list  is tags[]
		$warrantyID 	= $_POST['warrantyID']; // Returns the value of the radio button, not what is displayed to the user.
		// The value of the radio button is the Primary Key from the Warranty table
		// in the database and will be inserted in to the Product table as a Foreign Key.

		$tags = implode(", ", $_POST['tags']); // By imploding the contents of the array, this turns the array data into string
		// data which is then used to insert in to the database.
		// Although the tags have now been made in to string data, there is no need
		// to sanitize them as the input came from checkboxes and it is the PHP
		// that has turned the data in to string data, not user input.

		// SQL INJECTION COUNTERMEASURES
		// This only has to apply to fields that allow users to type string data in, fields that
		// have dropdown boxes, checkboxes, radio buttons etc or are restricted to number input need not be put through sanitation.
		// The reason inputs restricted to number input do not have to be put through sanitation is, even though the input
		// will allow for text to be entered in to the input box, any text that is entered will not actually be returned.

		// Escape any special characters, for example O'Conner becomes O\'Conner
		// The first parameter of mysqli_real_escape_string is the database connection to open,
		// The second parameter is the string to have the special characters escaped.
		$make = mysqli_real_escape_string($conn, $make);
		$model = mysqli_real_escape_string($conn, $model);
		$name = mysqli_real_escape_string($conn, $name);
		$description = mysqli_real_escape_string($conn, $description);

		// Trim any whitespace from the beginning and end of the user input
		$make = trim($make);
		$model = trim($model);
		$name = trim($name);
		$description = trim($description);

		// Remove any HTML & PHP tags that may have been injected in to the input
		$make = strip_tags($make);
		$model = strip_tags($model);
		$name = strip_tags($name);
		$description = strip_tags($description);

		// Convert any tags that may have slipped through in to string data,
		// for example <b>Darren</b> becomes &lt;b&gt;Darren&lt;/b&gt;
		$make = htmlentities($make);
		$model = htmlentities($model);
		$name = htmlentities($name);
		$description = htmlentities($description);

		/* --------------------------------------------
		 * Form Checks
		-------------------------------------------- */

		if (empty($make) || empty($model) || empty($name) || empty($price) || empty($qtyAvailable) || empty($description) || empty($tags) || empty($warrantyID)) {
			echo "ALL Fields must be completed";
		} else {
			?>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<p class="lead">Please confirm these are the product details you wish to enter. Once the product has been confirmed, you will then be able to add a photo.  If these details are incorrect <a href="productUpload.php">please go back to the Product Upload page</a> and start agaian.</p>
						<form action="productConfirmationResults.php" method="post" id="productUpload">
							<div class="col-lg-6">
								<h3>Product Information</h3>
								<label for="make">Make<br>
									<input id="make" name="make" type="text" value="<?php echo $make; ?>" readonly="readonly">
								</label><br>
								<label for="model">Model<br>
									<input id="model" name="model" type="text" value="<?php echo $model; ?>" readonly="readonly">
								</label><br>
								<label for="name">Name<br>
									<input id="name" name="name" type="text" value="<?php echo $name; ?>" readonly="readonly">
								</label><br>
								<!-- The price form entry is type="number". This allows for only numerical entry, because the min value is set
									 to 0, only positive numbers are allowed, and because the step value is set to any, decimal numbers allowed,
									 if this was not set, only whole numbers would be accepted. -->
								<label for="price">Price<br>
									<input id="price" name="price" type="number" value="<?php echo $price; ?>" readonly="readonly">
								</label><br>
								<!-- The qty form entry is also set to number input, but this time the step value is set to 1, this means
									 that only whole numbers are accepted, increasing in value of 1 with each step i.e. 1, 2, 3 -->
								<label for="qtyAvailable">Quantity<br>
									<input id="qtyAvailable" name="qtyAvailable" value="<?php echo $qtyAvailable; ?>" readonly="readonly">
								</label><br>
								<!-- The description form entry is a text area where the user can enter a larger amount of text than a normal
									 text input would allow.  It has a form attribute which dictates which form this textarea belongs to, this
									 allows for the textarea to be placed somewhere else on the web page, but still being tied to a specific
									 form.  Spellcheck is another feature of the textarea, this will as its name implies, spell check the input
									 inside the textarea. -->
								<label for="description">Description<br>
									<input id="description" name="description" value="<?php echo $description; ?>" readonly="readonly">
								</label><br>
								<h4>Warranty</h4>
								<label for="warrantyID">
									<input id="warrantyID" name="warrantyID" type="text" value="<?php echo $warrantyID; ?>" readonly="readonly">
								</label><br>
								<ul class="bulletNone">
									<li>1 = 0mths (Sold As Seen)</li>
									<li>2 = 3mths</li>
									<li>3 = 6mths</li>
								</ul>
							</div>
							<div class="col-lg-6">
								<h3>Tags</h3>
								<label for="tags">
									<input id="tags" name="tags" type="text" value="<?php echo $tags; ?>" readonly="readonly">
								</label><br>
							</div>
							<div class="col-lg-12">
								<br><input id="addProductConfirmation" name="addProductConfirmation" type="submit" value="Add Product Confirmation">
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php
		} // End of empty fields

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
