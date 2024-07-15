<?php
$id = $_REQUEST['order_id'];
$con = mysqli_connect("localhost", "root", "", "teslawebsite");
if ($id !== "") {
	$query = mysqli_query($con, "SELECT order_id, order_status FROM orders WHERE order_id ='$id' ");
	$row = mysqli_fetch_array($query);
	$order_id = $row["order_id"];
	$order_status = $row["order_status"];
}
$result = array("$order_id","$order_status");
$myJSON = json_encode($result);
echo $myJSON;
?>
