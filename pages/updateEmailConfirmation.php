<?php

    // Include/Required files
    require_once ('../admin/config/registeredUser.php');

    // Open database connection
    $conn = new mysqli($host, $user, $pass, $dbase);
    if (mysqli_connect_errno()) {
        printf("Database connection failed due to: %s\n", mysqli_connect_error());
        exit();
    }
    // /. Open database connection

    if (isset($_POST['submit'])) {

        $userID         = $_POST['userID'];
        $email          = $_POST['newEmail'];
        $emailConfirm   = $_POST['newEmailConfirm'];

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

        $email = mysqli_real_escape_string($conn, $email);
        $emailConfirm = mysqli_real_escape_string($conn, $emailConfirm);

        // Trim any whitespace from the beginning and end of the user input

        $email = trim($email);
        $emailConfirm = trim($emailConfirm);

        // Remove any HTML & PHP tags that may have been injected in to the input

        $email = strip_tags($email);
        $emailConfirm = strip_tags($emailConfirm);

        // Convert any tags that may have slipped through in to string data,
        // for example <b>Darren</b> becomes &lt;b&gt;Darren&lt;/b&gt;

        $email = htmlentities($email);
        $emailConfirm = htmlentities($emailConfirm);

        if (empty($email) || empty($emailConfirm)) {
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="lead">ALL fields must be filled in.</p>
                        <a href="profile.php">Back to profile page.</a>
                    </div>
                </div>
            </div>
            <?php
        } else {

            // Check email and emailComfirm match
            if ($email != $emailConfirm) {
                ?>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="lead">The emails entered DO NOT match, please try again</p>
                            <a href="profile.php">Back to profile page.</a>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="updateEmailResults.php" method="post">
                                <fieldset>
                                    <input id="userID" name="userID" type="text" value="<?php echo $userID; ?>" hidden="hidden">
                                    <label for="newEmail">New Email<br>
                                        <input id="newEmail" name="newEmail" type="text" value="<?php echo $email; ?>" readonly="readonly">
                                    </label><br><br>
                                    <p>If these details are correct, click the update my email button, if they are not
                                        correct, please <a href="profile.php">go back to and make the necessary
                                            changes.</a></p>
                                    <input id="submitConfirmation" name="submitConfirmation" type="submit" value="Update My Email">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } // /. End of emails DO NOT match

        } // /. End of empty fields

    } // /. End of if (isset($_POST['updateProfile']))
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
    <script src="../js/html5shiv.min.js"></script>
    <script src="../js/respond.min.js"></script>
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
<div class="container loginMainContent">

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
    mysqli_close($conn);
?>