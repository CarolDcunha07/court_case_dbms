<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loginMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $userId = $_POST["userId"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE user_id='$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($password == $row["password"]) {
            $_SESSION["user_id"] = $row["user_id"];
            
            if ($row["user_id"] == "admin") {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                header("Location: dashboard.html");
                exit();
            }
        } else {
            $loginMessage = "<small style='color: red'>Incorrect password.</small>";
        }
    } else {
        $loginMessage = "<small style='color: red'>User not found.</small>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        .center-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .register-link {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #A98064;
            border-radius: 5px;
            background: #fff;
            text-decoration: none;
            color: #555;
            transition: 0.3s;
        }

        .register-link:hover {
            background: #A98064;
            color: #fff;
        }
        .left-content {
            text-align: left;
            max-width: 300px;
            color:#fff;
        }
    </style>
</head>

<body>
    <div class="left-content">
        <p>Name: Ashritha Bhat</p>
        <p>Name: Ashritha Bhat</p>
        <p>Name: Ashritha Bhat</p>

        <p>USN: 4NM21CS036</p>
        <p>Name: Carol Dcunha</p>
        <p>USN: 4NM21CS045</p>
        <p>Under the guidance of:</p>
        <p>Dr. Pradeep Kanchan</p>


    <div class="hero">
   
        <div class="form-box center-container">
            <div class="social-icons">
                <img src="fb.jpg">
                <img src="tw.png">
                <img src="gp.jpg">
            </div>
            <a href='register.php' class="register-link">Want to join us? Register now</a>
            <form id="loginForm" class="input-group" action="" method="post">
                <input type="text" class="input-field" placeholder="User Id" required name="userId">
                <input type="password" class="input-field" placeholder="Enter Password" required name="password">
                <button type="submit" class="submit-btn" name="login">Log In</button>
                <div id="loginMessage" class="form-message"><?php echo $loginMessage; ?></div>
            </form>

            
        </div>
    </div>

    <script>
        var loginButton = document.getElementById("loginForm");

        function register() {
            loginButton.style.left = "-400px";
            document.getElementById("registerMessage").innerHTML = "";
            document.getElementById("loginMessage").innerHTML = "";
        }

        function login() {
            loginButton.style.left = "50px";
            document.getElementById("registerMessage").innerHTML = "";
            document.getElementById("loginMessage").innerHTML = "";
        }
    </script>

</body>
</html>
