<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "login_sample_db1"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
  $userId = $_POST["userId"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM users WHERE user_id='$userId'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<small style='color: red'>User already exists.</small>";
  } else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (user_id, password) VALUES ('$userId', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
      echo "<small style='color: green'>Registration successful!</small>";
    } else {
      echo "<small style='color: red'>Error: " . $sql . "<br>" . $conn->error . "</small>";
    }
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
  $userId = $_POST["userId"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM users WHERE user_id='$userId'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($password==$row["password"]) {
      echo "<small style='color: green'>Login successful!</small>";

      header("Location: dashboard.html");
      exit();
    } else {
      echo "<small style='color: red'>Incorrect password.</small>";
    }
  } else {
    echo "<small style='color: red'>User not found.</small>";
  }
}

$conn->close();
?>



<html>
<head>
    <title>Login and Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <div class="social-icons">
                <img src="fb.jpg">
                <img src="tw.png">
                <img src="gp.jpg">
            </div>

            <form id="login" class="input-group" action="" method="post">
                <input type="text" class="input-field" placeholder="User Id" required name="userId">
                <input type="password" class="input-field" placeholder="Enter Password" required name="password">
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn" name="login">Log In</button>
            </form>

            <form id="register" class="input-group" action="" method="post">
                <input type="text" class="input-field" placeholder="User Id" required name="userId">
                <input type="password" class="input-field" placeholder="Enter Password" required name="password">
                <input type="checkbox" class="check-box"><span>I agree to the terms & conditions</span>
                <button type="submit" class="submit-btn" name="register">Register</button>
            </form>
        </div>
    </div>

<script>
    var loginButton = document.getElementById("login");
    var registerButton = document.getElementById("register");
    var z = document.getElementById("btn");

    function register() {
        loginButton.style.left = "-400px";
        registerButton.style.left = "50px";
        z.style.left = "110px";
    }

    function login() {
        loginButton.style.left = "50px";
        registerButton.style.left = "450px";
        z.style.left = "0px";
    }

    registerButton.addEventListener("click", function () {
        window.location.href = "#login";
    });

</script>

</body>
</html>
