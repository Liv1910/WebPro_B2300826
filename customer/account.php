<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
?>
<?php
	ob_start();	
	include ('db.php');
	$filtervalues = $_SESSION["user"];
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
							<li class="menu__item menu__item--current"><a href="account.php" class="menu__link">Account</a></li>
							<li class="menu__item"><a href="feedback.php" class="menu__link">Feedback</a></li>
							<li class="menu__item"><a href= "logout.php" class="menu__link" >Log Out</a></li>
						</ul>
					</nav>
				</div>
			</nav>

		</div>
	</div>
			<div class="clearfix"> </div>
</div>
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
                                                <th>Full Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Update Information</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include('db.php');
                                            $filtervalues = $_SESSION["user"];
                                            $sql = "SELECT * FROM users WHERE CONCAT(FullName, Username, Email, Password) LIKE '%$filtervalues%'";
                                            $re = mysqli_query($con, $sql);
                                            while ($row = mysqli_fetch_array($re)) {
                                                $name = $row['FullName'];
                                                $username = $row['Username'];
                                                $email = $row['Email'];
                                                // Masked value for Password field
                                                $password = "******"; // Replace with your masking logic if needed
                                                $id = $row['UserID'];

                                                echo "<tr class='gradeC'>
                                                        <td>" . $name . "</td>
                                                        <td>" . $username . "</td>
                                                        <td>" . $email . "</td>
                                                        <td>" . $password . "</td>
                                                        <td><button onclick='GetDetail3(\"$name\", \"$username\", \"$email\", \"$password\");' class='btn btn-primary btn' data-toggle='modal' data-target='#myModal'><i class='fa fa-refresh'></i> Update</button></td>
                                                    </tr>";
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Update Profile Details</h4>
                </div>
                <form name="updateForm" id="updateForm" method="post" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input name="FullName" id="FullName" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input name="Username" id="Username" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="Email" id="Email" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="Password" id="Password" type="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="up" class="btn btn-primary"><i class='fa fa-refresh'></i> Update Data</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-window-close'></i> Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
		  </div>
		   	<div class="clearfix"> </div>
    </div>
			<div class="copy">
		        <p>© 2014-2024 Salad Atelier | All Rights Reserved | Designed by <a href="index.php">Salad Atelier</a> </p>
		    </div>
<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-3.1.1.min.js"></script>
<script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });

        function GetDetail3(FullName, Username, Email, Password) {
            document.getElementById("FullName").value = FullName;
            document.getElementById("Username").value = Username;
            document.getElementById("Email").value = Email;
            document.getElementById("Password").value = Password;
        }
    </script>
</body>
</html>
<?php
if (isset($_POST['up'])) {
    $FullName = $_POST['FullName'];
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Password = hash('sha256', $_POST['Password']); // Hashing the password with SHA-256

    // Ensure $con is your database connection
    $upsql = "UPDATE users SET FullName='$FullName', Username='$Username', Email='$Email', Password='$Password' WHERE UserID = '$id'";
    
    if (mysqli_query($con, $upsql)) {
        echo "<script>alert('Profile Details have been Successfully Updated.'); window.location.href = 'account.php';</script>";
    } else {
        echo "<script>alert('An unexpected error occurred.');</script>";
    }
}
?>


