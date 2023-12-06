<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$case_number = isset($_GET["case_number"]) ? $_GET["case_number"] : '';
$judge = isset($_GET["judge"]) ? $_GET["judge"] : '';
$business_date = isset($_GET["business_date"]) ? $_GET["business_date"] : '';
$hearing_date = isset($_GET["hearing_date"]) ? $_GET["hearing_date"] : '';
$purpose_of_hearing = isset($_GET["purpose_of_hearing"]) ? $_GET["purpose_of_hearing"] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $case_number = $_POST["case_number"];
    $judge = $_POST["judge"];
    $business_date = $_POST["business_date"];
    $hearing_date = $_POST["hearing_date"];
    $purpose_of_hearing = $_POST["purpose_of_hearing"];

    $query = "UPDATE case_history SET 
              judge = '$judge', 
              business_date = '$business_date', 
              hearing_date = '$hearing_date', 
              purpose_of_hearing = '$purpose_of_hearing' 
              WHERE case_number = '$case_number'";

    $result = $conn->query($query);

    
    if ($result) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit_case_history.css"> 
    <title>Edit Case History</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
           
            $("form").submit(function (event) {
                event.preventDefault(); 

                $.ajax({
                    type: "POST",
                    url: "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>",
                    data: $(this).serialize(),
                    success: function (response) {
                        $("#updateMessage").html(response).css("color", "green").show();
                        setTimeout(function () {
                            $("#updateMessage").fadeOut();
                        }, 3000); 
                    },
                    error: function (error) {
                        $("#updateMessage").html("Error updating record: " + error.responseText).css("color", "red").show();
                        setTimeout(function () {
                            $("#updateMessage").fadeOut();
                        }, 3000); 
                    }
                });
            });
        });
    </script>
    <style>
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
        <h1>Edit Case History</h1>
    </header>

    <div id="editCaseHistoryBox">

        <div id="editCaseHistory">
            <form method="post">
                <label for="case_number">Case Number:</label>
                <input type="text" name="case_number" value="<?php echo $case_number; ?>" readonly><br><br>

                <label for="judge">Judge:</label>
                <input type="text" name="judge" value="<?php echo $judge; ?>"><br><br>

                <label for="business_date">Business Date:</label>
                <input type="text" name="business_date" value="<?php echo $business_date; ?>"><br><br>

                <label for="hearing_date">Hearing Date:</label>
                <input type="text" name="hearing_date" value="<?php echo $hearing_date; ?>"><br><br>

                <label for="purpose_of_hearing">Purpose of Hearing:</label>
                <input type="text" name="purpose_of_hearing" value="<?php echo $purpose_of_hearing; ?>"><br><br>

                <input type="submit" value="Update">
            </form>

            <div id="updateMessage" style="display: none;"></div>
        </div>
    </div>
    <button id="backButton" onclick="window.location.href='manage_hearing.php'">Back </button>

    <footer>
        <p>&copy; 2023 Court System. All rights reserved.</p>
    </footer>

</body>

</html>
