<?php
session_start(); // Start session

include_once "db.php"; // Include your database connection script

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
    exit(); // Stop further execution
}

$filtervalues = $_SESSION['user'];
$sql = "SELECT FullName, UserID, LoyaltyNumber FROM users WHERE Username = '$filtervalues'";
$result = mysqli_query($con, $sql);

if ($result) {
    if ($row = mysqli_fetch_assoc($result)) {
        $fullname = $row['FullName'];
        $userid = $row['UserID'];
        $loyaltynumber = $row['LoyaltyNumber'];

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-feedback'])) {
            $rating = $_POST['rating'];
            $message = $_POST['message'];

            $insert_sql = "INSERT INTO feedback (UserID, FullName, LoyaltyNumber, Rating, Message, Submission)
                           VALUES ('$userid', '$fullname', '$loyaltynumber', '$rating', '$message', NOW())";

            if (mysqli_query($con, $insert_sql)) {
				echo "<script>alert('Feedback submitted successfully.');</script>";
            } else {
                echo "<script>alert('An unexpected error occured.');</script>";
            }

        }
    } 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Salad Atelier</title>
<link rel="icon" href="../images/title_logo.png" type="image/icon type">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="../css/chocolat.css" type="text/css" media="screen">
<link href="../css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="../css/flexslider.css" type="text/css" media="screen" property="" />
<link rel="stylesheet" href="../css/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>
	<div class="w3_navigation">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><a class="navbar-brand" href="index.php"><img style = "width: 200px;" src="../images/header_logo.png" alt=""></a></h1>
				</div>
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav class="menu menu--iris">
						<ul class="nav navbar-nav menu__list">
							<li class="menu__item "><a href="index.php" class="menu__link">HI, <?php echo $filtervalues;?> </a></li>
							<li class="menu__item"><a href="orders.php" class="menu__link">Orders</a></li>
							<li class="menu__item"><a href="account.php" class="menu__link">Account</a></li>
							<li class="menu__item menu__item--current"><a href="feedback.php" class="menu__link">Feedback</a></li>
							<li class="menu__item"><a href= "logout.php" class="menu__link" >Log Out</a></li>
						</ul>
					</nav>
				</div>
			</nav>

		</div>
	</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"></div>
<div id="availability-agileits">

<div class="clearfix"> </div>
</div>
	<div class="banner-bottom">
	<div class="container">
    <div class="feedback-form" style="margin-top: 30px;margin-bottom: 50px;">
        <h2 style="font-family: 'Poppins', sans-serif; margin-bottom: 20px;">Feedback Form</h2>
        <form action="feedback.php" method="post">
            <div class="form-group">
                <label for="rating" style="font-family: 'Poppins', sans-serif;">Rating:</label><br>
                <label class="radio-inline">
                    <input type="radio" name="rating" value="1" required> 1
                </label>
                <label class="radio-inline">
                    <input type="radio" name="rating" value="2"> 2
                </label>
                <label class="radio-inline">
                    <input type="radio" name="rating" value="3"> 3
                </label>
                <label class="radio-inline">
                    <input type="radio" name="rating" value="4"> 4
                </label>
                <label class="radio-inline">
                    <input type="radio" name="rating" value="5"> 5
                </label>
            </div>
			<span>
            <div class="form-group">
                <label for="message" style="font-family: 'Poppins', sans-serif;margin-top:5px;margin-bottom:5px;">Your Feedback:</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Please fill your feedback here"  required></textarea>
            </div>
            <button type="submit" name="submit-feedback" class="btn btn-success" style="margin-top:10px;background-color: #2d4004; border-color: #2d4004;">Submit Feedback</button>
			<button type="button" class="btn btn-success" style="margin-top:10px;background-color: #2d4004; border-color: #2d4004;" onclick="resetForm()">Reset Form</button>
		</form>
    </div>
</div>

	</div>
</div>
			<div class="copy">
		        <p>© 2014-2024 Salad Atelier | All Rights Reserved | Designed by <a href="index.php">Salad Atelier</a> </p>
		    </div>
<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-3.1.1.min.js"></script>
<script>
        function validateForm() {
            var rating = document.querySelector('input[name="rating"]:checked');
            var message = document.getElementById('message').value;

            if (!rating) {
                alert('Please select a rating.');
                return false;
            }

            if (message.trim() === '') {
                alert('Please fill in your feedback.');
                return false;
            }

            return true;
        }

		function resetForm() {
            document.getElementById("message").value = ""; // Reset textarea value
            var radioButtons = document.querySelectorAll('input[name="rating"]');
            radioButtons.forEach(function(radioButton) {
                radioButton.checked = false; // Uncheck all radio buttons
            });
        }
</script>

<style>
.btn-success:hover {
    background-color: #c19f5c!important;
    border-color: #c19f5c !important;
    color: black !important; /* Ensures text color is visible on yellow background */
}
</style>
</body>
</html>