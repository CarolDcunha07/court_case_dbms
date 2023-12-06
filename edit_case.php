<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$updateMessage = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caseNumber = $_POST["caseNumber"];
    $partyName = $_POST["partyName"];
    $caseType = $_POST["caseType"];
    $fillingDate = $_POST["fillingDate"];
    $regDate = $_POST["regDate"];
    $regNumber = $_POST["regNumber"];
    $firstHearingDate = $_POST["firstHearingDate"];
    $status = $_POST["status"];
    $natureOfDisposal = $_POST["natureOfDisposal"];

    $sql = "UPDATE cases SET 
            party_name='$partyName', 
            type='$caseType', 
            filling_date='$fillingDate', 
            reg_date='$regDate', 
            reg_number='$regNumber', 
            first_hearing_date='$firstHearingDate', 
            status='$status', 
            nature_of_disposal='$natureOfDisposal' 
            WHERE case_number='$caseNumber'";

    if ($conn->query($sql) === TRUE) {
        $updateMessage = "Case updated successfully";
    } else {
        $updateMessage = "Error updating record: " . $conn->error;
    }
}

if (isset($_GET["case_number"])) {
    $caseNumber = $_GET["case_number"];

    $sql = "SELECT * FROM cases WHERE case_number = '$caseNumber'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="edit_case.css"> 
            <title>Edit Case - <?php echo $row["case_number"]; ?></title>
            <style>
                .success-message {
                    color: green;
                }

                .error-message {
                    color: red;

                }
        
       #backButton {
            background-color: #4CAF50;
            color: white;
            padding: 10px ;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        #backButton:hover {
            background-color: #45a049;
        }

            </style>
        </head>

        <body>

            <header>
                <h1>Edit Case - <?php echo $row["case_number"]; ?></h1>
            </header>

            <div id="editCaseForm">
                <?php if (!empty($updateMessage)) : ?>
                    <div class="<?php echo $updateMessage === 'Case updated successfully' ? 'success-message' : 'error-message'; ?>">
                        <?php echo $updateMessage; ?>
                    </div>
                    <script>
                        setTimeout(function () {
                            document.querySelector('.success-message, .error-message').style.display = 'none';
                        }, 3000);
                    </script>
                <?php endif; ?>
                <form action="" method="post">
                    <input type="hidden" name="caseNumber" value="<?php echo $row["case_number"]; ?>">
                    <label for="partyName">Party Name:</label>
                    <input type="text" name="partyName" value="<?php echo $row["party_name"]; ?>" required><br>

                    <label for="caseType">Case Type:</label>
                    <input type="text" name="caseType" value="<?php echo $row["type"]; ?>" required><br>

                    <label for="fillingDate">Filing Date:</label>
                    <input type="text" name="fillingDate" value="<?php echo $row["filling_date"]; ?>" required><br>

                    <label for="regDate">Registration Date:</label>
                    <input type="text" name="regDate" value="<?php echo $row["reg_date"]; ?>" required><br>

                    <label for="regNumber">Registration Number:</label>
                    <input type="text" name="regNumber" value="<?php echo $row["reg_number"]; ?>" required><br>

                    <label for="firstHearingDate">First Hearing Date:</label>
                    <input type="text" name="firstHearingDate" value="<?php echo $row["first_hearing_date"]; ?>" required><br>

                    <label for="status">Status:</label>
                    <input type="text" name="status" value="<?php echo $row["status"]; ?>" required><br>

                    <label for="natureOfDisposal">Nature Of Disposal:</label>
                    <input type="text" name="natureOfDisposal" value="<?php echo $row["nature_of_disposal"]; ?>" required><br>

                    <button type="submit" id="updateButton">Update</button>
                </form>
            </div>

    <button id="backButton" onclick="window.location.href='manage_cases.php'">Back </button>
    <footer>
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>
        </body>

        </html>
        <?php
    } else {
        echo "Case not found.";
    }
} else {
    echo "Case number not provided.";
}

$conn->close();
?>
