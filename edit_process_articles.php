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
                  title = ?, 
                  author = ?, 
                  publication_date = ?, 
                  content = ?, 
                  category = ?, 
                  description = ? 
                  WHERE id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssi", $title, $author, $publication_date, $content, $category, $description, $id);

        $result = $stmt->execute();

        if ($result) {
            echo "Article updated successfully. Redirecting back to the article list...";
            echo '<meta http-equiv="refresh" content="3;url=edit_articles.php">';
        } else {
            echo "Error updating article: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Article not found. Please provide a valid ID.";
    }

    exit; 
} else {
    $id = isset($_GET["id"]) ? $_GET["id"] : '';

    if ($id) {
        $sql = "SELECT * FROM articles WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Error fetching article details: " . $conn->error;
            exit;
        }
    } else {
        echo "No article ID provided.";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    <link rel="stylesheet" href="edit_articles.css"> 
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
                        $("#updateMessage").html(response).css("color", "green");
                        setTimeout(function(){
                            window.location.href = 'edit_articles.php';
                        }, 3000); 
                    },
                    error: function (error) {
                        $("#updateMessage").html("Error updating article: " + error.responseText).css("color", "red");
                    }
                });
            });
        });
    </script>
</head>

<body>

    <h1>Edit Article</h1>

    <div id="editArticleBox">

        <div id="editArticle">
            <form method="post">
                
                <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                
                <label for="title">Title:</label>
                <input type="text" name="title" value="<?php echo $row["title"]; ?>"><br><br>

                <label for="author">Author:</label>
                <input type="text" name="author" value="<?php echo $row["author"]; ?>"><br><br>

                <label for="publication_date">Publication Date:</label>
                <input type="text" name="publication_date" value="<?php echo $row["publication_date"]; ?>"><br><br>

                <label for="content">Content:</label>
                <textarea name="content"><?php echo $row["content"]; ?></textarea><br><br>

                <label for="category">Category:</label>
                <input type="text" name="category" value="<?php echo $row["category"]; ?>"><br><br>

                <label for="description">Description:</label>
                <textarea name="description"><?php echo $row["description"]; ?></textarea><br><br>

                <input type="submit" value="Update">
            </form>

            <div id="updateMessage"></div>
        </div>
    </div>
    <footer>
        <p>&copy; 2023 JusticeHub: Empowering Legal Insight in Mangalore Courts. All rights reserved.</p>
    </footer>

</body>

</html>
