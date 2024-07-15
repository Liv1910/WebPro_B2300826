<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
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
                        <a class="active-menu" href="inventory.php"><i class="fa fa-archive"></i> Inventory</a>
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
                        <a href="profile.php"><i class="fa fa-user-circle"></i> Profile</a>
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
                        <h1 class="page-header">INVENTORY</h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <?php
                include('db.php');
                $sql = "SELECT * FROM `items` ";
                $re = mysqli_query($con, $sql)
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Price per Unit</th>
                                                <th>Update Item</th>
                                                <th>Delete Item</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($re)) {
                                               $id = $row['item_id'];
                                                if ($row['item_quantity'] < 20) {
                                                    echo "<tr class='gradeC highlight'>
                                                            <td>". $row['item_name']. "</td>
                                                            <td>". $row['item_quantity']. "</td>
                                                            <td>$". number_format($row['item_price'], 2). "</td>
                                                            <td><button onclick='GetDetail2(". $id. ", \"". $row['item_name']. "\", ". $row['item_quantity']. ", ". $row['item_price']. ");' class='btn btn-primary' data-toggle='modal' data-target='#myModal'><i class='fa fa-refresh'></i> Update</button></td>
                                                            <td><a href='deleteitem.php?item_id=". $id. "' class='btn btn-danger'><i class='fa fa-remove'></i> Delete</a></td>
                                                        </tr>";
                                                } else {
                                                    echo "<tr class='gradeU'>
                                                            <td>". $row['item_name']. "</td>
                                                            <td>". $row['item_quantity']. "</td>
                                                            <td>$". number_format($row['item_price'], 2). "</td>
                                                            <td><button onclick='GetDetail2(". $id. ", \"". $row['item_name']. "\", ". $row['item_quantity']. ", ". $row['item_price']. ");' class='btn btn-primary' data-toggle='modal' data-target='#myModal'><i class='fa fa-refresh'></i> Update</button></td>
                                                            <td><a href='deleteitem.php?item_id=". $id. "' class='btn btn-danger'><i class='fa fa-remove'></i> Delete</a></td>
                                                        </tr>";
                                                }
                                            }
                                           ?>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal1"><i class='fa fa-plus'></i> Add item</button>
                                    <button class="btn btn-danger" onClick="window.location.href = 'http://localhost/Test/staff/clear_dataset_items.php';" name="clear_items" type="submit"><i class='fa fa-trash'></i> Clear Dataset</button>
                                </div>
                            </div>
                        </div>
                        <!--End Advanced Tables -->
                        <div class="panel-body">
                            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Add New Item</h4>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Item Name</label>
                                                    <input name="item_name" type="text" class="form-control" placeholder="Enter Item Name" required>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Item Quantity</label>
                                                    <input name="item_quantity" type="text" class="form-control" placeholder="Enter Quantity" required>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Price Per. Unit</label>
                                                    <input name="item_price" type="text" class="form-control" placeholder="Enter Price Per. Unit" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" name="in" type="submit"><i class='fa fa-plus'></i> Add items</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-window-close'></i> Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['in'])) {
                            $item_name = $_POST['item_name'];
                            $item_quantity = $_POST['item_quantity'];
                            $item_price = $_POST['item_price'];
                            $newsql = "INSERT INTO items (item_name, item_quantity, item_price) values ('$item_name', '$item_quantity', '$item_price')";
                            if (mysqli_query($con, $newsql)) {
                                echo "<script>alert('Item has been Sucessfully Added.');window.location.href = 'http://localhost/Test/staff/inventory.php';</script>";
                            } else {
                                echo '<script>alert("An Unexpected Error has Occured.")</script>';
                            }
                        }

                       ?>
                        <div class="panel-body">
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Update Item Details</h4>
                                        </div>
                                        <form name="form" id="updateproducts" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Item ID</label>
                                                    <input name="item_id" id="item_id" type="text" class="form-control" readonly required>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Item Name</label>
                                                    <input name="item_name" id="item_name" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Item Quantity</label>
                                                    <input name="item_quantity" id="item_quantity" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Item Price</label>
                                                    <input name="item_price" id="item_price" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="up" class="btn btn-primary" form="updateproducts"><i class='fa fa-refresh'></i> Update Data</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-window-close'></i> Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['up'])) {
                            $item_id = $_POST['item_id'];
                            $item_name = $_POST['item_name'];
                            $item_quantity = $_POST['item_quantity'];
                            $item_price = $_POST['item_price'];
                            $upsql = "UPDATE `items` SET `item_name`='$item_name',`item_quantity`='$item_quantity', `item_price`='$item_price' WHERE item_id = '$item_id'";
                            if (mysqli_query($con, $upsql)) {
                                echo "<script>alert('Item Details has been Sucessfully Updated.');window.location.href = 'http://localhost/Test/staff/inventory.php';</script>";
                            } else {
                                echo '<script>alert("An Unexpected Error has Occured.")</script>';
                            }
                        }
                       ?>
                    </div>
                </div>
                <!-- /. ROW  -->
            </div>
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
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
            
            // Highlight rows with quantity less than 20
            $('tr').each(function () {
                var quantity = parseInt($(this).find('td:eq(1)').text());
                if (quantity < 20) {
                    $(this).addClass('highlight');
                }
            });
        });

        function GetDetail2(id, name, quantity, price) {
            document.getElementById("item_id").value = id;
            document.getElementById("item_name").value = name;
            document.getElementById("item_quantity").value = quantity;
            document.getElementById("item_price").value = price;
        }
    </script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
</body>
</html>