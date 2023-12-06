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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $partyName = $_POST["partyName"];
    $caseType = $_POST["caseType"];
    $courtComplex = $_POST["courtComplex"];
    
    $regDate = $_POST["regDate"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_sample_db1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $generatedCaseNumber = generateCaseNumber($conn);

    $sql = "INSERT INTO cases (case_number, party_name, type, court_complex, reg_date)
            VALUES ('$generatedCaseNumber', '$partyName', '$caseType', '$courtComplex', '$regDate')";

    if ($conn->query($sql) === TRUE) {
        echo "Case added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
