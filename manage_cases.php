<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cases";
$result = $conn->query($sql);

echo "<style>";
echo "#searchButton { background-color: green; color: white; padding: 10px; border: none; cursor: pointer; font-size: 16px; }";
echo "#searchButton:hover { background-color: darkgreen; }";
echo "#backButton { background-color: #333; color: white; padding: 10px; border: none; cursor: pointer; font-size: 16px; margin-left: 10px; }";
echo "#backButton:hover { background-color: #555; }";
echo "</style>";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="manage_cases.css"> 
    <title>Court Database Management System</title>
</head>

<body>

    <header>
        <h1>Admin Dashboard - Manage Cases</h1>
    </header>

    <div id="caseManagementBox">

        <div id="caseManagement">
            <form action="edit_case.php" method="get">
                <ul id="caseList">
                </ul>

                <div id="filterOptions">
                    <label for="courtComplex">Court Complex:</label>
                    <select name="courtComplex" id="courtComplex">
                        <option value="PRL. SENIOR CIVIL JUDGE AND CJM, MANGALURU">PRL. SENIOR CIVIL JUDGE AND CJM,
                            MANGALURU</option>
                        <option value="PRL. DISTRICT AND SESSIONS JUDGE, MANGALURU">PRL. DISTRICT AND SESSIONS JUDGE,
                            MANGALURU</option>
                        <option value="JMFC IV COURT, MANGALURU">JMFC IV COURT, MANGALURU</option>
                    </select>
                    <br><br>

                    <label for="caseNumber">Case Number:</label>
                    <input type="text" name="caseNumber" id="caseNumber">
                    <br><br>

                    <label for="caseType">Case Type:</label>
                    <select name="caseType" id="caseType">
                        <option value="C.C. CRIMINAL CASES">C.C. CRIMINAL CASES</option>
                        <option value="Cr Criminal Case">Cr Criminal Case</option>
                        <option value="O.S. ORIGINAL SUIT">O.S. ORIGINAL SUIT</option>
                        <option value="M.C. MATRIMONIAL CASES">M.C. MATRIMONIAL CASES</option>
                        <option value="R.A REGULAR APPEAL">R.A REGULAR APPEAL</option>
                        <option value="H.R.C. HOUSE RENT CONTROL CASES">H.R.C. HOUSE RENT CONTROL CASES</option>
                        <option value="L.P.C LONG PENDING CASES">L.P.C LONG PENDING CASES</option>
                    </select><br><br>

                    <button type="submit" id="searchButton">Search</button>

                    <a href="admin_dashboard.php"><button type="button" id="backButton">Back</button></a>
                </div>
            </form>

            <?php
            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Case Number</th><th>Party Name</th><th>Type</th><th>Filing Date</th><th>Registration Date</th><th>Registration Number</th><th>First Hearing Date</th><th>Status</th><th>Nature of Disposal</th><th>Action</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["case_number"] . "</td>";
                    echo "<td>" . $row["party_name"] . "</td>";
                    echo "<td>" . $row["type"] . "</td>";
                    echo "<td>" . $row["filling_date"] . "</td>";
                    echo "<td>" . $row["reg_date"] . "</td>";
                    echo "<td>" . $row["reg_number"] . "</td>";
                    echo "<td>" . $row["first_hearing_date"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>" . $row["nature_of_disposal"] . "</td>";

                    echo "<td><a href='edit_case.php?case_number=" . $row["case_number"] . "'>Edit</a></td>";
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
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>

</body>

</html>
