<?php
session_start();
include_once "db.php";

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['user']; // Assuming 'user' holds the username

// Retrieve LoyaltyNumber for the user
$sql = "SELECT LoyaltyNumber FROM users WHERE Username = '$username'";
$result = mysqli_query($con, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $loyaltyNumber = $row['LoyaltyNumber'];
} else {
    // Handle error fetching LoyaltyNumber
    die("Error fetching LoyaltyNumber: " . mysqli_error($con));
}

// Check if transaction_id is set
if (!isset($_GET['transaction_id'])) {
    die("Transaction ID not provided.");
}

$transaction_id = $_GET['transaction_id'];

// Update payment status
$update_sql = "UPDATE orders SET Status = 'Paid' WHERE TransactionID = '$transaction_id'";
if (mysqli_query($con, $update_sql)) {
    echo "<script>alert('Payment Successful!');window.location.href = 'http://localhost/Test/customer/index.php';</script>";
    exit();
} else {
    echo "<script>alert('An unexpected error has occured!');window.location.href = 'http://localhost/Test/customer/index.php';</script>";
    exit();
}

mysqli_close($con);
?>


