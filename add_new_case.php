<?php
function generateCaseNumber($conn)
{
    $query = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'login_sample_db1' AND TABLE_NAME = 'cases'";
    $result = $conn->query($query);

    if ($result && $row = $result->fetch_assoc()) {
        $latestID = $row['AUTO_INCREMENT'];
        $caseNumber = "MNG" . str_pad($latestID, 4, '0', STR_PAD_LEFT);
        return $caseNumber;
    } else {
        return "MNG0001"; 
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$generatedCaseNumber = generateCaseNumber($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add_new_case.css">
    <title>Add New Case</title>

    <style>
        #successDropdown {
            display: none;
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
        }
    </style>
</head>

<body>

    <header>
        <h1>Case Management Dashboard</h1>
    </header>

    <div id="addNewCaseForm">
        <form id="caseForm" action="process_new_case.php" method="post">
            <label for="caseNumber">Case Number:</label>
            <input type="text" name="caseNumber" id="caseNumber" value="<?php echo $generatedCaseNumber; ?>" readonly required>

            <label for="partyName">Party Name:</label>
            <input type="text" name="partyName" id="partyName" required>

            <label for="caseType">Case Type:</label>
            <select name="caseType" id="caseType" required>
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

            <label for="courtComplex">Court Complex:</label>
            <select name="courtComplex" id="courtComplex" required>
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

            <label for="regDate">Registration Date:</label>
            <input type="date" name="regDate" id="regDate" required>

            <button type="button" name="submit" id="addButton">Add Case</button>
        </form>
    </div>

    <button id="addNewCaseButton" onclick="location.href='casemanagement.php'">Back to Case Management</button>

    <div id="successDropdown"></div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#addButton").click(function () {
                // Serialize form data
                var formData = $("#caseForm").serialize();

                // AJAX request
                $.ajax({
                    type: "POST",
                    url: "process_new_case.php",
                    data: formData,
                    success: function (response) {
                        $("#successDropdown").text("Case added successfully!");
                        $("#successDropdown").slideDown().delay(3000).slideUp();
                    },
                    error: function (error) {
                        console.log("Error:", error);
                    }
                });
            });
        });
    </script>

</body>

</html>
