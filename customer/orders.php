<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

include ('db.php'); // Assuming db.php contains your database connection code

$filtervalues = $_SESSION["user"];

// Fetch orders data based on LoyaltyNumber
$sql = "SELECT * FROM orders JOIN users ON orders.LoyaltyNumber = users.LoyaltyNumber WHERE users.Username = '$filtervalues'";
$result = mysqli_query($con, $sql);

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
							<li class="menu__item menu__item--current"><a href="orders.php" class="menu__link">Orders</a></li>
							<li class="menu__item "><a href="account.php" class="menu__link">Account</a></li>
							<li class="menu__item"><a href="feedback.php" class="menu__link">Feedback</a></li>
							<li class="menu__item"><a href= "logout.php" class="menu__link" >Log Out</a></li>
						</ul>
					</nav>
				</div>
			</nav>

		</div>
	</div>
<div class="clearfix"> </div>
<div class="about-wthree" id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>LoyaltyNumber</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment Method</th>
                                        <th>Timestamp</th>
                                        <th>Receipt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        $id=$row['OrderID'];
                                        $name = $row['FullName'];
                                        $loyaltynumber = $row['LoyaltyNumber'];
                                        $amount = $row['Amount'];
                                        $status = $row['Status'];
                                        $paymentmethod = $row['PaymentMethod'];
                                        $timestamp = $row['Timestamp'];

                                        echo "<tr class='gradeC'>
                                                <td>" . $name . "</td>
                                                <td>" . $loyaltynumber . "</td>
                                                <td>" . $amount . "</td>
                                                <td>" . $status . "</td>
                                                <td>" . $paymentmethod . "</td>
                                                <td>" . $timestamp . "</td>
                                                <td><a href=print.php?order_id=".$id ." <button class='btn btn-primary'> <i class='fa fa-print' ></i> Print</button></td>
                                            </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End Advanced Tables -->
            </div>
        </div>
    </div>
</div>
<div class="clearfix"> </div>
<div class="copy">
    <p>© 2014-2024 Salad Atelier | All Rights Reserved | Designed by <a href="index.php">Salad Atelier</a> </p>
</div>
<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-3.1.1.min.js"></script>
</body>
</html>
