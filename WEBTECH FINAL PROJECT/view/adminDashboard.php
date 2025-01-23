<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <style>

        body {
            background-color: #87CEEB; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            background-color: white; 
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }


        h1 {
            color: #000080; 
            font-size: 2.5em;
            margin-bottom: 40px;
            text-decoration: underline;
        }

        .card-container {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 20px;
        }


        .card {
            background-color: #4682B4; 
            color: white;
            width: 250px;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2em;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="card-container">

            <div class="card">
                <a href="userManagement.php">User Management</a>
            </div>

            <div class="card">
                <a href="adminAdManagement.php">Admin Ad Management</a>
            </div>

    
            <div class="card">
                <a href="revenueDashboard.php">Revenue Management</a>
            </div>
        </div>
    </div>
</body>
</html>
