<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:../login.php");
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
    
	<link rel="stylesheet" href="assets/css/morris.css">
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js//raphael-min.js"></script>
	<script src="assets/js/morris.min.js"></script>

   
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                        <a  href="order.php"><i class="fa fa-truck"></i> Orders</a>
                    </li>
                    <li>
                        <a  href="customer.php"><i class="fa fa-users"></i> Customer Database </a>
                    </li>
                    <li>
                        <a class="active-menu" href="analytics.php"><i class="fa fa-bar-chart-o"></i> Analytics</a>
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
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           ANALYTICS<small> </small>
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
				 
				 
            <div class="row">
			
				<?php 
				include('db.php');
				
					
					$query = "select * from orders where status = 'Paid' ";
					$result = mysqli_query($con, $query);
					$chart_data = '';
					$tot = '0';
					while($row = mysqli_fetch_array($result))
					{
					 $chart_data .= "{ OrderID:'".$row["OrderID"]."', Price:".$row["Amount"]."}, ";
					}
					$chart_data = substr($chart_data, 0, -2);
				
?>
				 
				<br>
				<br>
				<br>
				<br><div id="chart"></div>
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>OrderID</th>
                                            <th>Amount</th>
                                            <th>Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
									<?php
										
										$sql="select * from orders where status = 'Paid' ";
										$re = mysqli_query($con,$sql);
										while($row = mysqli_fetch_array($re))
										{
										
											$id = $row['OrderID'];
											
											if($id % 2 ==1 )
											{
												echo"<tr class='gradeC'>
													<td>".$row['OrderID']."</td>
                                                    <td>".$row['Currency']."".$row['Amount']."</td>
                                                    <td>".$row['Timestamp']."</td>
													</tr>";
											}
											else
											{
												echo"<tr class='gradeU'>
													<td>".$row['OrderID']."</td>
                                                    <td>".$row['Currency']."".$row['Amount']."</td>
                                                    <td>".$row['Timestamp']."</td>
													</tr>";
											
											}
										
										}
										
									?>
                                        
                                    </tbody>
                                </table>
                                <button class = "btn btn-primary" id="printPageButton" onClick="window.print()"> <i class='fa fa-print' ></i> Print</button>
                                <style> @media print { 
                                        #printPageButton {
                                          display: none;
                                        }
                                        #main-menu {
                                            display : none;
                                        }
                                        .navbar.navbar-default.top-navbar{
                                            display : none;
                                        }
                                        .navbar-default.navbar-side{
                                            display : none;
                                        }
                                        #page-wrapper {
                                         margin-left : 0px;
                                        }
                                    }
                                </style>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
            
                </div>
               
            </div>
        
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
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
            });
    </script>
         <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    <style>
    body::-webkit-scrollbar{
    display: none;
    }
    @media (min-width:768px){
        #page-wrapper{
            width: 1863px;
        }
        .navbar.navbar-default.top-navbar{
            width: 2123px;
        }

    }
    @media (max-width:767px){
        #page-wrapper{
            width: 1863px;
        }
        .navbar.navbar-default.top-navbar{
            width: 1863px;
        }
        .navbar-default.navbar-side{
            width : 1863px !important;
        }
        #wrapper{
            width : 1863px !important; 
        }

    }
    </style>   
   
</body>
</html>
<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'OrderID',
 ykeys:['Price'],
 labels:['Price'],
 hideHover:'auto',
 stacked:true
});
</script>