<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cases WHERE first_hearing_date > CURDATE()";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $hearingsByCourt = array();

    while ($row = $result->fetch_assoc()) {
        $courtType = $row["type"];

        if (!isset($hearingsByCourt[$courtType])) {
            $hearingsByCourt[$courtType] = array();
        }

        $hearingsByCourt[$courtType][] = $row;
    }

    foreach ($hearingsByCourt as $courtType => $hearings) {
        echo "<h2>$courtType</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Case Number</th><th>Party Name</th><th>First Hearing Date</th></tr>";

        foreach ($hearings as $hearing) {
            echo "<tr>";
            echo "<td>" . $hearing["case_number"] . "</td>";
            echo "<td>" . $hearing["party_name"] . "</td>";
            echo "<td>" . $hearing["first_hearing_date"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
} else {
    echo "<p>No upcoming hearings found.</p>";
}

$conn->close();
?>


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
    <button id="backButton" onclick="window.location.href='dashboard.html'">Back to Dashboard</button>

<footer>
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>

<link rel="stylesheet" href="hearing.css"> 



