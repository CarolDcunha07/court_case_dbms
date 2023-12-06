<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caseNumber = $_POST["caseNumber"];
    $partyName = $_POST["partyName"];
    $caseType = $_POST["caseType"];
    $fillingDate = $_POST["fillingDate"];
    $firstHearingDate = $_POST["firstHearingDate"];
    $status = $_POST["status"];

    $sql = "UPDATE cases SET party_name='$partyName', type='$caseType', filling_date='$fillingDate', first_hearing_date='$firstHearingDate', status='$status' WHERE case_number='$caseNumber'";

    if ($conn->query($sql) === TRUE) {
        echo "Case details updated successfully.";
    } else {
        echo "Error updating case details: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
