<?php
require_once('../model/userModel.php');
 
session_start();
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['package'], $_POST['payment_method']) && !empty($_POST['package']) && !empty($_POST['payment_method'])) {
        $user_id = $_SESSION['user_id'];
 
        $package = $_POST['package'];
        $payment_method = $_POST['payment_method'];
        $prices = [
            'basic' => 50,
            'premium' => 100,
            'ultimate' => 200
        ];
 
        $amount = $prices[$package] ?? 0;
 
        if ($amount > 0) {
            $success = addAdvertisement($user_id, $package, $payment_method, $amount);
 
            if ($success) {
                $_SESSION['success_message'] = "Payment information stored successfully! Your payment is being processed.";
                header("Location: successPage.php");
                exit();
            } else {
                echo "<p>Failed to store payment information. Please try again.</p>";
            }
        } else {
            echo "<p>Invalid package selected.</p>";
        }
    } else {
        echo "<p>Please select a package and a payment method.</p>";
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
 
        .container {
            background-color: #ffffff;
            max-width: 600px;
            width: 90%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
 
        h1, h2 {
            text-align: center;
            color: #2c3e50;
        }
 
        h1 {
            margin-bottom: 10px;
        }
 
        h2 {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: normal;
        }
 
        label {
            font-size: 16px;
            color: #34495e;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }
 
        select, input[type="radio"], button {
            margin-bottom: 15px;
        }
 
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            background-color: #ffffff;
        }
 
        input[type="radio"] {
            margin-right: 10px;
        }
 
        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #3498db;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
 
        button:hover {
            background-color: #2980b9;
        }
 
        .package-details {
            margin-top: 20px;
        }
 
        p {
            font-size: 14px;
            color: #7f8c8d;
        }
 
        p strong {
            color: #2c3e50;
        }
 
        .error {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 15px;
        }
    </style>
    <script>
        function validateForm(event) {
            let packageSelect = document.getElementById('package');
            let paymentMethods = document.getElementsByName('payment_method');
            let errorMessage = document.getElementById('error-message');
            let isPaymentMethodSelected = false;
 
            if (packageSelect.value === "") {
                errorMessage.textContent = "Please select a package.";
                event.preventDefault();
                return;
            }
            for (let i = 0; i < paymentMethods.length; i++) {
                if (paymentMethods[i].checked) {
                    isPaymentMethodSelected = true;
                    break;
                }
            }
 
            if (!isPaymentMethodSelected) {
                errorMessage.textContent = "Please select a payment method.";
                event.preventDefault();
                return;
            }
 
            errorMessage.textContent = "";
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Advertise Your Business</h1>
        <h2>Choose Your Advertisement Package</h2>
 
        <form action="" method="POST" onsubmit="validateForm(event)">
            <label for="package">Select Package:</label>
            <select name="package" id="package">
                <option selected value=""></option>
                <option value="basic">Basic Package - $50</option>
                <option value="premium">Premium Package - $100</option>
                <option value="ultimate">Ultimate Package - $200</option>
            </select>
 
            <div class="package-details">
                <h3>Package Details</h3>
                <p><strong>Basic Package</strong>: $50 for 10 days</p>
                <p><strong>Premium Package</strong>: $100 for 20 days</p>
                <p><strong>Ultimate Package</strong>: $200 for 30 days</p>
            </div>
 
            <label for="payment_method">Select Payment Method:</label>
            <input type="radio" name="payment_method" value="bkash" id="bkash"> Bkash<br>
            <input type="radio" name="payment_method" value="nagad" id="nagad"> NAGAD<br>
            <input type="radio" name="payment_method" value="debit_card" id="debit_card"> Debit Card<br>
            <input type="radio" name="payment_method" value="credit_card" id="credit_card"> Credit Card<br>
 
            <p id="error-message" class="error"></p>
 
            <button type="submit">Proceed to Payment</button>
        </form>
    </div>
</body>
</html>