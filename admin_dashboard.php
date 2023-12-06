<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_dashboard.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            padding-bottom: 70px; 
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
        }

        #adminOptions {
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #adminOptions a {
            display: block;
            text-decoration: none;
            color: #333;
            background-color: #e0e0e0;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        #adminOptions a:hover {
            background-color: #ccc;
        }

        #backButton {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        #backButton:hover {
            background-color: #45a049;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
    <title>Admin Dashboard</title>
</head>

<body>

    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <div id="adminOptions">
        <a href="manage_cases.php">Manage Cases</a>
        <a href="add_case.php">Add New Case</a>
        <a href="delete_case.php">Delete Case</a>
        <a href="manage_hearing.php">Add Hearing Details</a>
        <a href="manage_articles.php">Manage Articles</a>
        <a href="edit_hearing.php">Edit Hearing Details</a>
        <a href="edit_articles.php">Edit Articles</a>
    </div>

    <button id="backButton" onclick="window.location.href='login.php'">Back to Login</button>


    <footer>
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>

</body>

</html>
