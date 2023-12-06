<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Case</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em 0;
        }

        #deleteCaseForm {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
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
            padding: 1em 0;
            background-color: #333;
            color: white;
        }
    </style>
</head>

<body>

    <header>
        <h1>Delete Case</h1>
    </header>

    <div id="deleteCaseForm">
        <form action="delete_case.php" method="GET">
            <label for="caseNumber">Enter Case Number:</label>
            <input type="text" id="caseNumber" name="case_number" required>
            <button type="submit">Delete Case</button>
        </form>

        <?php
        if (isset($_GET['case_number'])) {
            $case_number = $_GET['case_number'];

            $host = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'login_sample_db1';

            $conn = mysqli_connect($host, $username, $password, $database);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "DELETE FROM cases WHERE case_number = '$case_number'";

            if (mysqli_query($conn, $sql)) {
                echo "<p>Case with Case Number $case_number deleted successfully.</p>";
            } else {
                echo "<p>Error deleting case: " . mysqli_error($conn) . "</p>";
            }

            mysqli_close($conn);
        }
        ?>
    </div>

    <button id="backButton" onclick="window.location.href='admin_dashboard.php'">Back to Admin Dashboard</button>

    <footer>
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>

</body>

</html>
