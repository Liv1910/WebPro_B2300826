<?php
require __DIR__ . '/../vendor/autoload.php';

$stripe_secret_key = "sk_test_51PcVXkJ5XeYSgkX9K5fRLGL9Rk4mFL6vC10ceDK9gV08HGgITGFePi2AcnqS1em1Yg799tLhj00ddRpsGzUmQx4K00ZGoLlQAE";
\Stripe\Stripe::setApiKey($stripe_secret_key);

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('db.php'); // Adjusted to navigate to the correct directory

    $user_id = $_SESSION['UserID'];
    $fullname = $_SESSION['FullName'];
    $loyaltynumber = $_SESSION['LoyaltyNumber'];

    $selected_salads = $_POST['salads'];
    $quantities = $_POST['quantity'];

    $line_items = [];
    $total_amount = 0; // Variable to calculate the total amount
    foreach ($selected_salads as $item_id) {
        $sql = "SELECT item_name, item_price FROM items WHERE item_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            $item_name = $row['item_name'];
            $item_price = $row['item_price'];

            $line_items[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $item_price * 100,
                    'product_data' => [
                        'name' => $item_name
                    ]
                ],
                'quantity' => $quantities[$item_id],
            ];

            $total_amount += $item_price * $quantities[$item_id];
        }
    }

    if (!empty($line_items)) {
        $checkout_session = \Stripe\Checkout\Session::create([
            'mode' => 'payment',
            'success_url' => 'http://localhost/test/customer/success.php?transaction_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://localhost/test/customer/fail.php',
            'locale' => 'auto',
            'line_items' => $line_items,
        ]);

        // Save transaction details in the database
        $transaction_id = $checkout_session->id;
        $status = $checkout_session->payment_status;
        $timestamp = date('Y-m-d H:i:s');
        $receipt_url = $checkout_session->url; // or wherever the receipt URL is stored

        $stmt = $con->prepare("INSERT INTO Orders (TransactionID, UserID, FullName, LoyaltyNumber, Currency, Amount, Status, PaymentMethod, Timestamp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $currency = 'USD';
        $payment_method = 'Stripe';
        $stmt->bind_param("sisssdsss", $transaction_id, $user_id, $fullname, $loyaltynumber, $currency, $total_amount, $status, $payment_method, $timestamp);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            http_response_code(303);
            header("Location: " . $checkout_session->url);
            exit();
        } else {
            echo "Failed to insert order into database.";
        }
    } else {
        echo "No items selected or invalid items.";
    }
} else {
    echo "Invalid request method.";
}
?>

