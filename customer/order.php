<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
?>
<?php
    ob_start();    
    include('db.php');
    $filtervalues = $_SESSION['user'];
    $sql = "SELECT FullName, UserID, LoyaltyNumber FROM users WHERE Username = '$filtervalues'";
    $result = mysqli_query($con, $sql);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $_SESSION['UserID'] = $row['UserID'];
        $_SESSION['FullName'] = $row['FullName'];
        $_SESSION['LoyaltyNumber'] = $row['LoyaltyNumber'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
	<script src="https://js.stripe.com/v3/"></script>
    <link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Poppins', sans-serif;
    line-height: 1.6;
    background-color: #f9f9f9;
}

h2 {
    font-size: 2em;
    margin-bottom: 20px;
}

p {
    margin-bottom: 20px;
}

form {
    background-color: #f2f2f2;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
}

label > input[type="checkbox"] {
    margin-right: 10px;
    vertical-align: middle;
}

label > input[type="number"] {
    width: 60px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1em;
    vertical-align: middle;
}

button[type="submit"] {
    background-color: #2d4004; 
    border-color: #2d4004;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1em;
    margin-top: 10px;
}

button[type="submit"]:hover {
    background-color: #c19f5c!important;
    border-color: #c19f5c !important;
    color: black !important; 
}

</style>
</head>
<body>

<header>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h1><a class="navbar-brand" href="index.php"><img style="width: 200px;" src="../images/header_logo.png" alt=""></a></h1>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <nav class="menu menu--iris">
                    <ul class="nav navbar-nav menu__list">
                        <li class="menu__item"><a href="index.php" class="menu__link">HI, <?php echo $filtervalues;?> </a></li>
                        <li class="menu__item"><a href="orders.php" class="menu__link">Orders</a></li>
                        <li class="menu__item"><a href="account.php" class="menu__link">Account</a></li>
                        <li class="menu__item"><a href="feedback.php" class="menu__link">Feedback</a></li>
                        <li class="menu__item"><a href= "logout.php" class="menu__link" >Log Out</a></li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
</header>

<div class="container">
    <div class="banner-bottom">
        <h2>Select Your Salads and Quantity</h2>
        <form id="payment-form" action="checkout.php" method="post">
        <div>
                <?php
                // Example database connection setup
                include('db.php'); // Ensure this includes your database connection script

                // Query to fetch salad items from database
                $sql = "SELECT item_id, item_name, item_price FROM items";
                $result = mysqli_query($con, $sql);

                // Check if there are any results
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_id = $row['item_id']; // Fetching 'id' from the database
                        $item_name = $row['item_name'];
                        $item_price = $row['item_price'];

                        // Output HTML for each salad item
                        echo '<div>';
                        echo '<label>';
                        echo '<input type="checkbox" name="salads[]" value="' . $item_id . '">';
                        echo $item_name . ' - $' . $item_price;
                        echo '</label>';
                        echo '<input type="number" name="quantity[' . $item_id . ']" min="1" max="5" value="1">';
                        echo '</div>';
                        echo '<br>'; // Optional: add a line break between each salad item
                    }
                } else {
                    echo "No salad items found in the database.";
                }

                ?>
        </div>
            <!-- Additional salads can be added similarly -->

            <button id="submit-button" class="btn btn-success" type="button">Add to Cart and Pay with Stripe</button>

        </form>
    </div>
</div>

<div class="copy">
    <div class="container">
        <p>© 2014-2024 Salad Atelier | All Rights Reserved | Designed by <a href="index.php">Salad Atelier</a> </p>
    </div>
</div>

<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
<script src="../js/responsiveslides.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-3.1.1.min.js"></script>
<script>
document.getElementById('submit-button').addEventListener('click', function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);

    if (!checkedOne) {
        alert('Please select at least one salad.');
    } else {
        document.getElementById('payment-form').submit();
    }
});
</script>
</body>
</html>

