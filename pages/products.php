<?php

	// Include/Required files
	/*
	 * Any files that are external to this page of the web site, but are needed for the web page
	 * so it can display its content will be placed here.  Information that is sensitive, i.e. configuration
	 * details, should be kept in a separate file to aid in security of information.  That page is then
	 * required/included here.
	 *
	 * Include and require both have two states:
	 * Require and require_once
	 * Include and include_once
	 *
	 * A file that is needed for the web page to perform should always be included using require.  This tells
	 * the web page that this file is definitely needed so it can continue.  Files that contain configuration
	 * details for example, should always be included using require.
	 *
	 * A file that maybe needed for the web page to perform its duties should be included using include.
	 * Files that contain information that maybe needed depending on a users actions should always be
	 * included using include.
	 *
	 * As a web site usually contains more than one web page, many pages will have require and include files.
	 * Also some web pages will be inside other web pages.  Because of this a web page could end up having
	 * a lot of files that are required and/or included.  If a web page includes another page that also
	 * requires and/or includes the same files the browser will get those files for each of the pages.
	 * By using require_once and include_once, if a page needs the same resources as the page it is inside
	 * the resources are only collected once, thus saving on page load times and bandwidth.
	 */
	require_once ('../admin/config/normalUser.php');
	// /. Include/Required files

	// Open database connection
	/*
	 * To be able to use any information held in a database, a connection to that database is first needed so the page
	 * can access it.  As a connection requires sensitive information regarding user names and passwords, it is best
	 * practice to have these details stored in a different file and then include the file containing those details in
	 * this file so they can be referenced to in this file.  This is demonstrated here by having the normalUser.php file
	 * included using require_once above, and the variables within that file are referenced in the $conn variable below.
	 *
	 * If the credentials are correct, a connection to the database and the tables within it is opened.
	 */
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
		<div class="col-lg-12 text-center">
			<h1>Success!!!</h1>
		</div>
	</div>
	<!-- /.row -->

	<!-- This is the code for one shop item, but as PHP will be used, this will be the template for each item in the database.
		 Each item will be placed in this template by using a while loop.  Each item could be hard coded using HTML, but the
		 Downside is that if a new item is added/taken away the code has to be changed, whereas using the while loop in PHP,
		 Each time an item is added/taken away from the database, it will automatically update on the web site. -->
	<div class="row">
		<div class="col-sm-4 col-lg-4 col-md-4">
			<div class="thumbnail">
				<!-- Thumbnail/Photo of product -->
				<img src="http://placehold.it/320x150" alt="">
				<div class="caption">
					<!-- Price -->
					<h4 class="pull-right">$00.00</h4>
					<!-- Name of product/Link to expanded product page -->
					<h4><a href="#">Link To Products Page</a>
					</h4>
					<!-- Information snippet on the product -->
					<p>A small piece of info on the product</p>
				</div>
			</div>
		</div>
	</div>

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
	/*
	 * It ia always best to close any open connections to a database at the end of every web page, the reasoning is
	 * that, when a user leaves the web site/page, if the connection is left open, it can lead to the database vulnerable
	 * to attack.
	 */
	mysqli_close($conn);
	// /. Close database connection
?>
