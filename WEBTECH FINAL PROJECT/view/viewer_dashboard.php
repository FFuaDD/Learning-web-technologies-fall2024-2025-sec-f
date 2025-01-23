<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viewer Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d9f1ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dashboard-container {
            background-color: white;
            width: 80%;
            max-width: 900px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .dashboard-container h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }
        .dashboard-buttons {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .dashboard-button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            margin: 10px;
            width: 250px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .dashboard-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Viewer Dashboard</h1>
        <div class="dashboard-buttons">
            <a href="viewerAdManagement.php" class="dashboard-button">Viewer Ads</a>
         
        </div>
    </div>
</body>
</html>