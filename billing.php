<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment_method'];
    
    // Initialize variables for payment details
    $card_number = isset($_POST['card_number']) ? $_POST['card_number'] : null;
    $expiry = isset($_POST['expiry']) ? $_POST['expiry'] : null;
    $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : null;
    $contact_number = isset($_POST['contact_number']) ? $_POST['contact_number'] : null;

    // Basic form validation (you can enhance this)
    if (empty($name) || empty($email) || empty($payment_method)) {
        die("Please fill in all required fields.");
    }

    // Handle the payment processing logic
    if ($payment_method == 'card') {
        // You could connect to a payment gateway here
        echo "Processing payment with Card: " . $card_number . "<br>";
        echo "Expiry Date: " . $expiry . " CVV: " . $cvv . "<br>";
    } elseif ($payment_method == 'bikash' || $payment_method == 'nogod') {
        // Handle Mobile Payment (Bkash or Nogod)
        echo "Processing payment via $payment_method.<br>";
        echo "Contact Number: " . $contact_number . "<br>";
    } else {
        die("Invalid payment method.");
    }

    // Assuming payment was successful, save the data in the database or session
    // Database integration would happen here, for now, we'll simulate success

    echo "Payment Successful! Thank you, $name.<br>";
    // You can redirect the user to a success page or back to the billing page
    header("Location: success.php");
    exit();
}
?>
