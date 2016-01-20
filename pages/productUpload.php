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
		<div class="col-lg-12 text-center">
			<h1>Staff Access Only</h1>
		</div>
	</div>
	<!-- /.row -->

	<div class="row">

		<!-- Form to upload a new product to the database -->
		<!-- The form is split in to two sections, product information and tags, this is so the form can be displayed
			 in a way that on a desktop is not just one massive list of fields to be filled in.  On a mobile device
			 the form would be one continuous list, but as the form would normally be used by a member of staff while
			 on a desktop, this is a secondary issue -->
		<!-- The id attribute of the form tag is needed for a textarea.  By having an id, the textarea can be placed
			 anywhere on the web page but still be associated with the form even though it is outside of the form tags -->
		<form action="" method="post" id="productUpload" enctype="multipart/form-data">
			<div class="col-lg-4">
				<h3>Product Information</h3>
				<label for="make">Make<br>
					<input id="make" name="make" type="text">
				</label><br>
				<label for="model">Model<br>
					<input id="model" name="model" type="text">
				</label><br>
				<label for="name">Name<br>
					<input id="name" name="name" type="text">
				</label><br>
				<!-- The price form entry is type="number". This allows for only numerical entry, because the min value is set
					 to 0, only positive numbers are allowed, and because the step value is set to any, decimal numbers allowed,
					 if this was not set, only whole numbers would be accepted. -->
				<label for="price">Price<br>
					<input id="price" name="price" type="number" min="0" step="0.01">
				</label><br>
				<!-- The qty form entry is also set to number input, but this time the step value is set to 1, this means
					 that only whole numbers are accepted, increasing in value of 1 with each step i.e. 1, 2, 3 -->
				<label for="qtyAvailable">Quantity<br>
					<input id="qtyAvailable" name="qtyAvailable" type="number" min="0" step="1">
				</label><br>
				<!-- The description form entry is a text area where the user can enter a larger amount of text than a normal
					 text input would allow.  It has a form attribute which dictates which form this textarea belongs to, this
					 allows for the textarea to be placed somewhere else on the web page, but still being tied to a specific
					 form.  Spellcheck is another feature of the textarea, this will as its name implies, spell check the input
					 inside the textarea. -->
				<label for="description">Description<br>
					<textarea id="description" name="description" spellcheck="true" form="productUpload"></textarea>
				</label><br>
				<h4>Warranty</h4>
				<input id="none" name="warrantyID" type="radio" value="1"> <label for="none">None</label><br>
				<input id="three" name="warrantyID" type="radio" value="2"> <label for="three">3mths</label><br>
				<input id="six" name="warrantyID" type="radio" value="3"> <label for="six">6mths</label><br>
				<!-- Category is used for to determine which folder the photos of each product is uploaded to.
				 	 Using PHP, the name that is placed in category will be appended to the file upload location,
				 	 this will make it easier to locate files in the future, while also keeping each folder to a minimum
				 	 amount of files, instead of having one folder for all photos -->
			</div>
			<div class="col-lg-4">
				<h3>Tags</h3>
				<input id="whiteGoods" name="tags[]" type="checkbox" value="White Goods"> <label for="whiteGoods">White Goods</label><br>

				<input id="chestFreezer" name="tags[]" type="checkbox" value="Chest Freezer"> <label for="chestFreezer">Chest Freezer</label><br>
				<input id="cooker" name="tags[]" type="checkbox" value="Cooker"> <label for="cooker">Cooker</label><br>
				<input id="dishwasher" name="tags[]" type="checkbox" value="Dishwasher"> <label for="dishwasher">Dishwasher</label><br>
				<input id="freezer" name="tags[]" type="checkbox" value="Freezer"> <label for="freezer">Freezer</label><br>
				<input id="fridgeFreezer" name="tags[]" type="checkbox" value="Fridge Freezer"> <label for="fridgeFreezer">Fridge Freezer</label><br>
				<input id="fridge" name="tags[]" type="checkbox" value="Fridge"> <label for="fridge">Fridge</label><br>
				<input id="microwave" name="tags[]" type="checkbox" value="Microwave"> <label for="microwave">Microwave</label><br>
				<input id="washingMachine" name="tags[]" type="checkbox" value="Washing Machine"> <label for="washingMachine">Washing Machine</label><br>

				<input id="gardeningEquipment" name="tags[]" type="checkbox" value="Gardening Equipment"> <label for="gardeningEquipment">Gardening Equipment</label><br>

				<input id="cultivator" name="tags[]" type="checkbox" value="Cultivator"> <label for="cultivator">Cultivator</label><br>
				<input id="electricTool" name="tags[]" type="checkbox" value="Electric Tool"> <label for="electricTool">Electric Tool</label><br>
				<input id="hedgeTrimmer" name="tags[]" type="checkbox" value="Hedge Trimmer"> <label for="hedgeTrimmer">Hedge Trimmer</label><br>
				<input id="lawnMower" name="tags[]" type="checkbox" value="Lawn Mower"> <label for="lawnMower">Lawn Mower</label><br>
				<input id="manualTools" name="tags[]" type="checkbox" value="Manual Tools"> <label for="manualTools">Manual Tools</label><br>
				<input id="rideOnMower" name="tags[]" type="checkbox" value="Ride On Mower"> <label for="rideOnMower">Ride On Mower</label><br>
				<input id="strimmer" name="tags[]" type="checkbox" value="Strimmer"> <label for="strimmer">Strimmer</label><br>
			</div>
			<div class="col-lg-4">
				<h3>Photo Photo Information</h3>
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
				</label><br>
			</div>
			<div class="col-lg-12">
				<input id="submit" name="submit" type="submit">
			</div>
		</form>
		<!-- /. Form -->

	</div>
	<?php

		// PHP for form processing

		// While this form will only be used by members of staff, it is still best practice to complete form checks.
		// It is ALWAYS recommended to perform security checks on ALL user input whomever is entering the information.

		if (isset($_POST['submit'])) {

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
			$make = mysqli_real_escape_string($conn, $make);
			$model = mysqli_real_escape_string($conn, $model);
			$name = mysqli_real_escape_string($conn, $name);
			$description = mysqli_real_escape_string($conn, $description);
			$productPhotoName = mysqli_real_escape_string($conn, $productPhotoName);

			// Trim any whitespace from the beginning and end of the user input
			$make = trim($make);
			$model = trim($model);
			$name = trim($name);
			$description = trim($description);
			$productPhotoName = trim($productPhotoName);

			// Remove any HTML & PHP tags that may have been injected in to the input
			$make = strip_tags($make);
			$model = strip_tags($model);
			$name = strip_tags($name);
			$description = strip_tags($description);
			$productPhotoName = strip_tags($productPhotoName);

			// Convert any tags that may have slipped through in to string data,
			// for example <b>Darren</b> becomes &lt;b&gt;Darren&lt;/b&gt;
			$make = htmlentities($make);
			$model = htmlentities($model);
			$name = htmlentities($name);
			$description = htmlentities($description);
			$productPhotoName = htmlentities($productPhotoName);

			/* --------------------------------------------
			 * Form Checks
			-------------------------------------------- */

			// Check ALL form entries have been filled in
			if (empty($make) || empty($model) || empty($name) || empty($price) || empty($qtyAvailable) || empty($description) || empty($tags) || empty($warrantyID) || empty($productPhotoName)) {
				echo "ALL Fields must be completed";
			} else {

				$result = move_uploaded_file($tmpName, $filePath);
				if (!$result) {
					echo "Error uploading file";
					exit;
				} else {

					// Put a SQL query in to a variable
					// Because there are two insert queries being performed at the same time, a transaction is needed
					// A transaction will only perform the queries inside of it if they can all be executed, if one of the
					// queries cannot be performed, none of the queries will be executed.
					// Using transactions, not only make sure all the queries can be performed, but also if someone else
					// is trying to change the same table in the database at exactly the same time, it prevents duplication,
					// as one users actions will be performed. The other users actions will not be performed as the transaction
					// will see the table has changed and it cannot complete the queries it was supposed to apply, therefore
					// it will not perform any of the queries.

					mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

					mysqli_query($conn, "INSERT INTO `product` (`make`, `model`, `name`, `price`, `qtyAvailable`, `description`, `tags`, `warrantyID`) VALUES ('".$make."', '".$model."', '".$name."', '".$price."', '".$qtyAvailable."', '".$description."', '".$tags."', '".$warrantyID."');");

					mysqli_query($conn, "INSERT INTO `productPhoto` (`fileName`, `fileType`, `fileSize`, `fileLocation`, `productPhotoName`, `masterPhoto`) VALUES ('".$fileName."', '".$fileType."', '".$fileSize."', '".$filePath."', '".$productPhotoName."', '1');");

					mysqli_commit($conn);

					//echo $insert;


					// Perform the SQL query
					// $result = $conn -> query($insert) or die($conn.__LINE__);


				}


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
