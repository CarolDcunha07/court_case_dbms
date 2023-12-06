<?php

$articleAddedSuccessfully = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $publicationDate = $_POST["publicationDate"];
    $content = $_POST["content"];
    $category = $_POST["category"];
    $description = $_POST["description"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_sample_db1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO articles (title, author, publication_date, content, category, description)
            VALUES ('$title', '$author', '$publicationDate', '$content', '$category', '$description')";

    if ($conn->query($sql) === TRUE) {
        $articleAddedSuccessfully = true; 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

echo "<style>";
echo "#searchButton { background-color: green; color: white; padding: 10px; border: none; cursor: pointer; font-size: 16px; }";
echo "#searchButton:hover { background-color: darkgreen; }";
echo "#backButton { background-color: #333; color: white; padding: 10px; border: none; cursor: pointer; font-size: 16px; margin-left: 10px; }";
echo "#backButton:hover { background-color: #555, border-radius: 1px; }";
echo "</style>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="manage_articles.css"> 
    <title>Manage Articles</title>
    <style>
    .success-dropdown {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        z-index: 1000;
        display: none;
    }

    body {
        margin-bottom: 80px; 
    }

    footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #333;
        color: white;
        padding: 10px;
        text-align: center;
    }

    #articleForm {
        margin-bottom: 100px; 
    }
</style>


</head>

<body>

    <header>
        <h1>Manage Articles</h1>
    </header>

    <div id="articleForm">
        <form action="manage_articles.php" method="post">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="author">Author:</label>
            <input type="text" name="author" id="author" required>

            <label for="publicationDate">Publication Date:</label>
            <input type="date" name="publicationDate" id="publicationDate" required>

            <label for="content">Content:</label>
            <textarea name="content" id="content" required></textarea>

            <label for="category">Category:</label>
            <input type="text" name="category" id="category" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>

            <button type="submit">Add Article Details</button>

            <a href="admin_dashboard.php"><button type="button" id="backButton">Back</button></a>

        </form>
    </div>

    <div id="successMessage" style="display: <?php echo $articleAddedSuccessfully ? 'block' : 'none'; ?>" class="success-dropdown">
        Article details added successfully!
    </div>


    <footer>
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>

    <script>
    function goBack() {
        window.history.back();
    }

    setTimeout(function () {
        document.getElementById('successMessage').style.display = 'none';
    }, 3000);
</script>


</body>

</html>
