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
    $id = isset($_POST["id"]) ? $_POST["id"] : '';
    $title = $_POST["title"];
    $author = $_POST["author"];
    $publication_date = $_POST["publication_date"];
    $content = $_POST["content"];
    $category = $_POST["category"];
    $description = $_POST["description"];

    if ($id) {
        $query = "UPDATE articles SET 
                  title = '$title', 
                  author = '$author', 
                  publication_date = '$publication_date', 
                  content = '$content', 
                  category = '$category', 
                  description = '$description' 
                  WHERE id = '$id'";

        $result = $conn->query($query);

        if ($result) {
            echo "Article updated successfully";
        } else {
            echo "Error updating article: " . $conn->error;
        }
    } else {
        echo "Article not found. Please provide a valid ID.";
    }

    exit; 
}

$sql = "SELECT * FROM articles";
$result = $conn->query($sql);

if (!$result) {
    die("Error in SQL query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Management</title>
    <link rel="stylesheet" href="edit_articles.css"> 
</head>

<body>

    <h1>Article Management</h1>

    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Title</th><th>Author</th><th>Publication Date</th><th>Content</th><th>Category</th><th>Description</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["author"] . "</td>";
            echo "<td>" . $row["publication_date"] . "</td>";
            echo "<td>" . $row["content"] . "</td>";
            echo "<td>" . $row["category"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td><a href='edit_process_articles.php?id=" . $row["id"] . "'>Edit</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No articles found.</p>";
    }

    $conn->close();

    
echo "<style>";
echo "#searchButton { background-color: green; color: white; padding: 10px; border: none; cursor: pointer; font-size: 16px; }";
echo "#searchButton:hover { background-color: darkgreen; }";
echo "#backButton { background-color: #333; color: white; padding: 10px; border: none; cursor: pointer; font-size: 16px; margin-left: 10px; }";
echo "#backButton:hover { background-color: #555, border-radius: 1px; }";
echo "</style>";
    ?>
    <br>
<a href="admin_dashboard.php"><button type="button" id="backButton">Back</button></a>
<footer>
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>
</body>
<div>
    
</div>
</html>
