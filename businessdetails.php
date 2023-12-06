<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="casedetails.css"> 
    <title>Business Details</title>
</head>

<body>
    <div id="header">
        <h1>Business Details</h1>
    </div>
    <?php
    if (isset($_GET["business_date"])) {
        $businessDate = $_GET["business_date"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login_sample_db1";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sqlDetails = "SELECT * FROM case_history WHERE business_date = '$businessDate'";
        $resultDetails = $conn->query($sqlDetails);

        if ($resultDetails->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Judge</th><th>Hearing Date</th><th>Purpose of Hearing</th></tr>";
            while ($rowDetails = $resultDetails->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $rowDetails["judge"] . "</td>";
                echo "<td>" . $rowDetails["hearing_date"] . "</td>";
                echo "<td>" . $rowDetails["purpose_of_hearing"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            echo "<button id='closeModalButton' onclick='goBack()'>Close</button>";
        } else {
            echo "<p>No details found for the business date.</p>";
        }

        $conn->close();
    } else {
        echo "<p>No business date provided.</p>";
    }
    ?>

    <footer>
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
