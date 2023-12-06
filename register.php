<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "login_sample_db1"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$registerMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $userId = $_POST["userId"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE user_id='$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $registerMessage = "<small style='color: red'>User already exists.</small>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (user_id, password) VALUES ('$userId', '$password')";

        if ($conn->query($sql) === TRUE) {
            $registerMessage = "<small style='color: green'>Registration successful!</small>";
        } else {
            $registerMessage = "<small style='color: red'>Error: " . $sql . "<br>" . $conn->error . "</small>";
        }
    }
}

$conn->close();
?>

<html>
<head>
    <title>Registration Form</title>
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
    </style>
</head>

<body>
    <div class="hero">
        <div class="form-box center-container">            
            <div class="social-icons">
                <img src="fb.jpg">
                <img src="tw.png">
                <img src="gp.jpg">
            </div>
            <a href='login.php' class="register-link">Already a Member? Login now</a>
            <form id="registerForm" class="input-group" action="" method="post">
                <input type="text" class="input-field" placeholder="User Id" required name="userId">
                <input type="password" class="input-field" placeholder="Enter Password" required name="password">
                <button type="submit" class="submit-btn" name="register">Register</button>
                <div id="registerMessage" class="form-message"><?php echo $registerMessage; ?></div>
            </form>
            

        </div>
    </div>

    <script>
        var registerButton = document.getElementById("registerForm");

        function register() {
            registerButton.style.left = "50px";
            document.getElementById("registerMessage").innerHTML = "";
            document.getElementById("loginMessage").innerHTML = "";
        }

        function login() {
            registerButton.style.left = "450px";
            document.getElementById("registerMessage").innerHTML = "";
            document.getElementById("loginMessage").innerHTML = "";
        }
    </script>

</body>
</html>
