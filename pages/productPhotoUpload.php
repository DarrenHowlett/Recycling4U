<?php

session_start();
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
	$warrantyID 	= $_POST['warrantyID']; // Returns the value of the radio button, not what is displayed to the user

	$tags = implode(", ", $_POST['tags']); // By imploding the contents of the array, this turns
	// the array data into string data which is then used
	// to insert in to the database

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

	// Check ALL form entries have been filled in
	if (empty($make) || empty($model) || empty($name) || empty($price) || empty($qtyAvailable) || empty($description) || empty($tags) || empty($warrantyID)) {
		echo "ALL Fields must be completed";
	} else {

		// Put a SQL query in to a variable
		$insert = "INSERT INTO `product`
							   (`make`, `model`, `name`, `price`, `qtyAvailable`, `description`, `tags`, `warrantyID`)
							   VALUES
							   ('".$make."', '".$model."', '".$name."', '".$price."', '".$qtyAvailable."', '".$description."', '".$tags."', '".$warrantyID."')";

		// Perform the SQL query
		$insertResult = $conn -> query($insert) or die($conn.__LINE__);

	} // /. End of query

	$select = "SELECT `id` FROM `product` WHERE
		   `make` LIKE BINARY '".$make."' AND
		   `model` LIKE BINARY '".$model."' AND
		   `name` LIKE BINARY '".$name."' AND
		   `price` LIKE BINARY '".$price."' AND
		   `qtyAvailable` LIKE BINARY '".$qtyAvailable."' AND
		   `description` LIKE BINARY '".$description."' AND
		   `tags` LIKE BINARY '".$tags."' AND
		   `warrantyID` LIKE BINARY '".$warrantyID."'";

	$selectResult = $conn -> query($select) or die($conn.__LINE__);

	while ($row = $selectResult -> fetch_assoc()) {
		$productID = $row['id'];

	} // /. End Of ProductID While

} // /. End of if (isset($_POST['submit']))


// /.PHP for form processing

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
					<a href="products.php">Products</a>
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

	<div class="row">

		<!-- Add Product Photo Form -->
		<form action="" method="post" id="productUpload" enctype="multipart/form-data">
			<div class="col-lg-12">
				<h3>Product Photo Information</h3>
				<h4>Photo To Upload</h4>
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
				<input name="userfile" type="file" id="userfile">
				<h4>File Name</h4>
				<label for="productPhotoName">
					<input id="productPhotoName" name="productPhotoName" type="text">
				</label><br>
				<h4>Directory To Upload To</h4>
				<label for="folderName">Folder Name<br>
					<select id="folderName" name="folderName">
						<option value="chestFreezer">Chest Freezer</option>
						<option value="cooker">Cooker</option>
						<option value="dishwasher">Dishwasher</option>
						<option value="freezer">Freezer</option>
						<option value="fridgeFreezer">Fridge Freezer</option>
						<option value="fridge">Fridge</option>
						<option value="microwave">Microwave</option>
						<option value="washingMachine">Washing Machine</option>
						<option value="cultivator">Cultivator</option>
						<option value="elctricTool">Electric Tool</option>
						<option value="hedgeTrimmer">Hedge Trimmer</option>
						<option value="lawnMower">Lawn Mower</option>
						<option value="manualTool">Manual Tool</option>
						<option value="rideOnMower">Ride On Mower</option>
						<option value="strimmer">Strimmer</option>
					</select>
				</label><br><br>
			</div>
			<div class="col-lg-12">
				<input id="submit" name="submit" type="submit" value="Submit Product">
			</div>
		</form>
		<!-- /. Form -->

	</div>
	<?php

	echo $insert;

	// PHP for form processing

	// While this form will only be used by members of staff, it is still best practice to complete form checks.
	// It is ALWAYS recommended to perform security checks on ALL user input whomever is entering the information.

	if (isset($_POST['submit'])) {

		/* --------------------------------------------
         * Variables From File Information
        -------------------------------------------- */

		$fileName 			= $_FILES['userfile']['name'];
		$tmpName 			= $_FILES['userfile']['tmp_name'];
		$fileSize 			= $_FILES['userfile']['size'];
		$fileType 			= $_FILES['userfile']['type'];
		$productPhotoName 	= $_POST['productPhotoName'];
		$folderName 		= $_POST['folderName']; // Returns the value of the dropdown option, not what is
		// displayed to the user

		// This determines where the file is to be uploaded
		$uploadDir = '../pics/products/'.$folderName.'/';

		$fileName = addslashes($fileName);
		$filePath = addslashes($filePath);

		// This variable takes the path of the directory to which the file is to be uploaded to
		// and appends the file name to that directory, this is what is uploaded to the database,
		// the file itself will be uploaded and stored wherever the path pointed to.
		$filePath = $uploadDir . $fileName;

		/* --------------------------------------------
         * User Input From Form Validation
        -------------------------------------------- */

		// SQL INJECTION COUNTERMEASURES
		// This only has to apply to fields that allow users to type string data in, fields that
		// have dropdown boxes, checkboxes, radio buttons etc or are restricted to number input need not be put through sanitation.
		// The reason inputs restricted to number input do not have to be put through sanitation is, even though the input
		// will allow for text to be entered in to the input box, any text that is entered will not actually be returned.

		// Escape any special characters, for example O'Conner becomes O\'Conner
		// The first parameter of mysqli_real_escape_string is the database connection to open,
		// The second parameter is the string to have the special characters escaped.
		$productPhotoName = mysqli_real_escape_string($conn, $productPhotoName);

		// Trim any whitespace from the beginning and end of the user input
		$productPhotoName = trim($productPhotoName);

		// Remove any HTML & PHP tags that may have been injected in to the input
		$productPhotoName = strip_tags($productPhotoName);

		// Convert any tags that may have slipped through in to string data,
		// for example <b>Darren</b> becomes &lt;b&gt;Darren&lt;/b&gt;
		$productPhotoName = htmlentities($productPhotoName);

		/* --------------------------------------------
         * Form Checks
        -------------------------------------------- */

		// Check ALL form entries have been filled in
		if (empty($productPhotoName)) {
			echo "ALL Fields must be completed";
		} else {

			$result = move_uploaded_file($tmpName, $filePath);
			if (!$result) {
				echo "Error uploading file";
				exit;
			} else {

				// Put a SQL query in to a variable
				$insert = "INSERT INTO `productPhoto`
						   (`fileName`, `fileType`, `fileSize`, `fileLocation`, `productPhotoName`, `masterPhoto`, `productID`)
						   VALUES
						   ('".$fileName."', '".$fileType."', '".$fileSize."', '".$filePath."', '".$productPhotoName."', '1', '".$productID."')";

				// Perform the SQL query
				$result = $conn -> query($insert) or die($conn.__LINE__);

				echo "Product ID Is = ".$productID."<br>";
				echo "Insert = ".$insert."<br>";


			} // /. End of move_uploaded_file error

		} // /. End of query

	} // /. End of if (isset($_POST['submit']))

	// /.PHP for form processing

	?>
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
