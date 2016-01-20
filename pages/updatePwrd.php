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

    if (isset($_POST['updateProfile'])) {

        $email = $_POST['email'];
        $pwrd = $_POST['pwrd'];

        $select = "SELECT * FROM `user` WHERE `email` LIKE BINARY '".$email."' AND `password` LIKE BINARY '".$pwrd."'";
        $result = $conn -> query($select) or die($conn.__LINE__);

        while ($row = $result -> fetch_assoc()) {
        ?>

        <div class="container">
        <div class="row">
        <div class="col-lg-12">
            <h1>Update Profile</h1>
            <p class="lead">Please use the form below to make any changes to the information we have on record for you.  To change your email address and password please fill in both the email/password and confrim email/password boxes.</p>
        </div>

        <div class="col-lg-12">
            <form action="updateProfileConfirmation.php" method="post">
                <fieldset>
                    <input id="userID" name="userID" hidden="hidden" value="<?php echo $row['id']; ?>">
                    <input id="oldEmail" name="oldEmail" hidden="hidden" value="<?php echo $email; ?>">
                    <input id="oldPwrd" name="oldPwrd" hidden="hidden" value="<?php echo $pwrd; ?>">
                    <label for="title">Title<br>
                        <input id="title" name="title" type="text" value="<?php echo $row['title']; ?>">
                    </label><br>
                    <label for="forename">Forename<br>
                        <input id="forename" name="forename" type="text" value="<?php echo $row['forename']; ?>">
                    </label><br>
                    <label for="surname">Surname<br>
                        <input id="surname" name="surname" type="text" value="<?php echo $row['surname']; ?>">
                    </label><br>
                    <label for="firstLineAddress">1st Line Address<br>
                        <input id="firstLineAddress" name="firstLineAddress" type="text" value="<?php echo $row['firstLineAddress']; ?>">
                    </label><br>
                    <label for="secondLineAddress">2nd Line Address<br>
                        <input id="secondLineAddress" name="secondLineAddress" type="text" value="<?php echo $row['secondLineAddress']; ?>">
                    </label><br>
                    <label for="town">Town<br>
                        <input id="town" name="town" type="text" value="<?php echo $row['town']; ?>">
                    </label><br>
                    <label for="county">County<br>
                        <input id="county" name="county" type="text" value="<?php echo $row['county']; ?>">
                    </label><br>
                    <label for="postcode">Postcode<br>
                        <input id="postcode" name="postcode" type="text" value="<?php echo $row['postcode']; ?>">
                    </label><br>
                    <label for="phone">Phone<br>
                        <input id="phone" name="phone" type="tel" value="<?php echo $row['phone']; ?>">
                    </label><br><br>
                    <input id="submit" name="submit" type="submit" value="Update My Profile">
                </fieldset>
            </form>

        </div>
        </div>

        <?php

        } // /. End of while

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