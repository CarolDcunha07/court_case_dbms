<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM case_history";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="casemanagement.css"> 
    <title>Court Database Management System</title>
</head>

<body>

    <header>
        <h1>Admin Dashboard - Manage Case History</h1>
    </header>

    <div id="caseManagementBox">

        <div id="caseManagement">
            <form action="" method="post">
                <ul id="caseList">
                </ul>

                <div id="filterOptions">
                <label for="caseNumber">Case Number:</label>
                    <input type="text" name="caseNumber" id="caseNumber">                    <br><br>

                    <label for="judge">Judge:</label>
                    <input type="text" name="judge" id="judge">
                    <br><br>

                    <label for="businessDate">Business Date:</label>
                    <input type="text" name="businessDate" id="businessDate"><br><br>

                    <label for="hearingDate">Hearing Date:</label>
                    <input type="text" name="hearingDate" id="hearingDate"><br><br>

                    <label for="purposeOfHearing">Purpose Of Hearing:</label>
                    <input type="text" name="purposeOfHearing" id="purposeOfHearing"><br><br>

                    

                    <button type="submit" id="searchButton">Search</button>
                </div>
            </form>

            <?php
            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Case Number</th><th>Party Name</th><th>Type</th><th>Filing Date</th><th>First Hearing Date</th><th>Status</th><th>Action</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["case_number"] . "</td>";
                    echo "<td>" . $row["judge"] . "</td>";
                    echo "<td>" . $row["business_date"] . "</td>";
                    echo "<td>" . $row["hearing_date"] . "</td>";
                    echo "<td>" . $row["purpose_of_hearing"] . "</td>";
                    echo "<td><a href='edit_hearing.php?case_number=" . $row["case_number"] . "'>Edit</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No cases found.</p>";
            }

            $conn->close();
            ?>
<br><br>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Court System. All rights reserved.</p>
    </footer>

</body>

</html>
