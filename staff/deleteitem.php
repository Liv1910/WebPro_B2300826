<?php
    ob_start();	
    include ('db.php');
    $pid = $_GET['item_id'];
    $sql = "DELETE FROM items WHERE item_id = '$pid'";
    
    if (mysqli_query($con, $sql)) {	
        echo "<script>alert('Item has been Successfully Removed.');window.location.href = 'http://localhost/Test/staff/inventory.php';</script>";
    } else {
        echo '<script>alert("An Unexpected Error has Occured.")</script>';
    }
?>

