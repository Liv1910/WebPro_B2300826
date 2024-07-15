<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:../login.php");
    exit; // Ensure to exit after header redirect
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Salad Atelier Int.</title>
    <link rel="icon" href="../images/title_logo.png" type="image/icon type">
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <style>
        body::-webkit-scrollbar {
            display: none;
        }
        @media (min-width:768px) and (max-width:986px) {
            .panel.panel-default {
                width: 647px;
            }
            .navbar.navbar-default.top-navbar {
                width: 980px;
            }
            #page-wrapper {
                width: 720px;
            }
        }
        .highlight {
            background-color: #ffc2c2;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="order.php"><img src="../images/header_logo.png" width="150"></a>
            </div>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="inventory.php"><i class="fa fa-archive"></i> Inventory</a>
                    </li>
                    <li>
                        <a href="order.php"><i class="fa fa-truck"></i> Orders</a>
                    </li>
                    <li>
                        <a href="customer.php"><i class="fa fa-users"></i> Customer Database </a>
                    </li>
                    <li>
                        <a href="analytics.php"><i class="fa fa-bar-chart-o"></i> Analytics</a>
                    </li>
                    <li>
                        <a href="feedbacks.php"><i class="fa fa-comments"></i> Feedbacks</a>
                    </li>
                    <li>
                        <a class="active-menu" href="profile.php"><i class="fa fa-user-circle"></i> Profile</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">PROFILE DETAILS</h1>
                    </div>
                </div>
                <!-- /. ROW  -->
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
                <!-- /. ROW  -->
            </div>
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- Modal -->
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
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
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
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
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
        echo "<script>alert('Profile Details have been successfully updated.'); window.location.href = 'profile.php';</script>";
    } else {
        echo "<script>alert('An unexpected error occurred.');</script>";
    }
}
?>

