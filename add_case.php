<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $caseNumber = $_POST["caseNumber"] ?? '';
    $partyName = $_POST["partyName"] ?? '';
    $caseType = $_POST["caseType"] ?? '';
    $courtComplex = $_POST["courtComplex"] ?? '';
    $regDate = $_POST["regDate"] ?? '';

    $fillingDate = $_POST["fillingDate"] ?? '';
    $regNumber = $_POST["regNumber"] ?? '';
    $firstHearingDate = $_POST["firstHearingDate"] ?? '';
    $decisionDate = $_POST["decisionDate"] ?? '';
    $natureOfDisposal = $_POST["natureOfDisposal"] ?? '';
    $status = $_POST["status"] ?? '';

    $stmt = $conn->prepare("INSERT INTO cases (case_number, party_name, type, court_complex, reg_date, filling_date, reg_number, first_hearing_date, decision_date, nature_of_disposal, status)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                            ON DUPLICATE KEY UPDATE party_name = VALUES(party_name), type = VALUES(type),
                                                    court_complex = VALUES(court_complex), reg_date = VALUES(reg_date),
                                                    filling_date = VALUES(filling_date), reg_number = VALUES(reg_number),
                                                    first_hearing_date = VALUES(first_hearing_date), decision_date = VALUES(decision_date),
                                                    nature_of_disposal = VALUES(nature_of_disposal), status = VALUES(status)");

    $stmt->bind_param("sssssssssss", $caseNumber, $partyName, $caseType, $courtComplex, $regDate,
                      $fillingDate, $regNumber, $firstHearingDate, $decisionDate, $natureOfDisposal, $status);

    if ($stmt->execute()) {
        echo '<script>
                setTimeout(function() {
                    alert("Case added successfully!");
                    window.location.href = "admin_dashboard.php";
                }, 1000); // Redirect after 1 second (adjust as needed)
              </script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add_new_case.css">
    <title>Add New Case</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        #addNewCaseForm {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        #backButton {
            background-color: #333;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
        }

        #backButton:hover {
            background-color: #555;
        }

        #addNewCaseButton {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            display: inline-block;
            border-radius: 4px;
        }

        #addNewCaseButton:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <header>
        <h1>Case Management Dashboard</h1>
    </header>

    <div id="addNewCaseForm">
        <form action="add_case.php" method="post">
            <label for="caseNumber">Case Number:</label>
            <input type="text" name="caseNumber" id="caseNumber" required>

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

            <label for="fillingDate">Filling Date:</label>
            <input type="date" name="fillingDate" id="fillingDate" required>

            <label for="regNumber">Registration Number:</label>
            <input type="text" name="regNumber" id="regNumber" required>

            <label for="firstHearingDate">First Hearing Date:</label>
            <input type="date" name="firstHearingDate" id="firstHearingDate" required>

            <label for="decisionDate">Decision Date:</label>
            <input type="date" name="decisionDate" id="decisionDate" required>

            <label for="natureOfDisposal">Nature of Disposal:</label>
            <input type="text" name="natureOfDisposal" id="natureOfDisposal" required>

            <label for="status">Status:</label>
            <input type="text" name="status" id="status" required>

            <button type="submit" name="submit" id="addButton">Add Case</button>

            <a href="admin_dashboard.php"><button type="button" id="backButton">Back</button></a>

        </form>
    </div>

    <button id="addNewCaseButton" onclick="location.href='casemanagement.php'">Back to Case Management</button>

    <footer>
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>

</body>

</html>
