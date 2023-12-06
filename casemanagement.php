<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="casemanagement.css">
    <style>
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
    </style>
    <title>Court Database Management System</title>
</head>

<body>

    <header>
        <h1>Case Management System</h1>
    </header>

    <div id="caseManagementBox">

        <div id="caseManagement">
            <form action="" method="post">
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
                        <option value="SENIOR SESSIONS JUDGE, MANGALURU">SENIOR SESSIONS JUDGE, MANGALURU</option>
                        <option value="DISTRICT COURT, MANGALURU">DISTRICT COURT, MANGALURU</option>
                        <option value="CJM COURT, MANGALURU">CJM COURT, MANGALURU</option>
                        <option value="MAGISTRATE COURT, MANGALURU">MAGISTRATE COURT, MANGALURU</option>
                        <option value="PRL. CIVIL JUDGE, MANGALURU">PRL. CIVIL JUDGE, MANGALURU</option>
                        <option value="JMFC II COURT, MANGALURU">JMFC II COURT, MANGALURU</option>
                        <option value="SESSIONS COURT, MANGALURU">SESSIONS COURT, MANGALURU</option>
                        <option value="JMFC I COURT, MANGALURU">JMFC I COURT, MANGALURU</option>



                    </select>

                    <br><br>

                    <label for="caseNumber">Case Number:</label>
                    <input type="text" name="caseNumber" id="caseNumber">

                    <br><br>

                    <label for="caseYear">Registration Date:</label>
                    <input type="text" name="caseYear" id="caseYear">

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
                        <option value="F.A. FAMILY CASES">F.A. FAMILY CASES</option>
                        <option value="S.C. SUMMARY CASES">S.C. SUMMARY CASES</option>
                        <option value="D.V.C. DOMESTIC VIOLENCE CASES">D.V.C. DOMESTIC VIOLENCE CASES</option>
                        <option value="M.C. MAINTENANCE CASES">M.C. MAINTENANCE CASESS</option>
                        <option value="O.C. OCCUPANCY CASES">O.C. OCCUPANCY CASES</option>


                    </select>

                    <br><br>

                    <label for="partyName">Party Name:</label>
                    <input type="text" name="partyName" id="partyName">

                    <br><br>

                    <button type="submit" id="searchButton">Search</button>
                </div>
            </form>
            <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courtComplex = $_POST["courtComplex"];
    $caseNumber = $_POST["caseNumber"];
    $caseYear = $_POST["caseYear"];
    $caseType = $_POST["caseType"];
    $partyName = isset($_POST["partyName"]) ? $_POST["partyName"] : "";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_sample_db1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $partyName = mysqli_real_escape_string($conn, $partyName);

    $sql = "SELECT * FROM cases WHERE court_complex = '$courtComplex' AND case_number = '$caseNumber' AND YEAR(reg_date) = '$caseYear' AND type = '$caseType' AND party_name LIKE '%$partyName%'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<h2>Search Results:</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Sr. No</th><th>Case Number</th><th>Party Name</th></tr>";
            $srNo = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $srNo++ . "</td>";
                echo "<td><a href='casedetails.php?case_number=" . $row["case_number"] . "'>" . $row["case_number"] . "</a></td>";
                echo "<td>" . $row["party_name"] . "</td>";
                echo "</tr>";

                $selectedCaseNumber = $row["case_number"];
                $sqlPartyDetails = "SELECT * FROM party_details WHERE case_number = '$selectedCaseNumber'";
                $resultPartyDetails = $conn->query($sqlPartyDetails);

                if ($resultPartyDetails->num_rows > 0) {
                    echo "<h3>Plaintiff and Defendant Details:</h3>";
                    echo "<table border='1'>";
                    echo "<tr><th>Sr. No</th><th>Plaintiff Name</th><th>Defendant Name</th></tr>";
                    $srNoPartyDetails = 1;
                    while ($rowPartyDetails = $resultPartyDetails->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $srNoPartyDetails++ . "</td>";
                        echo "<td>" . $rowPartyDetails["plaintiff_name"] . "</td>";
                        echo "<td>" . $rowPartyDetails["defendant_name"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No party details found for the selected case number.</p>";
                }
            }
            echo "</table>";
        } else {
            echo "<p>No results found for the entered values.</p>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>




            <br><br>

            <button id="addNewCaseButton" onclick="window.location.href='add_new_case.php'">Add New Case</button> <br><br>
            <button id="backButton" onclick="window.location.href='dashboard.html'">Back to Dashboard</button>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>

</body>

</html>
