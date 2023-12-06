<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<style>";
echo "#searchButton { background-color: green; color: white; padding: 10px; border: none; cursor: pointer; font-size: 16px; }";
echo "#searchButton:hover { background-color: darkgreen; }";
echo "#backButton { background-color: #333; color: white; padding: 10px; border: none; cursor: pointer; font-size: 16px; margin-left: 10px; }";
echo "#backButton:hover { background-color: #555; }";
echo "</style>";

$sql = "SELECT * FROM case_history";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit_case_history.css"> 
    <title>Court Database Management System</title>
</head>

<body>

    <header>
        <h1>Admin Dashboard - Manage Cases</h1>
    </header>

    <div id="caseManagementBox">

        <div id="caseManagement">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <ul id="caseList">
                </ul>

                <div id="filterOptions">
                    <label for="caseNumber">Case Number:</label>
                    <input type="text" name="caseNumber" id="caseNumber">
                    <br><br>

                    <label for="judge">Judge:</label>
                    <input type="text" name="judge" id="judge">
                    <br><br>

                    <button type="submit" id="searchButton" name="searchButton">Search</button>
                    <a href="admin_dashboard.php"><button type="button" id="backButton">Back</button></a>
                </div>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchButton'])) {
                $caseNumber = mysqli_real_escape_string($conn, $_POST['caseNumber']);
                $judge = mysqli_real_escape_string($conn, $_POST['judge']);

                $searchQuery = "SELECT * FROM case_history WHERE case_number LIKE '%$caseNumber%' AND judge LIKE '%$judge%'";
                $searchResult = $conn->query($searchQuery);

                if ($searchResult->num_rows > 0) {
                    echo "<table border='1'>";
                    echo "<tr><th>Case Number</th><th>Judge</th><th>Business Date</th><th>Hearing Date</th><th>Purpose of Hearing</th><th>Action</th></tr>";

                    while ($row = $searchResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["case_number"] . "</td>";
                        echo "<td>" . $row["judge"] . "</td>";
                        echo "<td>" . $row["business_date"] . "</td>";
                        echo "<td>" . $row["hearing_date"] . "</td>";
                        echo "<td>" . $row["purpose_of_hearing"] . "</td>";
                        echo "<td><a href='edit_case_history.php?case_number=" . $row["case_number"] . "&judge=" . $row["judge"] . "&business_date=" . $row["business_date"] . "&hearing_date=" . $row["hearing_date"] . "&purpose_of_hearing=" . $row["purpose_of_hearing"] . "'>Edit</a></td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p>No cases found.</p>";
                }
            } else {
                if ($result->num_rows > 0) {
                    echo "<table border='1'>";
                    echo "<tr><th>Case Number</th><th>Judge</th><th>Business Date</th><th>Hearing Date</th><th>Purpose of Hearing</th><th>Action</th></tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["case_number"] . "</td>";
                        echo "<td>" . $row["judge"] . "</td>";
                        echo "<td>" . $row["business_date"] . "</td>";
                        echo "<td>" . $row["hearing_date"] . "</td>";
                        echo "<td>" . $row["purpose_of_hearing"] . "</td>";
                        echo "<td><a href='edit_case_history.php?case_number=" . $row["case_number"] . "&judge=" . $row["judge"] . "&business_date=" . $row["business_date"] . "&hearing_date=" . $row["hearing_date"] . "&purpose_of_hearing=" . $row["purpose_of_hearing"] . "'>Edit</a></td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p>No cases found.</p>";
                }
            }

            $conn->close();
            ?>
            <br><br>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>

</body>

</html>
