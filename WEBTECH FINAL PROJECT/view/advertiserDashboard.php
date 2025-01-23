<!DOCTYPE html>
<html lang="en">
<head>
    <title>Advertiser Dashboard</title>
    <style>
        body {
            background-color: #87CEEB; /* Sky blue background */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: white; /* White padding area */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            text-decoration: underline; /* Underline Admin Dashboard */
        }

        .card-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background-color: #4682B4; /* Blue background for buttons */
            color: white;
            padding: 50px;
            border-radius: 10px;
            width: 250px; /* Fixed width for the cards */
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Advertiser Dashboard</h1>

        <div class="card-container">
            <!-- Advertiser Ad Management -->
            <div class="card">
                <a href="advertiserAdManagement.php">Advertiser Ad Management</a>
            </div>

            <!-- User Activity Log -->
            <div class="card">
                <a href="favourites.php">Ad Favourites</a>
            </div>

            <!-- Notifications -->
            <div class="card">
                <a href="advertiserNotifications.php">Notifications</a>
            </div>
        </div>
    </div>
</body>
</html>
