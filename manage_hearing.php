<?php

$hearingAddedSuccessfully = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caseNumber = $_POST["caseNumber"];
    $judge = $_POST["judge"];
    $businessDate = $_POST["businessDate"];
    $hearingDate = $_POST["hearingDate"];
    $purposeOfHearing = $_POST["purposeOfHearing"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_sample_db1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO case_history (case_number, judge, business_date, hearing_date, purpose_of_hearing)
            VALUES ('$caseNumber', '$judge', '$businessDate', '$hearingDate', '$purposeOfHearing')";

    if ($conn->query($sql) === TRUE) {
        $hearingAddedSuccessfully = true; 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

echo "<style>";
echo "#searchButton { background-color: green; color: white; padding: 10px; border: none; cursor: pointer; font-size: 16px; }";
echo "#searchButton:hover { background-color: darkgreen; }";
echo "#backButton { background-color: #333; color: white; padding: 10px; border: none; cursor: pointer; font-size: 16px; margin-left: 10px; }";
echo "#backButton:hover { background-color: #555, border-radius: 1px; }";
echo "</style>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="manage_hearing.css"> 
    <title>Manage Hearings</title>
    <style>
        .success-dropdown {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            z-index: 1000;
            display: none;
        }
    </style>
</head>

<body>

    <header>
        <h1>Manage Hearings</h1>
    </header>

    <div id="hearingForm">
        <form action="manage_hearing.php" method="post">
            <label for="caseNumber">Case Number:</label>
            <input type="text" name="caseNumber" id="caseNumber" required>

            <label for="judge">Judge:</label>
            <input type="text" name="judge" id="judge" required>

            <label for="businessDate">Business Date:</label>
            <input type="date" name="businessDate" id="businessDate" required>

            <label for="hearingDate">Hearing Date:</label>
            <input type="date" name="hearingDate" id="hearingDate" required>

            <label for="purposeOfHearing">Purpose of Hearing:</label>
            <textarea name="purposeOfHearing" id="purposeOfHearing" required></textarea>

            <button type="submit">Add Hearing Details</button>

            <a href="admin_dashboard.php"><button type="button" id="backButton">Back</button></a>

        </form>
    </div>

    <div id="successMessage" style="display: <?php echo $hearingAddedSuccessfully ? 'block' : 'none'; ?>" class="success-dropdown">
        Hearing details added successfully!
    </div>

    <script>
        setTimeout(function () {
            document.getElementById('successMessage').style.display = 'none';
        }, 3000);
    </script>

    <footer>
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>

</body>

</html>
